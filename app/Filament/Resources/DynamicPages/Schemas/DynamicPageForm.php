<?php

namespace App\Filament\Resources\DynamicPages\Schemas;

use App\Models\DynamicPage;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class DynamicPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                // ==========================================================
                //  KOLOM KIRI: Editor Konten (Lebar 2 Kolom di Desktop)
                // ==========================================================
                Group::make()->columnSpan(['default' => 3, 'xl' => 2])->schema([
                    Section::make(__('Editor Konten Dinamis'))
                        ->icon('heroicon-o-pencil-square')
                        ->description(__('Tulis dan susun konten sesuai template yang dipilih.'))
                        ->schema([
                            TextInput::make('hero_badge')
                                ->label(__('Teks Badge Hero'))
                                ->placeholder(__('Contoh: Profil Inspektorat, Info Penting, …'))
                                ->columnSpanFull(),

                            // Template-specific fields
                            Group::make(Templates\Penjelasan1::schema())->visible(fn(Get $get) => $get('template') === 'penjelasan_1'),
                            Group::make(Templates\Penjelasan2::schema())->visible(fn(Get $get) => $get('template') === 'penjelasan_2'),
                            Group::make(Templates\Aparatur::schema())->visible(fn(Get $get) => $get('template') === 'aparatur'),
                            Group::make(Templates\ProfilPimpinan::schema())->visible(fn(Get $get) => $get('template') === 'profil_pimpinan'),
                            Group::make(Templates\Gambar1::schema())->visible(fn(Get $get) => $get('template') === 'gambar_1'),
                            Group::make(Templates\Galeri::schema())->visible(fn(Get $get) => $get('template') === 'galeri'),
                            Group::make(Templates\Dokumen::schema())->visible(fn(Get $get) => in_array($get('template'), ['dokumen_grid', 'dokumen_list'])),
                            Group::make(Templates\Tabel::schema())->visible(fn(Get $get) => $get('template') === 'tabel'),
                            Group::make(Templates\BlankEditor::schema())->visible(fn(Get $get) => $get('template') === 'blank_editor'),
                        ]),
                ]),

                // ==========================================================
                //  KOLOM KANAN: Konfigurasi & Info Halaman (Sidebar Tab)
                // ==========================================================
                Group::make()->columnSpan(['default' => 3, 'xl' => 1])->schema([
                    Section::make(__('Info Halaman'))
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Placeholder::make('title_display')
                                ->label(__('Judul Halaman'))
                                ->content(fn(Get $get) => $get('title')),

                            Placeholder::make('public_url_display')
                                ->label(__('URL Publik'))
                                ->content(fn(Get $get) => $get('public_url') ?: ('/halaman/' . $get('slug'))),

                            TextInput::make('public_url')
                                ->label(__('URL Halaman'))
                                ->required()
                                ->helperText(__('Contoh: /halaman atau /halaman/undang-undang'))
                                ->live(onBlur: true)
                                ->afterStateHydrated(function ($component, $state, $record) {
                                    if (blank($state) && $record?->menu?->link) {
                                        $component->state($record->menu->link);
                                    }

                                    if (blank($state) && $record?->slug) {
                                        $component->state('/halaman/' . $record->slug);
                                    }
                                })
                                ->dehydrateStateUsing(function ($state) {
                                    $path = trim((string) $state);

                                    if ($path === '') {
                                        return '/halaman';
                                    }

                                    if (! str_starts_with($path, '/')) {
                                        $path = '/' . $path;
                                    }

                                    return rtrim($path, '/');
                                }),

                            Placeholder::make('template_aktif')
                                ->label(__('Template Aktif'))
                                ->content(function (Get $get) {
                                    $tplKey   = $get('template');
                                    $tplLabel = DynamicPage::templates()[$tplKey] ?? 'Belum dipilih';
                                    return new HtmlString(
                                        '<div style="display:flex;flex-direction:column;gap:4px;">'
                                        . '<span style="font-weight:600;color:rgb(16, 185, 129);">' . e(__($tplLabel)) . '</span>'
                                        . '<span style="font-size:.75rem;opacity:.6;">(' . e($tplKey) . ')</span>'
                                        . '</div>'
                                    );
                                }),

                            Toggle::make('published')
                                ->label(__('Status Publikasi'))
                                ->helperText(__('Halaman yang tidak dipublikasikan tidak akan bisa diakses oleh publik.'))
                                ->default(true)
                                ->onColor('success')
                                ->offColor('danger')
                                ->inline(false),

                            Hidden::make('title'),
                            Hidden::make('slug'),
                            Hidden::make('template'),
                            Hidden::make('menu_id'),
                        ])
                ]),
            ]);
    }
}
