<?php

namespace App\Services;

use App\Models\Agenda;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Sumber data agenda beranda.
 *
 * Jika AGENDA_API_URL diisi, data diambil dari API eksternal (di-cache).
 * Jika kosong atau API gagal, otomatis memakai tabel `agenda` lokal.
 */
class AgendaService
{
    /**
     * Nama field yang dikenali dari respons API (dicoba berurutan).
     */
    private const FIELD_KEYS = [
        'title' => ['title', 'judul', 'nama', 'nama_kegiatan', 'kegiatan', 'caption', 'name'],
        'description' => ['description', 'deskripsi', 'keterangan', 'uraian'],
        'date' => ['schedule', 'datetime', 'tanggal_waktu', 'start', 'start_date', 'tanggal', 'date', 'tgl'],
        'time' => ['time', 'waktu', 'jam', 'start_time', 'jam_mulai'],
        'location' => ['location', 'lokasi', 'tempat'],
        'opd' => ['opd', 'instansi', 'penyelenggara', 'unit_kerja', 'organizer'],
    ];

    /**
     * @return array{items: Collection, total: int, source: string}
     */
    public function latest(int $limit = 5): array
    {
        if (filled(config('services.agenda_api.url'))) {
            $remote = $this->fromApi();

            if ($remote !== null) {
                return [
                    'items' => $remote->take($limit)->values(),
                    'total' => $remote->count(),
                    'source' => 'api',
                ];
            }
        }

        return [
            'items' => $this->fromDatabase($limit),
            'total' => Agenda::query()->count(),
            'source' => 'local',
        ];
    }

    /**
     * Ambil semua agenda dari API, urut terbaru. Null jika API gagal.
     */
    private function fromApi(): ?Collection
    {
        $ttl = max(0, (int) config('services.agenda_api.cache_ttl', 300));
        $cacheKey = 'agenda_api_items_' . md5((string) config('services.agenda_api.url'));

        // Jika API baru saja gagal, jangan coba lagi selama 1 menit agar beranda tetap cepat.
        if (Cache::has($cacheKey . '_failed')) {
            return null;
        }

        $fetch = function () use ($cacheKey) {
            $items = $this->requestApi();

            if ($items === null) {
                Cache::put($cacheKey . '_failed', true, now()->addMinute());
            }

            return $items;
        };

        if ($ttl === 0) {
            return $fetch();
        }

        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return collect($cached);
        }

        $items = $fetch();
        if ($items !== null) {
            Cache::put($cacheKey, $items->all(), now()->addSeconds($ttl));
        }

        return $items;
    }

    private function requestApi(): ?Collection
    {
        try {
            $request = Http::acceptJson()
                ->timeout((int) config('services.agenda_api.timeout', 5));

            if (filled($token = config('services.agenda_api.token'))) {
                $request = $request->withToken($token);
            }

            $response = $request->get(config('services.agenda_api.url'));

            if (! $response->successful()) {
                Log::warning('Agenda API gagal', ['status' => $response->status()]);

                return null;
            }

            $rows = $this->extractRows($response->json());

            if ($rows === null) {
                Log::warning('Agenda API: format respons tidak dikenali');

                return null;
            }

            return collect($rows)
                ->filter(fn ($row) => is_array($row))
                ->map(fn (array $row) => $this->mapApiRow($row))
                ->filter(fn (array $item) => $item['title'] !== '-')
                ->sortByDesc(fn (array $item) => $item['_sort'])
                ->values()
                ->map(fn (array $item) => Arr::except($item, '_sort'));
        } catch (\Throwable $e) {
            Log::warning('Agenda API error: ' . $e->getMessage());

            return null;
        }
    }

    /**
     * Mendukung respons: [...], {data: [...]}, {data: {data: [...]}} (paginate Laravel),
     * atau {agenda: [...]} / {items: [...]} / {result: [...]}.
     */
    private function extractRows(mixed $json): ?array
    {
        if (! is_array($json)) {
            return null;
        }

        if (array_is_list($json)) {
            return $json;
        }

        foreach (['data', 'agenda', 'items', 'result', 'results'] as $key) {
            if (isset($json[$key]) && is_array($json[$key])) {
                return $this->extractRows($json[$key]);
            }
        }

        return null;
    }

    private function mapApiRow(array $row): array
    {
        $pick = function (string $field) use ($row) {
            foreach (self::FIELD_KEYS[$field] as $key) {
                $value = data_get($row, $key);
                if (is_scalar($value) && trim((string) $value) !== '') {
                    return trim((string) $value);
                }
            }

            return null;
        };

        $schedule = $this->parseDate($pick('date'));

        // Jika jam dikirim terpisah (mis. "09:00"), gabungkan ke tanggal.
        $time = $pick('time');
        if ($schedule && $time && preg_match('/^(\d{1,2})[:.](\d{2})/', $time, $m)) {
            $schedule = $schedule->copy()->setTime((int) $m[1], (int) $m[2]);
        }

        return $this->formatItem(
            title: strip_tags((string) ($pick('title') ?? '-')),
            description: strip_tags((string) ($pick('description') ?? '-')),
            schedule: $schedule,
            location: $pick('location'),
            opd: $pick('opd'),
            timeLabel: $time,
        ) + ['_sort' => $schedule?->timestamp ?? 0];
    }

    private function parseDate(?string $value): ?Carbon
    {
        if (blank($value)) {
            return null;
        }

        try {
            // Dukung juga format Indonesia "31/10/2026" atau "31-10-2026"
            if (preg_match('#^(\d{1,2})[/-](\d{1,2})[/-](\d{4})(.*)$#', $value, $m)) {
                return Carbon::parse(sprintf('%04d-%02d-%02d%s', $m[3], $m[2], $m[1], $m[4]));
            }

            return Carbon::parse($value);
        } catch (\Throwable) {
            return null;
        }
    }

    private function fromDatabase(int $limit): Collection
    {
        return Agenda::query()
            ->orderByDesc('schedule')
            ->orderByDesc('id')
            ->take($limit)
            ->get()
            ->map(fn (Agenda $agenda) => $this->formatItem(
                title: (string) $agenda->caption,
                description: (string) $agenda->description,
                schedule: $agenda->schedule ? Carbon::parse($agenda->schedule) : null,
                location: $agenda->location,
                opd: $agenda->opd ?? null,
            ))
            ->values();
    }

    /**
     * Format seragam yang dipakai view sections/agenda.blade.php.
     */
    private function formatItem(
        string $title,
        string $description,
        ?Carbon $schedule,
        ?string $location,
        ?string $opd,
        ?string $timeLabel = null,
    ): array {
        $local = $schedule?->copy()->locale('id');

        return [
            'title' => $title !== '' ? $title : '-',
            'description' => $description !== '' ? $description : '-',
            'date' => $local?->translatedFormat('d F Y') ?? '-',
            'iso' => $schedule?->format('Y-m-d'),
            'time' => $timeLabel ?? ($local?->translatedFormat('H:i') ?? '-'),
            'hari' => $local?->translatedFormat('l') ?? '-',
            'location' => $location ?: 'Mahakam Ulu',
            'opd' => $opd ?: '-',
            'day' => $local?->translatedFormat('d') ?? '-',
            'month' => strtoupper((string) $local?->translatedFormat('M')),
        ];
    }
}
