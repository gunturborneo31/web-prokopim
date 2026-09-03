<?php

namespace App\Http\Controllers;

use App\Models\DocumentStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentStatsController extends Controller
{
    public function view(Request $request)
    {
        $validated = $request->validate([
            'key' => ['required', 'string'],
            'type' => ['nullable', 'string'],
            'category' => ['nullable', 'string'],
            'url' => ['required', 'string'],
        ]);

        $this->increment($validated['key'], $validated['type'] ?? null, $validated['category'] ?? null, 'views');

        $destination = $this->normalizeDestinationUrl($validated['url']);

        abort_if($destination === null, 404);

        if ($this->isExternalUrl($destination)) {
            return redirect()->away($destination);
        }

        return redirect($destination);
    }

    public function download(Request $request)
    {
        $validated = $request->validate([
            'key' => ['required', 'string'],
            'type' => ['nullable', 'string'],
            'category' => ['nullable', 'string'],
            'url' => ['required', 'string'],
        ]);

        $this->increment($validated['key'], $validated['type'] ?? null, $validated['category'] ?? null, 'downloads');

        $destination = $this->normalizeDestinationUrl($validated['url']);

        abort_if($destination === null, 404);

        $localDownload = $this->buildLocalDownloadResponse($destination);

        if ($localDownload) {
            return $localDownload;
        }

        if ($this->isExternalUrl($destination)) {
            return redirect()->away($destination);
        }

        return redirect($destination);
    }

    public function stats(Request $request)
    {
        $validated = $request->validate([
            'keys' => ['nullable', 'array'],
            'keys.*' => ['string'],
            'key' => ['nullable', 'string'],
        ]);

        $keys = collect($validated['keys'] ?? [])->push($validated['key'] ?? null)->filter()->values();

        if ($keys->isEmpty() || ! $this->statsTableExists()) {
            return response()->json([]);
        }

        return response()->json(
            DocumentStat::query()
                ->whereIn('doc_key', $keys)
                ->get()
                ->mapWithKeys(fn (DocumentStat $stat) => [
                    $stat->doc_key => [
                        'views' => $stat->views,
                        'downloads' => $stat->downloads,
                    ],
                ])
        );
    }

    public function batch(Request $request)
    {
        $validated = $request->validate([
            'keys' => ['required', 'array'],
            'keys.*' => ['string'],
        ]);

        if (! $this->statsTableExists()) {
            return response()->json([]);
        }

        return response()->json(
            DocumentStat::query()
                ->whereIn('doc_key', $validated['keys'])
                ->get()
                ->mapWithKeys(fn (DocumentStat $stat) => [
                    $stat->doc_key => [
                        'views' => $stat->views,
                        'downloads' => $stat->downloads,
                    ],
                ])
        );
    }

    private function increment(string $key, ?string $type, ?string $category, string $metric): void
    {
        if (! $this->statsTableExists()) {
            return;
        }

        $stat = DocumentStat::query()->firstOrCreate(
            ['doc_key' => $key],
            [
                'type' => $type,
                'category' => $category,
                'views' => 0,
                'downloads' => 0,
            ]
        );

        $stat->increment($metric);

        $stat->forceFill([
            'type' => $type ?: $stat->type,
            'category' => $category ?: $stat->category,
            $metric === 'views' ? 'last_viewed_at' : 'last_downloaded_at' => now(),
        ])->save();
    }

    private function statsTableExists(): bool
    {
        return Schema::hasTable('document_stats');
    }

    private function buildLocalDownloadResponse(string $url): ?BinaryFileResponse
    {
        if (! Str::startsWith($url, ['http://', 'https://'])) {
            $path = '/' . ltrim((string) parse_url($url, PHP_URL_PATH), '/');

            if (! str_starts_with($path, '/storage/')) {
                return null;
            }

            $relativePath = ltrim(substr($path, strlen('/storage/')), '/');
            $fullPath = storage_path('app/public/' . $relativePath);

            if (! is_file($fullPath)) {
                return null;
            }

            return response()->download($fullPath, basename($fullPath));
        }

        $parts = parse_url($url);

        if (! is_array($parts) || empty($parts['path'])) {
            return null;
        }

        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
        $urlHost = $parts['host'] ?? null;

        if ($urlHost && $appHost && strcasecmp($urlHost, $appHost) !== 0) {
            return null;
        }

        $path = '/' . ltrim((string) $parts['path'], '/');

        if (! str_starts_with($path, '/storage/')) {
            return null;
        }

        $relativePath = ltrim(substr($path, strlen('/storage/')), '/');
        $fullPath = storage_path('app/public/' . $relativePath);

        if (! is_file($fullPath)) {
            return null;
        }

        return response()->download($fullPath, basename($fullPath));
    }

    private function normalizeDestinationUrl(string $url): ?string
    {
        $url = trim($url);

        if ($url === '') {
            return null;
        }

        if (Str::startsWith($url, ['http://', 'https://'])) {
            return $url;
        }

        $path = '/' . ltrim($url, '/');

        return preg_replace('/\s+/', '%20', $path);
    }

    private function isExternalUrl(string $url): bool
    {
        return Str::startsWith($url, ['http://', 'https://']);
    }
}