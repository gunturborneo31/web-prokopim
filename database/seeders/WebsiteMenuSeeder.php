<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WebsiteMenuSeeder extends Seeder
{
    /**
     * Seed website menus from the current frontend structure.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Beranda',
                'link' => '/',
                'icon' => 'home',
            ],
            [
                'name' => 'Profil',
                'link' => '#',
                'icon' => 'user',
                'children' => [
                    ['name' => 'Visi & Misi', 'link' => '/profil/visi-misi'],
                    ['name' => 'Tujuan & Sasaran', 'link' => '/profil/tujuan-sasaran'],
                    ['name' => 'Profil Pimpinan', 'link' => '/profil/pimpinan'],
                    ['name' => 'Aparatur', 'link' => '/profil/aparatur'],
                    ['name' => 'Motto & Maklumat', 'link' => '/profil/motto'],
                    ['name' => 'Penghargaan', 'link' => '/profil/penghargaan'],
                    ['name' => 'Struktur', 'link' => '/profil/struktur'],
                ],
            ],
            [
                'name' => 'Berita',
                'link' => '/berita',
                'icon' => 'newspaper',
            ],
            [
                'name' => 'Regulasi',
                'link' => '#',
                'icon' => 'shield-check',
                'children' => [
                    ['name' => 'Undang-Undang', 'link' => '/regulasi/undang-undang'],
                    ['name' => 'Peraturan Menteri', 'link' => '/regulasi/peraturan-menteri'],
                    ['name' => 'Peraturan Daerah', 'link' => '/regulasi/peraturan-daerah'],
                    ['name' => 'Peraturan Bupati', 'link' => '/regulasi/peraturan-bupati'],
                    ['name' => 'SK Bupati', 'link' => '/regulasi/sk-bupati'],
                    ['name' => 'SK Kepala', 'link' => '/regulasi/sk-kepala'],
                    ['name' => 'Lain-lain', 'link' => '/regulasi/lain-lain'],
                ],
            ],
            [
                'name' => 'Dokumen',
                'link' => '#',
                'icon' => 'document-text',
                'children' => [
                    ['name' => 'RENSTRA', 'link' => '/dokumen/renstra'],
                    ['name' => 'RENJA', 'link' => '/dokumen/renja'],
                    ['name' => 'DPA', 'link' => '/dokumen/dpa'],
                    ['name' => 'IKU', 'link' => '/dokumen/iku'],
                    ['name' => 'SOP', 'link' => '/dokumen/sop'],
                    ['name' => 'Laporan LKjIP', 'link' => '/dokumen/sakip'],
                    ['name' => 'RKPD', 'link' => '/dokumen/rkpd'],
                    ['name' => 'RPJPD', 'link' => '/dokumen/rpjpd'],
                    ['name' => 'RPJMD', 'link' => '/dokumen/rpjmd'],
                ],
            ],
            [
                'name' => 'Layanan',
                'link' => '#',
                'icon' => 'headset',
                'children' => [
                    ['name' => 'Pengaduan Publik', 'link' => '/layanan/pengaduan'],
                    ['name' => 'Cek Status Laporan', 'link' => '/layanan/cek-status'],
                    ['name' => 'WBS (Whistleblowing)', 'link' => '/layanan/wbs'],
                ],
            ],
        ];

        foreach ($menus as $index => $menu) {
            $parent = $this->upsertMenu($menu, null, $index);

            foreach ($menu['children'] ?? [] as $childIndex => $child) {
                $this->upsertMenu($child, $parent->id, $childIndex);
            }
        }
    }

    protected function upsertMenu(array $menu, ?int $parentId, int $order): Menu
    {
        return Menu::updateOrCreate(
            [
                'position' => 'website',
                'parent_id' => $parentId,
                'name' => $menu['name'],
            ],
            [
                'link' => $menu['link'] ?? '#',
                'slug' => $menu['slug'] ?? Str::slug($menu['name']),
                'icon' => $menu['icon'] ?? null,
                'order' => $order,
                'status' => true,
            ]
        );
    }
}
