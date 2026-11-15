<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Hapus teks menu website lama yang ikut terimpor ke halaman Profil > Struktur Organisasi.
 * Hanya paragraf yang isinya persis sama dengan label menu lama yang dihapus.
 */
return new class extends Migration
{
    private const LEGACY_MENU_LABELS = [
        'Peraturan / Regulasi', 'Undang - Undang', 'Peraturan Menteri', 'Peraturan Daerah',
        'Peraturan Bupati', 'SK Bupati', 'SK Kepala', 'Lain Lain', 'Dokumen', 'RENSTRA',
        'RENJA', 'DPA', 'IKU', 'SOP', 'Laporan LKJIP', 'RKPD', 'RPJPD', 'RPJMD', 'PPID',
        'Tentang PPID', 'Informasi Berkala', 'Informasi Serta Merta', 'Informasi Dikecualikan',
        'Informasi Setiap Saat', 'BERANDA', 'Profil \\', 'Profil',
    ];

    public function up(): void
    {
        $page = DB::table('dynamic_pages')->where('slug', 'struktur')->first();

        if (! $page) {
            return;
        }

        $content = json_decode((string) $page->content, true);

        if (! is_array($content) || ! isset($content['isi_konten']) || ! is_string($content['isi_konten'])) {
            return;
        }

        $labels = array_map(fn ($label) => mb_strtolower(trim($label)), self::LEGACY_MENU_LABELS);

        $cleaned = preg_replace_callback('#<p>(.*?)</p>\s*#s', function (array $m) use ($labels) {
            $text = mb_strtolower(trim(html_entity_decode(strip_tags($m[1]))));

            return in_array($text, $labels, true) ? '' : $m[0];
        }, $content['isi_konten']);

        $update = [];

        if ($cleaned !== null && $cleaned !== $content['isi_konten']) {
            $content['isi_konten'] = trim($cleaned);
            $update['content'] = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        if (str_starts_with((string) $page->meta_desc, 'Peraturan / Regulasi')) {
            $update['meta_desc'] = 'Struktur Organisasi Bagian Protokol dan Komunikasi Pimpinan (PROKOPIM) Kabupaten Mahakam Ulu.';
        }

        if ($update !== []) {
            $update['updated_at'] = now();
            DB::table('dynamic_pages')->where('id', $page->id)->update($update);
        }
    }

    public function down(): void
    {
        // Pembersihan data tidak dikembalikan.
    }
};
