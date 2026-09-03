<?php

namespace App\Filament\Widgets;

use App\Models\Agenda;
use App\Models\FileSharing;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Ppid;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SliderPortal;
use App\Models\User;
use App\Models\WebsiteIdentity;
use Filament\Widgets\Widget;

class MasterStatisticsWidget extends Widget
{
    protected string $view = 'filament.widgets.master-statistics-widget';
    protected static ?string $pollingInterval = '15s';

    public function getStats(): array
    {
        $stats = [];

        // Helper to check table and return count
        $getCount = function ($modelClass) {
            try {
                $model = new $modelClass;
                return $model->getConnection()->getSchemaBuilder()->hasTable($model->getTable()) 
                    ? $modelClass::count() 
                    : 0;
            } catch (\Exception $e) {
                return 0;
            }
        };

        // === GROUP 1: PORTAL & IDENTITY ===
        $stats[] = [
            'label' => __('Portal - Identitas'),
            'count' => $getCount(WebsiteIdentity::class),
            'icon' => 'heroicon-m-globe-alt',
            'color' => '#059669',
            'url' => '/site-admin/website-identities',
            'description' => __('Identitas & Logo site'),
            'sub_menus' => [
                ['label' => __('Identitas'), 'url' => '/site-admin/website-identities'],
                ['label' => __('Slider'), 'url' => '/site-admin/slider-portals'],
            ]
        ];

        // === GROUP 2: DINAMIS MENU & SUB MENU ===
        try {
            if ((new Menu)->getConnection()->getSchemaBuilder()->hasTable((new Menu)->getTable())) {
                $parentMenus = Menu::whereNull('parent_id')->orderBy('order')->get();
                foreach ($parentMenus as $menu) {
                    $children = $menu->children()->limit(4)->get();
                    $subMenus = [['label' => __('Daftar'), 'url' => '/site-admin/menus']];
                    foreach ($children as $child) {
                        $subMenus[] = ['label' => __($child->name), 'url' => '/site-admin/menus/' . $child->id . '/edit'];
                    }

                    $stats[] = [
                        'label' => __('Menu') . ' - ' . __($menu->name),
                        'count' => $menu->children()->count(),
                        'icon' => (isset($menu->icon) && str_starts_with($menu->icon, 'heroicon-')) ? $menu->icon : 'heroicon-m-bars-3-bottom-left',
                        'color' => '#065f46',
                        'url' => '/site-admin/menus',
                        'description' => __('Struktur navigasi') . ' ' . __($menu->name),
                        'sub_menus' => $subMenus
                    ];
                }
            }
        } catch (\Exception $e) {}

        // === GROUP 3: DINAMIS KATEGORI TULISAN ===
        try {
            if ((new PostCategory)->getConnection()->getSchemaBuilder()->hasTable((new PostCategory)->getTable())) {
                $categories = PostCategory::where('active', true)->get();
                foreach ($categories as $cat) {
                    $stats[] = [
                        'label' => __('Berita') . ' - ' . __($cat->name),
                        'count' => Post::where('type', 'post')->where('category_id', $cat->id)->count(),
                        'icon' => 'heroicon-m-newspaper',
                        'color' => '#059669',
                        'url' => '/site-admin/posts?tableFilters[category_id][value]=' . $cat->id,
                        'description' => __('Koleksi artikel') . ' ' . __($cat->name),
                        'sub_menus' => [
                            ['label' => __('Daftar'), 'url' => '/site-admin/posts?tableFilters[category_id][value]=' . $cat->id],
                            ['label' => __('Tambah'), 'url' => '/site-admin/posts/create?category_id=' . $cat->id],
                        ]
                    ];
                }
            }
        } catch (\Exception $e) {}

        // === GROUP 4: BULETIN & EVENT ===
        $stats[] = [
            'label' => __('Buletin - Agenda'),
            'count' => $getCount(Agenda::class),
            'icon' => 'heroicon-m-calendar-days',
            'color' => '#064e3b',
            'url' => '/site-admin/agendas',
            'description' => __('Kalender kegiatan'),
            'sub_menus' => [
                ['label' => __('Daftar'), 'url' => '/site-admin/agendas'],
                ['label' => __('Tambah'), 'url' => '/site-admin/agendas/create'],
            ]
        ];

        // === GROUP 5: MEDIA & GALERI ===
        $stats[] = [
            'label' => __('Media - Galeri'),
            'count' => $getCount(Gallery::class),
            'icon' => 'heroicon-m-photo',
            'color' => '#10b981',
            'url' => '/site-admin/galleries',
            'description' => __('Koleksi foto/video'),
            'sub_menus' => [
                ['label' => __('Daftar'), 'url' => '/site-admin/galleries'],
                ['label' => __('Tambah'), 'url' => '/site-admin/galleries/create'],
            ]
        ];

        // === GROUP 6: LAYANAN & PPID ===
        $stats[] = [
            'label' => __('Layanan - E-Gov'),
            'count' => $getCount(Service::class),
            'icon' => 'heroicon-m-briefcase',
            'color' => '#059669',
            'url' => '/site-admin/services',
            'description' => __('Daftar layanan publik'),
            'sub_menus' => [
                ['label' => __('Daftar'), 'url' => '/site-admin/services'],
                ['label' => __('Tambah'), 'url' => '/site-admin/services/create'],
            ]
        ];

        try {
            if ((new Ppid)->getConnection()->getSchemaBuilder()->hasTable((new Ppid)->getTable())) {
                $ppidCategories = Ppid::whereNull('parent_id')->get();
                foreach ($ppidCategories as $category) {
                    $stats[] = [
                        'label' => __('PPID') . ' - ' . __($category->name),
                        'count' => Ppid::where('parent_id', $category->id)->count(),
                        'icon' => 'heroicon-m-shield-check',
                        'color' => '#3255AA',
                        'url' => '/site-admin/ppids?parent_id=' . $category->id,
                        'description' => __('Info publik') . ' ' . __($category->name),
                        'sub_menus' => [
                            ['label' => __('Data'), 'url' => '/site-admin/ppids?parent_id=' . $category->id],
                            ['label' => __('Kelola'), 'url' => '/site-admin/ppids'],
                        ]
                    ];
                }
            }
        } catch (\Exception $e) {}

        // === GROUP 7: ARSIP & PENGATURAN ===
        $stats[] = [
            'label' => __('Arsip - File'),
            'count' => $getCount(FileSharing::class),
            'icon' => 'heroicon-m-folder-open',
            'color' => '#10b981',
            'url' => '/site-admin/file-sharings',
            'description' => __('Penyimpanan digital'),
            'sub_menus' => [
                ['label' => __('Daftar'), 'url' => '/site-admin/file-sharings'],
                ['label' => __('Upload'), 'url' => '/site-admin/file-sharings/create'],
            ]
        ];

        $stats[] = [
            'label' => __('Sistem - User'),
            'count' => $getCount(User::class),
            'icon' => 'heroicon-m-users',
            'color' => '#16a34a',
            'url' => '/site-admin/users',
            'description' => __('Manajemen administrator'),
            'sub_menus' => [
                ['label' => __('Daftar'), 'url' => '/site-admin/users'],
                ['label' => __('Profil'), 'url' => '/site-admin/profile'],
            ]
        ];


        return $stats;
    }
}
