<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Agenda;
use App\Models\DynamicPage;
use App\Models\File;
use App\Models\PpidAbout;
use App\Models\Ppid;
use App\Models\PpidItem;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use App\Models\WebsiteIdentity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LegacyWebsiteImportService
{
    private const USER_AGENT = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36';

    private string $baseUrl = 'https://PROKOPIMmahulu.com';

    private bool $downloadMedia = true;

    private User $author;

    public function import(string $baseUrl, int $newsLimit = 0, bool $downloadMedia = true, ?callable $logger = null): array
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->downloadMedia = $downloadMedia;
        $this->author = $this->resolveAuthor();

        $summary = [
            'website_identity' => 0,
            'services' => 0,
            'sliders' => 0,
            'agenda' => 0,
            'dynamic_pages' => 0,
            'ppid_about' => 0,
            'dokumen_categories' => 0,
            'dokumen_items' => 0,
            'regulasi_categories' => 0,
            'regulasi_items' => 0,
            'ppid_categories' => 0,
            'ppid_items' => 0,
            'posts' => 0,
            'post_failures' => 0,
        ];

        $homeHtml = $this->fetch('/home');
        if ($homeHtml !== null) {
            $summary['website_identity'] = $this->importWebsiteIdentity($homeHtml);
            $summary['services'] = $this->importServices($homeHtml, $logger);
            $summary['sliders'] = $this->importSliders($homeHtml, $logger);
        }

        $agendaHtml = $this->fetch('/agenda');
        if ($agendaHtml !== null) {
            $summary['agenda'] = $this->importAgenda($agendaHtml);
        }

        $summary['dynamic_pages'] = $this->importProfilePages($logger);

        $ppidHtml = $this->fetch('/ppid/tentang-ppid');
        if ($ppidHtml !== null) {
            $summary['ppid_about'] = $this->importPpidAbout($ppidHtml);
        }

        $collectionSummary = $this->importDocumentCollections($logger);
        $summary = array_merge($summary, $collectionSummary);

        $newsHtml = $this->fetch('/berita-PROKOPIM');
        if ($newsHtml !== null) {
            ['imported' => $imported, 'failed' => $failed] = $this->importPosts($newsHtml, $newsLimit, $logger);
            $summary['posts'] = $imported;
            $summary['post_failures'] = $failed;
        }

        return $summary;
    }

    private function importWebsiteIdentity(string $html): int
    {
        $site = WebsiteIdentity::query()->latest('id')->first() ?? new WebsiteIdentity();

        $surveyLink = $this->findLinkByText($html, 'ISI SURVEY KEPUASAN');

        $site->fill([
            'name' => 'MAHAKAM ULU',
            'description' => 'Protokol dan Komunikasi Pimpinan Kabupaten Mahakam Ulu',
            'welcome_title' => 'PROKOPIM',
            'welcome_subtitle' => 'Mahulu Melaju: Maju, Merata, Berkelanjutan',
            'header_contact_text' => "Jam Pelayanan : Senin - Jum'at, 08:00 - 17:00",
            'phone' => '0853-4559-2345',
            'whatsapp' => '0853-4559-2345',
            'email' => '-@gmail.com',
            'address' => 'Komplek Perkantoran Semi Permanen Ujoh Bilang',
            'instagram' => 'https://www.instagram.com/PROKOPIMmahulu/',
            'youtube' => 'https://www.youtube.com/@PROKOPIM.mahulu',
            'survey_link_url' => $surveyLink,
            'survey_link_status' => filled($surveyLink),
            'footer_links_related' => [
                ['label' => 'KEMENTERIAN PRESIDEN', 'url' => 'https://www.setneg.go.id/'],
                ['label' => 'KEMENDAGRI RI', 'url' => 'https://pelita.kemendagri.go.id/'],
                ['label' => 'KEMENKEU RI', 'url' => 'https://www.kemenkeu.go.id/'],
                ['label' => 'BAPPENAS RI', 'url' => 'https://www.bappenas.go.id/'],
                ['label' => 'PROKOPIM KALTIM', 'url' => 'https://bappeda.kaltimprov.go.id/beranda'],
                ['label' => 'BPS PUSAT', 'url' => 'https://www.bps.go.id/id'],
                ['label' => 'BPS KALTIM', 'url' => 'https://kaltim.bps.go.id/id'],
            ],
            'footer_links_city' => [
                ['label' => 'Balikpapan', 'url' => 'https://bappeda.balikpapan.go.id/'],
                ['label' => 'Bontang', 'url' => 'https://www.instagram.com/ppidbapperidabontang/'],
                ['label' => 'Samarinda', 'url' => 'https://bapperida.samarindakota.go.id/web'],
            ],
            'footer_links_regency' => [
                ['label' => 'Kutai Barat', 'url' => 'http://bappedalitbang.kutaibaratkab.go.id/'],
                ['label' => 'Kutai Kartanegara', 'url' => 'https://www.instagram.com/bappeda.kutaikartanegara/'],
                ['label' => 'Kutai Timur', 'url' => 'https://www.instagram.com/bappeda_kutim/'],
                ['label' => 'Berau', 'url' => 'http://baplitbang.beraukab.go.id/'],
                ['label' => 'Penajam Paser Utara', 'url' => 'https://bapelitbang.penajamkab.go.id/'],
                ['label' => 'Paser', 'url' => 'https://bappedalitbang.paserkab.go.id/'],
            ],
        ]);

        $site->save();

        return 1;
    }

    private function importServices(string $html, ?callable $logger): int
    {
        $serviceLinks = [];

        foreach ($this->extractLinks($html) as $link) {
            if (! $this->isExternalServiceLink($link['label'], $link['url'])) {
                continue;
            }

            $serviceLinks[$link['url']] = $link;
        }

        $count = 0;
        foreach ($serviceLinks as $link) {
            Service::query()->updateOrCreate(
                ['link' => $link['url']],
                [
                    'name' => $link['label'],
                    'description' => 'Imported from legacy public website',
                    'status' => true,
                ]
            );
            $count++;
        }

        $this->log($logger, sprintf('Imported %d service links', $count));

        return $count;
    }

    private function importSliders(string $html, ?callable $logger): int
    {
        $heroSlice = $this->sliceHtml($html, null, 'BERITA TERBARU') ?? $html;
        $images = collect($this->extractImages($heroSlice))
            ->filter(fn (string $url) => str_contains($url, '/assets/'))
            ->reject(fn (string $url) => str_contains($url, 'Mahakam_Ulu.png') || str_contains($url, 'logo_ak'))
            ->unique()
            ->take(3)
            ->values();

        $count = 0;
        foreach ($images as $index => $url) {
            $slider = Slider::query()->updateOrCreate(
                ['link' => $url],
                [
                    'caption' => $index === 0 ? 'PROKOPIM Mahulu' : 'Slider ' . ($index + 1),
                    'description' => 'Imported from legacy homepage',
                    'status' => 1,
                    'is_pinned' => $index === 0,
                ]
            );

            $this->syncMorphFile($slider, $url, 'sliders', Str::slug($slider->caption ?: 'slider-' . $slider->id));
            $count++;
        }

        $this->log($logger, sprintf('Imported %d homepage sliders', $count));

        return $count;
    }

    private function importAgenda(string $html): int
    {
        $rows = $this->extractTableRows($html);
        $count = 0;

        foreach ($rows as $row) {
            if (count($row) < 5) {
                continue;
            }

            $caption = trim($row[1] ?? '');
            $date = trim($row[4] ?? '');

            if ($caption === '' || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                continue;
            }

            Agenda::query()->updateOrCreate(
                [
                    'caption' => $caption,
                    'schedule' => Carbon::parse($date)->startOfDay(),
                ],
                [
                    'description' => trim($row[2] ?? '') !== '-' ? trim($row[2] ?? '') : null,
                    'location' => trim($row[3] ?? '') !== '-' ? trim($row[3] ?? '') : 'Mahakam Ulu',
                ]
            );

            $count++;
        }

        return $count;
    }

    private function importPpidAbout(string $html): int
    {
        $text = $this->cleanText($html);
        $body = $this->sliceText($text, 'TENTANG PPID', 'LINK TERKAIT')
            ?? $this->sliceText($text, 'TENTANG PPID', 'STATISTIK PENGUNJUNG')
            ?? '';

        $body = trim(str_replace('TENTANG PPID', '', $body));
        if ($body === '') {
            return 0;
        }

        $about = PpidAbout::query()->latest('id')->first() ?? new PpidAbout();
        $about->fill([
            'profil' => $body,
            'content' => $body,
        ]);
        $about->save();

        return 1;
    }

    private function importProfilePages(?callable $logger): int
    {
        $definitions = [
            [
                'source' => '/profil/visi-misi',
                'slug' => 'visi-misi',
                'title' => 'Visi & Misi',
                'template' => 'penjelasan_2',
                'left' => 'visi',
                'right' => 'misi',
            ],
            [
                'source' => '/profil/tujuan-sasaran',
                'slug' => 'tujuan-sasaran',
                'title' => 'Tujuan & Sasaran',
                'template' => 'penjelasan_2',
                'left' => 'tujuan',
                'right' => 'sasaran',
            ],
            [
                'source' => '/profil/tugas-pokok-fungsi',
                'slug' => 'tupoksi',
                'title' => 'Tupoksi',
                'source_heading' => 'Tugas Pokok & Fungsi',
                'template' => 'penjelasan_2',
                'left' => 'tugas pokok',
                'right' => 'fungsi',
            ],
            [
                'source' => '/profil/motto-maklumat-pelayanan',
                'slug' => 'motto',
                'title' => 'Motto & Maklumat Pelayanan',
                'template' => 'penjelasan_2',
                'left' => 'motto',
                'right' => 'maklumat pelayanan',
            ],
            [
                'source' => '/profil/struktur-organisasi',
                'slug' => 'struktur',
                'title' => 'Struktur Organisasi',
                'template' => 'penjelasan_1',
            ],
        ];

        $count = 0;

        foreach ($definitions as $definition) {
            $html = $this->fetch($definition['source']);
            if ($html === null) {
                continue;
            }

            $payload = $this->extractProfilePayload($html, $definition);
            if ($payload === null) {
                continue;
            }

            DynamicPage::query()->updateOrCreate(
                ['slug' => $definition['slug']],
                [
                    'title' => $definition['title'],
                    'template' => $definition['template'],
                    'content' => $payload,
                    'meta_title' => $definition['title'],
                    'meta_desc' => $payload['subtitle'] ?? Str::limit(strip_tags($payload['isi_konten'] ?? $payload['box_1_content'] ?? ''), 160),
                    'published' => true,
                ]
            );

            $count++;
            $this->log($logger, sprintf('Imported profile page: %s', $definition['title']));
        }

        return $count;
    }

    private function importDocumentCollections(?callable $logger): array
    {
        $definitions = [
            ['section' => 'dokumen', 'slug' => 'renstra', 'name' => 'Renstra', 'source' => '/renstra/dokumen'],
            ['section' => 'dokumen', 'slug' => 'renja', 'name' => 'Renja', 'source' => '/renja/dokumen'],
            ['section' => 'dokumen', 'slug' => 'dpa', 'name' => 'DPA', 'source' => '/dpa/dokumen'],
            ['section' => 'dokumen', 'slug' => 'iku', 'name' => 'IKU', 'source' => '/iku/dokumen'],
            ['section' => 'dokumen', 'slug' => 'sop', 'name' => 'SOP', 'source' => '/sop/dokumen'],
            ['section' => 'dokumen', 'slug' => 'sakip', 'name' => 'Laporan LKJIP', 'source' => '/laporan-lkjip/dokumen'],
            ['section' => 'dokumen', 'slug' => 'rkpd', 'name' => 'RKPD', 'source' => '/rkpd/dokumen'],
            ['section' => 'dokumen', 'slug' => 'rpjpd', 'name' => 'RPJPD', 'source' => '/rpjpd/dokumen'],
            ['section' => 'dokumen', 'slug' => 'rpjmd', 'name' => 'RPJMD', 'source' => '/rpjmd/dokumen'],
            ['section' => 'regulasi', 'slug' => 'undang-undang', 'name' => 'Undang Undang', 'source' => '/undang-undang/dokumen'],
            ['section' => 'regulasi', 'slug' => 'peraturan-menteri', 'name' => 'Peraturan Menteri', 'source' => '/peraturan-menteri/dokumen'],
            ['section' => 'regulasi', 'slug' => 'peraturan-daerah', 'name' => 'Peraturan Daerah', 'source' => '/peraturan-daerah/dokumen'],
            ['section' => 'regulasi', 'slug' => 'peraturan-bupati', 'name' => 'Peraturan Bupati', 'source' => '/peraturan-bupati/dokumen'],
            ['section' => 'regulasi', 'slug' => 'sk-bupati', 'name' => 'SK Bupati', 'source' => '/sk-bupati/dokumen'],
            ['section' => 'regulasi', 'slug' => 'sk-kepala', 'name' => 'SK Kepala', 'source' => '/sk-kepala/dokumen'],
            ['section' => 'regulasi', 'slug' => 'lain-lain', 'name' => 'Lain Lain', 'source' => '/lain-lain/dokumen'],
            ['section' => 'ppid', 'slug' => 'berkala', 'name' => 'Informasi Berkala', 'source' => '/informasi-berkala/dokumen'],
            ['section' => 'ppid', 'slug' => 'serta-merta', 'name' => 'Informasi Serta Merta', 'source' => '/informasi-serta-merta/dokumen'],
            ['section' => 'ppid', 'slug' => 'setiap-saat', 'name' => 'Informasi Setiap Saat', 'source' => '/informasi-setiap-saat/dokumen'],
            ['section' => 'ppid', 'slug' => 'dikecualikan', 'name' => 'Informasi Dikecualikan', 'source' => '/informasi-dikecualikan/dokumen'],
        ];

        $summary = [
            'dokumen_categories' => 0,
            'dokumen_items' => 0,
            'regulasi_categories' => 0,
            'regulasi_items' => 0,
            'ppid_categories' => 0,
            'ppid_items' => 0,
        ];

        foreach ($definitions as $definition) {
            $page = Ppid::query()->firstOrNew([
                'name' => $definition['name'],
                'parent_id' => null,
            ]);

            $html = $this->fetch($definition['source']);
            if ($html === null) {
                $page->fill([
                    'description' => sprintf('Kategori %s %s dari website lama. Halaman sumber tidak dapat diakses saat import.', $definition['section'], $definition['slug']),
                    'penanggung_jawab' => strtoupper($definition['section']),
                ]);
                $page->save();

                $summary[$definition['section'] . '_categories']++;
                $this->log($logger, sprintf('Source unavailable for %s', $definition['name']));
                continue;
            }

            $rows = $this->extractDownloadRows($html);
            $importedRows = 0;
            $failedRows = 0;

            $baseDescription = count($rows) > 0
                ? sprintf('Kategori %s %s dari website lama', $definition['section'], $definition['slug'])
                : sprintf('Kategori %s %s dari website lama. Tidak ada item publik yang terdeteksi saat import.', $definition['section'], $definition['slug']);

            $page->fill([
                'description' => $baseDescription,
                'penanggung_jawab' => strtoupper($definition['section']),
            ]);
            $page->save();

            $summary[$definition['section'] . '_categories']++;

            foreach ($rows as $row) {
                try {
                    PpidItem::query()->updateOrCreate(
                        [
                            'ppid_id' => $page->id,
                            'name' => $row['title'],
                        ],
                        [
                            'description' => trim(sprintf("%s\n\nImported from legacy %s page %s", $row['full_title'], $definition['section'], $definition['name'])),
                            'penanggung_jawab' => $row['classification'],
                            'format_informasi' => $row['format'],
                            'tanggal_pembuatan' => $row['date'],
                            'jangka_waktu_penyimpanan' => $row['classification'],
                            'file' => $row['download_url'],
                        ]
                    );

                    $summary[$definition['section'] . '_items']++;
                    $importedRows++;
                } catch (\Throwable $exception) {
                    $failedRows++;
                    $this->log($logger, sprintf('Failed %s item for %s: %s', $definition['section'], $definition['name'], $exception->getMessage()));
                }
            }

            $finalDescription = $baseDescription;
            if ($failedRows > 0) {
                $finalDescription = trim($finalDescription . sprintf(' Sebagian item gagal diimport (%d gagal, %d berhasil).', $failedRows, $importedRows));
            }

            if ($page->description !== $finalDescription) {
                $page->forceFill([
                    'description' => $finalDescription,
                ])->save();
            }

            $this->log($logger, sprintf('Imported %d %s items for %s', $importedRows, $definition['section'], $definition['name']));
        }

        return $summary;
    }

    private function importPosts(string $listingHtml, int $limit, ?callable $logger): array
    {
        $category = PostCategory::query()->firstOrCreate(
            ['slug' => 'berita'],
            ['name' => 'Berita', 'active' => true]
        );

        $links = collect($this->extractLinks($listingHtml))
            ->filter(function (array $link) {
                return str_starts_with($link['url'], $this->baseUrl . '/berita/')
                    && ! str_contains($link['url'], '/kategori/')
                    && ! str_contains(Str::upper($link['label']), 'BACA SELENGKAPNYA')
                    && mb_strlen($link['label']) > 8;
            })
            ->unique('url')
            ->values();

        if ($limit > 0) {
            $links = $links->take($limit)->values();
        }

        $imported = 0;
        $failed = 0;

        foreach ($links as $link) {
            try {
                $detailHtml = $this->fetch($link['url']);
                if ($detailHtml === null) {
                    $failed++;
                    continue;
                }

                $article = $this->extractArticle($detailHtml, $link);
                if ($article['content'] === '') {
                    $failed++;
                    continue;
                }

                $post = Post::query()->updateOrCreate(
                    ['slug' => $article['slug']],
                    [
                        'user_id' => $this->author->id,
                        'category_id' => $category->id,
                        'title' => $article['title'],
                        'content' => $article['content'],
                        'type' => 'post',
                        'status' => 1,
                        'read' => $article['views'],
                        'penulis' => 'Admin',
                        'published_at' => $article['published_at'],
                    ]
                );

                if ($article['image_url']) {
                    $file = $this->syncStandaloneFile($post->file_id ? File::find($post->file_id) : null, $article['image_url'], 'posts', $article['slug']);
                    if ($file) {
                        $post->forceFill(['file_id' => $file->id])->save();
                    }
                }

                $imported++;
                $this->log($logger, sprintf('Imported news: %s', $article['title']));
            } catch (\Throwable $exception) {
                $failed++;
                $this->log($logger, sprintf('Failed news import for %s: %s', $link['url'], $exception->getMessage()));
            }
        }

        return ['imported' => $imported, 'failed' => $failed];
    }

    private function extractArticle(string $html, array $fallback): array
    {
        $text = $this->cleanText($html);
        $title = trim($fallback['label']);
        $slug = Str::after($fallback['url'], $this->baseUrl . '/berita/');
        $imageUrl = collect($this->extractImages($html))
            ->reject(fn (string $url) => str_contains($url, 'Mahakam_Ulu.png') || str_contains($url, 'logo_ak'))
            ->first(fn (string $url) => str_contains($url, '/assets/'));

        $date = null;
        if (preg_match('/\b(\d{4}-\d{2}-\d{2})\b/u', $text, $matches)) {
            $date = Carbon::parse($matches[1]);
        } elseif (preg_match('/\b(\d{2}-\d{2}-\d{4})\b/u', $text, $matches)) {
            $date = Carbon::createFromFormat('d-m-Y', $matches[1]);
        }

        $views = 0;
        if ($date && preg_match('/' . preg_quote($date->format('Y-m-d'), '/') . '\s+(\d{1,6})/u', $text, $matches)) {
            $views = (int) $matches[1];
        }

        $contentText = $this->sliceText($text, $title, 'TAGGED')
            ?? $this->sliceText($text, $title, 'BERITA TERPOPULER')
            ?? $this->sliceText($text, $title, 'LINK TERKAIT')
            ?? '';

        $contentText = trim($contentText);
        $contentText = preg_replace('/^(BERITA\s+)?\d{4}-\d{2}-\d{2}\s+\d+\s*/u', '', $contentText);
        $contentText = preg_replace('/^(BERITA\s+)?\d{2}-\d{2}-\d{4}\s+\d+\s*/u', '', $contentText);
        $contentText = trim(str_replace($title, '', $contentText));

        $paragraphs = collect(preg_split('/\n{2,}/u', $contentText) ?: [])
            ->map(fn (?string $line) => trim((string) $line))
            ->filter(fn (string $line) => $line !== '' && ! str_starts_with($line, '#'))
            ->values();

        $htmlContent = $paragraphs
            ->map(fn (string $paragraph) => '<p>' . e($paragraph) . '</p>')
            ->implode("\n");

        return [
            'slug' => $slug,
            'title' => $title,
            'content' => $htmlContent,
            'published_at' => $date,
            'views' => $views,
            'image_url' => $imageUrl ? $this->absoluteUrl($imageUrl) : null,
        ];
    }

    private function resolveAuthor(): User
    {
        return User::query()->first() ?? User::query()->create([
            'name' => 'Legacy Import',
            'username' => 'legacy-import',
            'email' => 'legacy-import@mahulu.local',
            'password' => Str::random(32),
            'role' => UserRole::SuperAdmin,
        ]);
    }

    private function extractProfilePayload(string $html, array $definition): ?array
    {
        $text = $this->cleanText($html);
        $sourceHeading = $definition['source_heading'] ?? $definition['title'];
        $body = $this->sliceText($text, 'Profil \ ' . $sourceHeading, 'LINK TERKAIT')
            ?? $this->sliceText($text, $sourceHeading, 'LINK TERKAIT')
            ?? $this->sliceText($text, mb_strtoupper($sourceHeading), 'LINK TERKAIT');

        if ($body === null) {
            return null;
        }

        $body = trim(str_ireplace($sourceHeading, '', $body));
        $body = $this->stripLegacyProfileFooter($body);

        if ($definition['template'] === 'penjelasan_2') {
            $panels = $this->extractTwoPanelSections($body, $definition['left'], $definition['right']);
            if ($panels === null) {
                return null;
            }

            return [
                'subtitle' => 'Konten hasil migrasi dari website lama.',
                'box_1_title' => Str::headline($definition['left']),
                'box_1_content' => $this->plainTextToHtml($panels['left']),
                'box_2_title' => Str::headline($definition['right']),
                'box_2_content' => $this->plainTextToHtml($panels['right']),
            ];
        }

        $images = collect($this->extractImages($html))
            ->reject(fn (string $url) => str_contains($url, 'Mahakam_Ulu.png') || str_contains($url, 'logo_ak'))
            ->filter(fn (string $url) => str_contains($url, '/assets/'))
            ->values();

        $contentHtml = $this->plainTextToHtml($body);

        if ($images->isNotEmpty() && ! str_contains($contentHtml, '<img')) {
            $contentHtml .= "\n<p><img src=\"" . e($images->first()) . "\" alt=\"" . e($definition['title']) . "\"></p>";
        }

        return [
            'judul' => $definition['title'],
            'isi_konten' => $contentHtml,
        ];
    }

    private function extractTwoPanelSections(string $body, string $leftMarker, string $rightMarker): ?array
    {
        $pattern = '/' . preg_quote($leftMarker, '/') . '\s+(.*?)\s+' . preg_quote($rightMarker, '/') . '\s+(.*)$/isu';
        if (! preg_match($pattern, $body, $matches)) {
            return null;
        }

        return [
            'left' => trim((string) $matches[1]),
            'right' => trim((string) $matches[2]),
        ];
    }

    private function extractDownloadRows(string $html): array
    {
        if (! preg_match_all('/<tr[^>]*>(.*?)<\/tr>/isu', $html, $matches, PREG_SET_ORDER)) {
            return [];
        }

        return collect($matches)
            ->map(function (array $match) {
                $rowHtml = $match[1];

                preg_match_all('/<td[^>]*>(.*?)<\/td>/isu', $rowHtml, $cellMatches);
                $cells = collect($cellMatches[1] ?? [])
                    ->map(fn (string $cell) => trim(html_entity_decode(strip_tags($cell), ENT_QUOTES | ENT_HTML5, 'UTF-8')))
                    ->values();

                $rawTitle = preg_replace('/\s+/u', ' ', trim((string) ($cells[1] ?? '')));
                $title = Str::limit($rawTitle, 240, '');
                $classification = trim((string) ($cells[2] ?? ''));

                preg_match('/name="dokumen"[^>]+value="([^"]*)"/isu', $rowHtml, $documentMatch);
                preg_match('/name="nama"[^>]+value="([^"]*)"/isu', $rowHtml, $nameMatch);

                $document = html_entity_decode($documentMatch[1] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $name = html_entity_decode($nameMatch[1] ?? $title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $format = strtoupper(pathinfo($document, PATHINFO_EXTENSION) ?: 'FILE');

                if ($title === '' || $document === '') {
                    return null;
                }

                return [
                    'title' => $title,
                    'full_title' => $rawTitle,
                    'classification' => $classification !== '' ? $classification : 'tersedia',
                    'format' => $format,
                    'date' => $this->extractDateFromText($title),
                    'download_url' => $this->baseUrl . '/download?' . http_build_query([
                        'dokumen' => $document,
                        'nama' => $name,
                    ]),
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    private function extractDateFromText(string $text): ?string
    {
        if (preg_match('/\b(20\d{2})\b/u', $text, $matches)) {
            return $matches[1] . '-01-01';
        }

        return null;
    }

    private function stripLegacyProfileFooter(string $body): string
    {
        $body = preg_replace('/\s*×\s*PROKOPIM\s+Kab\.?\s*MAHULU.*$/isu', '', $body) ?? $body;

        foreach ([
            "\n×",
            'Komplek Perkantoran Semi Permanen Ujoh Bilang',
            '0853-4559-2345',
            '-@gmail.com',
            'PROKOPIM Kab MAHULU',
            'PROKOPIM Kab. MAHULU',
        ] as $marker) {
            $position = mb_stripos($body, $marker);
            if ($position !== false) {
                return trim(mb_substr($body, 0, $position));
            }
        }

        return trim($body);
    }

    private function plainTextToHtml(string $text): string
    {
        return collect(preg_split('/\n{2,}/u', trim($text)) ?: [])
            ->map(fn (?string $paragraph) => trim((string) $paragraph))
            ->filter()
            ->map(fn (string $paragraph) => '<p>' . e($paragraph) . '</p>')
            ->implode("\n");
    }

    private function fetch(string $pathOrUrl): ?string
    {
        $url = Str::startsWith($pathOrUrl, ['http://', 'https://'])
            ? $pathOrUrl
            : $this->baseUrl . '/' . ltrim($pathOrUrl, '/');

        $response = Http::withUserAgent(self::USER_AGENT)
            ->withHeaders([
                'Accept-Language' => 'id,en-US;q=0.9,en;q=0.8',
                'Referer' => $this->baseUrl,
            ])
            ->timeout(30)
            ->retry(2, 500)
            ->get($url);

        if (! $response->successful()) {
            return null;
        }

        return $response->body();
    }

    private function extractLinks(string $html): array
    {
        if (! preg_match_all('/<a[^>]+href="([^"]+)"[^>]*>(.*?)<\/a>/isu', $html, $matches, PREG_SET_ORDER)) {
            return [];
        }

        return collect($matches)
            ->map(function (array $match) {
                $label = trim(html_entity_decode(strip_tags($match[2]), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                $url = $this->absoluteUrl(html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));

                return [
                    'label' => preg_replace('/\s+/u', ' ', $label),
                    'url' => $url,
                ];
            })
            ->filter(fn (array $item) => $item['label'] !== '' && $item['url'] !== '')
            ->values()
            ->all();
    }

    private function extractImages(string $html): array
    {
        if (! preg_match_all('/<img[^>]+src="([^"]+)"/isu', $html, $matches)) {
            return [];
        }

        return collect($matches[1])
            ->map(fn (string $url) => $this->absoluteUrl(html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8')))
            ->values()
            ->all();
    }

    private function extractTableRows(string $html): array
    {
        if (! preg_match_all('/<tr[^>]*>(.*?)<\/tr>/isu', $html, $rows)) {
            return [];
        }

        return collect($rows[1])
            ->map(function (string $rowHtml) {
                preg_match_all('/<td[^>]*>(.*?)<\/td>/isu', $rowHtml, $cells);

                return collect($cells[1] ?? [])
                    ->map(fn (string $cell) => trim(html_entity_decode(strip_tags($cell), ENT_QUOTES | ENT_HTML5, 'UTF-8')))
                    ->filter(fn (string $cell) => $cell !== '')
                    ->values()
                    ->all();
            })
            ->filter(fn (array $cells) => $cells !== [])
            ->values()
            ->all();
    }

    private function cleanText(string $html): string
    {
        $prepared = preg_replace('/<(br|\/p|\/div|\/section|\/article|\/li|\/h[1-6])>/iu', "$0\n", $html);
        $prepared = preg_replace('/<(script|style).*?<\/\1>/isu', '', (string) $prepared);
        $text = html_entity_decode(strip_tags((string) $prepared), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $text = preg_replace('/\t+/u', ' ', $text);
        $text = preg_replace('/[ ]{2,}/u', ' ', $text);
        $text = preg_replace('/\n{3,}/u', "\n\n", $text);

        return trim((string) $text);
    }

    private function sliceText(string $text, string $start, string $end): ?string
    {
        $startPos = mb_stripos($text, $start);
        if ($startPos === false) {
            return null;
        }

        $slice = mb_substr($text, $startPos + mb_strlen($start));
        $endPos = mb_stripos($slice, $end);

        return $endPos === false ? trim($slice) : trim(mb_substr($slice, 0, $endPos));
    }

    private function sliceHtml(string $html, ?string $start, string $end): ?string
    {
        $slice = $html;

        if ($start !== null) {
            $startPos = stripos($html, $start);
            if ($startPos === false) {
                return null;
            }

            $slice = substr($html, $startPos + strlen($start));
        }

        $endPos = stripos($slice, $end);

        return $endPos === false ? $slice : substr($slice, 0, $endPos);
    }

    private function findLinkByText(string $html, string $needle): ?string
    {
        foreach ($this->extractLinks($html) as $link) {
            if (Str::contains(Str::upper($link['label']), Str::upper($needle))) {
                return $link['url'];
            }
        }

        return null;
    }

    private function absoluteUrl(string $url): string
    {
        if (Str::startsWith($url, ['http://', 'https://'])) {
            return $url;
        }

        if (Str::startsWith($url, '//')) {
            return 'https:' . $url;
        }

        return $this->baseUrl . '/' . ltrim($url, '/');
    }

    private function isExternalServiceLink(string $label, string $url): bool
    {
        if (Str::startsWith($url, $this->baseUrl)) {
            return false;
        }

        $haystack = Str::lower($label . ' ' . $url);

        return Str::contains($haystack, [
            'sipd', 'lapor', 'srikandi', 'catalogue', 'catalog', 'lpse', 'sirup', 'e-musrenbang',
            'e-planning', 'e-monev', 'csr', 'simpel', 'spse', 'lkpp', 'bappenas', 'kemendagri',
        ]);
    }

    private function syncMorphFile(Model $owner, string $url, string $directory, string $nameBase): ?File
    {
        $path = $this->storeRemoteAsset($url, $directory, $nameBase);

        return File::query()->updateOrCreate(
            [
                'fileable_type' => $owner::class,
                'fileable_id' => $owner->getKey(),
            ],
            [
                'name' => basename($path),
                'type' => 'image',
                'path' => $path,
                'disk' => 'public',
                'user_id' => $this->author->id,
                'field' => 'image',
            ]
        );
    }

    private function syncStandaloneFile(?File $file, string $url, string $directory, string $nameBase): ?File
    {
        $path = $this->storeRemoteAsset($url, $directory, $nameBase);

        if ($file) {
            $file->fill([
                'name' => basename($path),
                'type' => 'image',
                'path' => $path,
                'disk' => 'public',
                'user_id' => $this->author->id,
                'field' => 'image',
            ])->save();

            return $file;
        }

        return File::query()->create([
            'name' => basename($path),
            'type' => 'image',
            'path' => $path,
            'disk' => 'public',
            'user_id' => $this->author->id,
            'field' => 'image',
        ]);
    }

    private function storeRemoteAsset(string $url, string $directory, string $nameBase): string
    {
        if (! $this->downloadMedia) {
            return $url;
        }

        $response = Http::withUserAgent(self::USER_AGENT)
            ->timeout(30)
            ->retry(2, 500)
            ->get($url);

        if (! $response->successful()) {
            return $url;
        }

        $extension = pathinfo(parse_url($url, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION) ?: 'bin';
        $filename = Str::slug($nameBase) . '.' . Str::lower($extension);
        $path = trim($directory, '/') . '/' . $filename;

        Storage::disk('public')->put($path, $response->body());

        return $path;
    }

    private function log(?callable $logger, string $message): void
    {
        if ($logger !== null) {
            $logger($message);
        }
    }
}
