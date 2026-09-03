<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Ppid;
use App\Models\PpidItem;
use Illuminate\Support\Str;

class DummyApiSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat User dummy jika belum ada
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Super Admin', 'password' => bcrypt('password')]
        );

        // 2. Buat Kategori Berita
        $category = PostCategory::firstOrCreate(
            ['slug' => 'berita-utama'],
            ['name' => 'Berita Utama']
        );

        // 3. Buat Berita
        Post::firstOrCreate(
            ['slug' => 'rapat-koordinasi-pembangunan-daerah-2026'],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Rapat Koordinasi Pembangunan Daerah 2026',
                'content' => '<p>Ini adalah contoh isi berita rapat koordinasi pembangunan daerah yang diselenggarakan pada tahun 2026.</p>',
                'status' => 1,
                'published_at' => now(),
                'penulis' => 'Humas Pemprov',
                'seo' => [
                    'title' => 'Rapat Koordinasi Pembangunan Daerah 2026',
                    'description' => 'Contoh deskripsi SEO untuk berita koordinasi pembangunan.',
                ]
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'kunjungan-kerja-gubernur-ke-desa-wisata'],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Kunjungan Kerja Gubernur ke Desa Wisata',
                'content' => '<p>Gubernur melakukan kunjungan kerja ke desa wisata untuk meninjau perkembangan ekonomi lokal.</p>',
                'status' => 1,
                'published_at' => now()->subDays(2),
                'penulis' => 'Humas Pemprov'
            ]
        );

        // 4. Buat PPID - Jenis 1 (Berkala)
        $jenisBerkala = Ppid::firstOrCreate(
            ['name' => 'Informasi Berkala'],
            ['description' => 'Informasi yang wajib disediakan dan diumumkan secara berkala.']
        );

        $katProfil = Ppid::firstOrCreate(
            ['name' => 'Profil Pemerintah Daerah', 'parent_id' => $jenisBerkala->id],
            ['description' => 'Kumpulan dokumen profil pemerintah daerah.']
        );

        PpidItem::firstOrCreate(
            ['name' => 'Dokumen Rencana Strategis (Renstra) 2024-2029', 'ppid_id' => $katProfil->id],
            [
                'tanggal_pembuatan' => now()->subMonths(6),
                'views' => 150,
                'downloads' => 45
            ]
        );

        // 5. Buat PPID - Jenis 2 (Serta Merta)
        $jenisSertaMerta = Ppid::firstOrCreate(
            ['name' => 'Informasi Serta Merta'],
            ['description' => 'Informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum.']
        );

        $katBencana = Ppid::firstOrCreate(
            ['name' => 'Informasi Bencana Alam', 'parent_id' => $jenisSertaMerta->id],
            ['description' => 'Laporan dan SOP mitigasi bencana.']
        );

        PpidItem::firstOrCreate(
            ['name' => 'SOP Penanganan Darurat Banjir Terkini', 'ppid_id' => $katBencana->id],
            [
                'tanggal_pembuatan' => now()->subDays(5),
                'views' => 240,
                'downloads' => 120
            ]
        );

        // 6. Buat PPID - Jenis 3 (Setiap Saat)
        $jenisSetiapSaat = Ppid::firstOrCreate(
            ['name' => 'Informasi Setiap Saat'],
            ['description' => 'Informasi yang wajib disediakan oleh Badan Publik berdasarkan permintaan.']
        );

        $katPerjanjian = Ppid::firstOrCreate(
            ['name' => 'Daftar Perjanjian dengan Pihak Ketiga', 'parent_id' => $jenisSetiapSaat->id],
            ['description' => 'Dokumen MoU dan kontrak kerja sama.']
        );

        PpidItem::firstOrCreate(
            ['name' => 'MoU Pengadaan Infrastruktur Jaringan 2025', 'ppid_id' => $katPerjanjian->id],
            [
                'tanggal_pembuatan' => now()->subYears(1),
                'views' => 45,
                'downloads' => 10
            ]
        );

        // 7. Buat PPID - Jenis 4 (Dikecualikan)
        $jenisDikecualikan = Ppid::firstOrCreate(
            ['name' => 'Informasi Dikecualikan'],
            ['description' => 'Informasi yang tidak dapat diakses oleh pemohon informasi publik sesuai dengan undang-undang.']
        );

        $katRahasia = Ppid::firstOrCreate(
            ['name' => 'Informasi yang Dapat Menghambat Proses Penegakan Hukum', 'parent_id' => $jenisDikecualikan->id],
            ['description' => 'Informasi rahasia terkait proses hukum.']
        );

        PpidItem::firstOrCreate(
            ['name' => 'Daftar Kasus Hukum Internal 2024 (Limited Access)', 'ppid_id' => $katRahasia->id],
            [
                'tanggal_pembuatan' => now()->subYears(2),
                'views' => 5,
                'downloads' => 0
            ]
        );
    }
}
