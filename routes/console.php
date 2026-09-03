<?php

use App\Enums\UserRole;
use App\Models\File;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use App\Services\LegacyWebsiteImportService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('legacy:import-content {--base-url=https://PROKOPIMmahulu.com} {--news-limit=0} {--download-media=1}', function (LegacyWebsiteImportService $importer) {
    $downloadMedia = filter_var($this->option('download-media'), FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
    $downloadMedia ??= true;

    $summary = $importer->import(
        (string) $this->option('base-url'),
        max(0, (int) $this->option('news-limit')),
        $downloadMedia,
        fn (string $message) => $this->line($message),
    );

    $this->newLine();
    $this->info('Legacy import summary');

    foreach ($summary as $key => $value) {
        $this->line(sprintf('- %s: %s', str_replace('_', ' ', $key), $value));
    }
})->purpose('Import public data from the legacy PROKOPIM Mahulu website into the current project');

Artisan::command('scrape:import-prokopim {--file=scrape_prokopim/prokopim_berita.csv} {--limit=0} {--category=berita-prokopim}', function () {
    $relativePath = trim((string) $this->option('file'));
    $limit = max(0, (int) $this->option('limit'));

    if ($relativePath === '') {
        $this->error('Opsi --file tidak boleh kosong.');

        return 1;
    }

    $csvPath = base_path(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePath));
    if (! is_file($csvPath)) {
        $this->error('File CSV tidak ditemukan: ' . $csvPath);

        return 1;
    }

    $handle = fopen($csvPath, 'rb');
    if (! $handle) {
        $this->error('Gagal membuka file CSV: ' . $csvPath);

        return 1;
    }

    $rawHeader = fgetcsv($handle);
    if (! is_array($rawHeader) || $rawHeader === []) {
        fclose($handle);
        $this->error('Header CSV tidak valid atau kosong.');

        return 1;
    }

    $header = array_map(function ($value) {
        $text = trim((string) $value);
        $text = str_replace("\u{FEFF}", '', $text);
        $text = preg_replace('/^\xEF\xBB\xBF/', '', $text) ?? $text;

        return Str::lower($text);
    }, $rawHeader);

    $requiredColumns = ['judul', 'narasi', 'tanggal', 'url'];
    $missingColumns = array_values(array_diff($requiredColumns, $header));
    if ($missingColumns !== []) {
        fclose($handle);
        $this->error('Kolom wajib tidak ditemukan di CSV: ' . implode(', ', $missingColumns));

        return 1;
    }

    $author = User::query()->first() ?? User::query()->create([
        'name' => 'Scrape Import',
        'username' => 'scrape-import',
        'email' => 'scrape-import@mahulu.local',
        'password' => Str::random(32),
        'role' => UserRole::SuperAdmin,
    ]);

    $categorySlug = Str::slug((string) $this->option('category')) ?: 'berita-prokopim';
    $category = PostCategory::query()->firstOrCreate(
        ['slug' => $categorySlug],
        ['name' => Str::headline($categorySlug), 'active' => true]
    );

    $created = 0;
    $updated = 0;
    $skipped = 0;
    $failed = 0;
    $processed = 0;
    $syncedImages = 0;

    while (($row = fgetcsv($handle)) !== false) {
        $isBlank = collect($row)->every(fn ($value) => trim((string) $value) === '');
        if ($isBlank) {
            continue;
        }

        if ($limit > 0 && $processed >= $limit) {
            break;
        }

        $processed++;
        $record = array_combine($header, array_pad($row, count($header), ''));
        if (! is_array($record)) {
            $failed++;
            $this->warn("Baris #{$processed} gagal dipetakan ke header CSV.");

            continue;
        }

        $title = trim((string) ($record['judul'] ?? ''));
        $narrative = trim((string) ($record['narasi'] ?? ''));
        $url = trim((string) ($record['url'] ?? ''));
        if ($title === '' || $narrative === '') {
            $skipped++;
            $this->warn("Baris #{$processed} dilewati karena judul atau narasi kosong.");

            continue;
        }

        $slugFromUrl = trim((string) Str::of((string) parse_url($url, PHP_URL_PATH))
            ->trim('/')
            ->afterLast('/'));
        $baseSlug = Str::slug($slugFromUrl !== '' ? $slugFromUrl : $title);
        if ($baseSlug === '') {
            $baseSlug = 'berita-prokopim';
        }
        $baseSlug = Str::limit($baseSlug, 170, '');

        $slug = $baseSlug;
        $counter = 2;
        while (Post::query()
            ->where('slug', $slug)
            ->where('title', '!=', $title)
            ->exists()) {
            $slug = Str::limit($baseSlug, 150, '') . '-' . $counter;
            $counter++;
        }

        $publishedAt = null;
        $rawDate = trim((string) ($record['tanggal'] ?? ''));
        if ($rawDate !== '') {
            try {
                $publishedAt = \Illuminate\Support\Carbon::parse($rawDate);
            } catch (\Throwable) {
                $this->warn("Baris #{$processed} memiliki tanggal tidak valid: {$rawDate}");
            }
        }

        $tags = collect(preg_split('/\s+/', (string) ($record['hastag'] ?? '')) ?: [])
            ->map(fn (?string $tag) => ltrim(trim((string) $tag), '#'))
            ->filter()
            ->unique()
            ->take(12)
            ->implode(',');

        $paragraphs = collect(preg_split('/\R{2,}/u', $narrative) ?: [])
            ->map(fn (?string $line) => trim((string) $line))
            ->filter(function (string $line) {
                $lower = Str::lower($line);

                return $line !== ''
                    && ! Str::contains($lower, 'alamat email anda tidak akan dipublikasikan')
                    && ! Str::contains($lower, 'simpan nama, email, dan situs web saya');
            })
            ->values();

        if ($paragraphs->isEmpty()) {
            $skipped++;
            $this->warn("Baris #{$processed} dilewati karena narasi tidak memiliki konten yang bisa ditampilkan.");

            continue;
        }

        $content = $paragraphs
            ->map(fn (string $paragraph) => '<p>' . e($paragraph) . '</p>')
            ->implode("\n");

        $views = (int) preg_replace('/\D+/', '', (string) ($record['views'] ?? '0'));
        $existingPost = Post::query()->where('slug', $slug)->first();

        $post = Post::query()->updateOrCreate(
            ['slug' => $slug],
            [
                'user_id' => $author->id,
                'category_id' => $category->id,
                'title' => Str::limit($title, 255, ''),
                'content' => $content,
                'tags' => $tags !== '' ? Str::limit($tags, 255, '') : null,
                'type' => 'post',
                'status' => 1,
                'read' => $views,
                'penulis' => trim((string) ($record['penulis'] ?? '')) ?: $author->name,
                'published_at' => $publishedAt,
            ]
        );

        if ($existingPost) {
            $updated++;
        } else {
            $created++;
        }

        $storedImagePath = null;
        $localImage = trim((string) ($record['gambar_lokal'] ?? ''));
        if ($localImage !== '') {
            $normalizedLocalPath = ltrim(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $localImage), DIRECTORY_SEPARATOR);
            $fullLocalImagePath = base_path('scrape_prokopim' . DIRECTORY_SEPARATOR . $normalizedLocalPath);

            if (is_file($fullLocalImagePath)) {
                $extension = strtolower(pathinfo($fullLocalImagePath, PATHINFO_EXTENSION) ?: 'jpg');
                $targetPath = 'posts/' . $post->slug . '.' . $extension;
                Storage::disk('public')->put($targetPath, file_get_contents($fullLocalImagePath));
                $storedImagePath = $targetPath;
            }
        }

        if ($storedImagePath === null) {
            $remoteImage = trim((string) ($record['gambar'] ?? ''));
            if ($remoteImage !== '' && filter_var($remoteImage, FILTER_VALIDATE_URL)) {
                $imageResponse = Http::timeout(30)->retry(2, 500)->get($remoteImage);
                if ($imageResponse->successful()) {
                    $extension = strtolower(pathinfo((string) parse_url($remoteImage, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg');
                    $targetPath = 'posts/' . $post->slug . '.' . $extension;
                    Storage::disk('public')->put($targetPath, $imageResponse->body());
                    $storedImagePath = $targetPath;
                }
            }
        }

        if ($storedImagePath !== null) {
            $file = $post->file_id ? File::query()->find($post->file_id) : null;

            if ($file) {
                $file->fill([
                    'name' => basename($storedImagePath),
                    'type' => 'image',
                    'path' => $storedImagePath,
                    'disk' => 'public',
                    'user_id' => $author->id,
                    'field' => 'image',
                ])->save();
            } else {
                $file = File::query()->create([
                    'name' => basename($storedImagePath),
                    'type' => 'image',
                    'path' => $storedImagePath,
                    'disk' => 'public',
                    'user_id' => $author->id,
                    'field' => 'image',
                ]);
            }

            if ($post->file_id !== $file->id) {
                $post->forceFill(['file_id' => $file->id])->save();
            }

            $syncedImages++;
        }
    }

    fclose($handle);

    $this->newLine();
    $this->info('Import scrape_prokopim selesai.');
    $this->line("- diproses: {$processed}");
    $this->line("- dibuat: {$created}");
    $this->line("- diperbarui: {$updated}");
    $this->line("- dilewati: {$skipped}");
    $this->line("- gagal: {$failed}");
    $this->line("- gambar tersinkron: {$syncedImages}");

    return $failed > 0 ? 1 : 0;
})->purpose('Import CSV hasil scrape_prokopim ke posts dan files agar tampil di halaman berita');
