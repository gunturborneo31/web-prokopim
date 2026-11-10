<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Imports news exported from the old WordPress site (berita-2026.json) into posts + files.
 *
 * Safe to re-run: posts whose slug or title already exist are skipped, never overwritten.
 * Each post (and its featured-image row) is saved inside its own transaction.
 */
class ImportWordpressBerita extends Command
{
    protected $signature = 'wp:import-berita
        {--file= : Path ke berita-2026.json (folder gambar-utama/ harus ada di sebelahnya)}
        {--dry-run : Hanya tampilkan apa yang akan diimpor, tanpa menyimpan apa pun}
        {--include-draft : Ikut impor berita berstatus draft (disimpan sebagai tidak tayang)}
        {--limit=0 : Batasi jumlah berita baru yang diimpor (0 = semua)}';

    protected $description = 'Impor berita dari ekspor WordPress lama (JSON) ke posts dan files tanpa menimpa berita yang sudah ada';

    /** Old WordPress categories that only describe placement, not topic, so they are not kept as tags. */
    private const NON_TOPIC_CATEGORIES = ['berita terkini', 'pengumuman', 'uncategorized'];

    public function handle(): int
    {
        $path = (string) $this->option('file');
        if ($path === '' || ! is_file($path)) {
            $this->error('File JSON tidak ditemukan. Contoh: --file="C:\Users\kamin\Downloads\berita-prokopim-2026\berita-2026.json"');

            return self::FAILURE;
        }

        $items = json_decode((string) file_get_contents($path), true);
        if (! is_array($items)) {
            $this->error('Isi file bukan JSON yang valid.');

            return self::FAILURE;
        }

        $baseDir = dirname(realpath($path));
        $dryRun = (bool) $this->option('dry-run');
        $includeDraft = (bool) $this->option('include-draft');
        $limit = max(0, (int) $this->option('limit'));

        $author = User::query()->orderBy('id')->first();
        $berita = PostCategory::query()->where('slug', 'berita')->first();
        $pengumuman = PostCategory::query()->where('slug', 'pengumuman')->first();
        if (! $author || ! $berita) {
            $this->error('User admin atau kategori "berita" belum ada di database.');

            return self::FAILURE;
        }

        $existingTitles = Post::query()->pluck('title')->map(fn ($t) => $this->normalizeTitle($t))->flip();
        $existingSlugs = Post::query()->pluck('slug')->flip();

        $stats = ['dibuat' => 0, 'sudah_ada' => 0, 'draft_dilewati' => 0, 'tanpa_gambar' => 0, 'gagal' => 0];

        foreach ($items as $item) {
            if ($limit > 0 && $stats['dibuat'] >= $limit) {
                break;
            }

            $title = trim(html_entity_decode((string) ($item['judul'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $label = ($item['tanggal'] ?? '?') . ' | ' . Str::limit($title, 70);

            if ($title === '') {
                $stats['gagal']++;
                $this->warn("Lewati (judul kosong): ID WP {$item['id']}");

                continue;
            }

            $isDraft = ($item['status'] ?? '') !== 'publish';
            if ($isDraft && ! $includeDraft) {
                $stats['draft_dilewati']++;
                $this->line("<comment>draft</comment>     {$label}");

                continue;
            }

            $slug = Str::limit(Str::slug(urldecode((string) ($item['slug'] ?? ''))) ?: Str::slug($title), 180, '');
            if ($existingTitles->has($this->normalizeTitle($title)) || $existingSlugs->has($slug)) {
                $stats['sudah_ada']++;
                $this->line("<fg=gray>sudah ada</> {$label}");

                continue;
            }

            $imageSource = null;
            if (! empty($item['gambar_utama_lokal'])) {
                $candidate = $baseDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $item['gambar_utama_lokal']);
                $imageSource = is_file($candidate) ? $candidate : null;
            }
            if (! $imageSource) {
                $stats['tanpa_gambar']++;
            }

            $isAnnouncement = $pengumuman && Str::contains(Str::lower((string) $item['kategori']), 'pengumuman');

            if ($dryRun) {
                $stats['dibuat']++;
                $this->line('<info>akan dibuat</info> ' . $label . ($imageSource ? '' : ' <comment>(tanpa gambar)</comment>'));
                $existingSlugs->put($slug, true);

                continue;
            }

            try {
                DB::transaction(function () use ($item, $title, $slug, $imageSource, $isDraft, $isAnnouncement, $author, $berita, $pengumuman) {
                    $publishedAt = Carbon::parse($item['tanggal']);

                    $post = new Post([
                        'user_id' => $author->id,
                        'category_id' => $isAnnouncement ? $pengumuman->id : $berita->id,
                        'title' => Str::limit($title, 255, ''),
                        'slug' => $slug,
                        'content' => $this->cleanContent((string) ($item['isi_html'] ?? '')),
                        'tags' => $this->buildTags($item),
                        'type' => 'post',
                        'status' => $isDraft ? 0 : 1,
                        'penulis' => trim((string) ($item['penulis'] ?? '')) ?: $author->name,
                        'published_at' => $publishedAt,
                    ]);
                    $post->created_at = $publishedAt;
                    $post->updated_at = $publishedAt;
                    $post->save();

                    if ($imageSource) {
                        $extension = strtolower(pathinfo($imageSource, PATHINFO_EXTENSION) ?: 'jpg');
                        $target = 'posts/' . $slug . '.' . $extension;
                        if (Storage::disk('public')->exists($target)) {
                            $target = 'posts/' . $slug . '-' . $item['id'] . '.' . $extension;
                        }
                        Storage::disk('public')->put($target, file_get_contents($imageSource));

                        $file = File::query()->create([
                            'name' => basename($target),
                            'type' => 'image',
                            'path' => $target,
                            'size' => filesize($imageSource),
                            'disk' => 'public',
                            'user_id' => $author->id,
                            'field' => 'image',
                        ]);
                        $post->forceFill(['file_id' => $file->id])->saveQuietly();
                    }
                });

                $existingSlugs->put($slug, true);
                $existingTitles->put($this->normalizeTitle($title), true);
                $stats['dibuat']++;
                $this->line("<info>dibuat</info>    {$label}");
            } catch (\Throwable $e) {
                $stats['gagal']++;
                $this->error("GAGAL     {$label}: {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info($dryRun ? 'SIMULASI selesai (tidak ada data yang disimpan).' : 'Impor selesai.');
        foreach ($stats as $key => $value) {
            $this->line(sprintf('- %s: %d', str_replace('_', ' ', $key), $value));
        }

        return $stats['gagal'] > 0 ? self::FAILURE : self::SUCCESS;
    }

    private function normalizeTitle(?string $title): string
    {
        $title = html_entity_decode((string) $title, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return preg_replace('/[^a-z0-9]/', '', Str::lower(Str::ascii($title))) ?? '';
    }

    /** Remove Gutenberg block comments and empty paragraphs; keep the rest of the HTML as-is. */
    private function cleanContent(string $html): string
    {
        $html = preg_replace('/<!--.*?-->/s', '', $html) ?? $html;
        $html = preg_replace('/<p>(\s|&nbsp;|\x{00A0})*<\/p>/u', '', $html) ?? $html;

        return trim(preg_replace("/\n{3,}/", "\n\n", $html) ?? $html);
    }

    private function buildTags(array $item): array
    {
        return collect(explode(',', (string) ($item['kategori'] ?? '')))
            ->merge(explode(',', (string) ($item['tag'] ?? '')))
            ->map(fn ($t) => trim(html_entity_decode($t, ENT_QUOTES | ENT_HTML5, 'UTF-8')))
            ->filter(fn ($t) => $t !== '' && ! in_array(Str::lower($t), self::NON_TOPIC_CATEGORIES, true))
            ->unique(fn ($t) => Str::lower($t))
            ->values()
            ->all();
    }
}
