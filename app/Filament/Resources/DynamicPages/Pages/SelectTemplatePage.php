<?php

namespace App\Filament\Resources\DynamicPages\Pages;

use App\Filament\Resources\DynamicPages\DynamicPageResource;
use App\Models\DynamicPage;
use Filament\Resources\Pages\Page;

class SelectTemplatePage extends Page
{
    protected static string $resource = DynamicPageResource::class;

    protected string $view = 'filament.resources.dynamic-pages.pages.select-template';

    public function getTitle(): string
    {
        return 'Pilih Template Halaman';
    }

    public function mount(): void
    {
        $menuId = request()->integer('menu_id');
        if (! $menuId) {
            return;
        }

        $menu = \App\Models\Menu::find($menuId);
        $existingPage = $menu ? \App\Services\DynamicPageLinker::resolveForMenu($menu) : null;
        if (! $existingPage) {
            return;
        }

        $params = ['record' => $existingPage];

        // Page was only found via its legacy link (menu_id still null) —
        // pass link_menu_id so EditDynamicPage backfills the link on save.
        if (blank($existingPage->menu_id)) {
            $params['link_menu_id'] = $menuId;
        }

        $this->redirect(DynamicPageResource::getUrl('edit', $params));
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label(__('Kembali ke Daftar'))
                ->color('gray')
                ->icon('heroicon-m-arrow-left')
                ->url(function () {
                    return DynamicPageResource::getUrl('index');
                }),
        ];
    }

    public static function getTemplateData(): array
    {
        return [
            'penjelasan_1' => [
                'label' => 'Penjelasan 1',
                'description' => '1 judul, 1 konten',
                'category' => 'Artikel',
                'cat_color' => '#3b82f6',
            ],
            'penjelasan_2' => [
                'label' => 'Penjelasan 2',
                'description' => '2 judul, 2 konten',
                'category' => 'Dua Kolom',
                'cat_color' => '#3b82f6',
            ],
            'aparatur' => [
                'label' => 'Aparatur',
                'description' => 'Profil tim & jabatan',
                'category' => 'Profil',
                'cat_color' => '#10b981',
            ],
            'profil_pimpinan' => [
                'label' => 'Profil Pimpinan',
                'description' => 'Timeline sejarah pimpinan',
                'category' => 'Profil',
                'cat_color' => '#10b981',
            ],
            'gambar_1' => [
                'label' => 'Gambar 1',
                'description' => 'Banner + teks',
                'category' => 'Visual',
                'cat_color' => '#f59e0b',
            ],
            'galeri' => [
                'label' => 'Galeri',
                'description' => 'Grid foto & media',
                'category' => 'Galeri',
                'cat_color' => '#f59e0b',
            ],
            'dokumen_grid' => [
                'label' => 'Dokumen Grid',
                'description' => 'Grid file unduhan',
                'category' => 'Dokumen',
                'cat_color' => '#6b7280',
            ],
            'dokumen_list' => [
                'label' => 'Dokumen List',
                'description' => 'Daftar file & unduh',
                'category' => 'Dokumen',
                'cat_color' => '#6b7280',
            ],
            'tabel' => [
                'label' => 'Tabel',
                'description' => 'Data terstruktur',
                'category' => 'Data',
                'cat_color' => '#8b5cf6',
            ],
            'blank_editor' => [
                'label' => 'Blank',
                'description' => 'Editor teks bebas',
                'category' => 'Bebas',
                'cat_color' => '#9ca3af',
            ],
        ];
    }

    public function getCreateUrl(string $template, string $title, string $slug): string
    {
        return route('filament.admin.resources.dynamic-pages.create', [
            'template' => $template,
            'title' => $title,
            'slug' => $slug,
        ]);
    }
}
