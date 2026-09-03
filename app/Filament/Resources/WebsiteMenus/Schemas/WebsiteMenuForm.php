<?php

namespace App\Filament\Resources\WebsiteMenus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WebsiteMenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('position')->default('website'),

                TextInput::make('name')
                    ->label(__('Nama Menu'))
                    ->required()
                    ->placeholder(__('Masukkan nama menu'))
                    ->maxLength(255),



                TextInput::make('link')
                    ->label(__('Alamat Tautan (URL)'))
                    ->placeholder(__('Contoh: /profil-website/visi-misi atau URL lengkap'))
                    ->maxLength(255),

                Select::make('icon')
                    ->label(__('Ikon'))
                    ->options([
                        '' => '— Tidak ada ikon —',
                        'home' => '🏠 Beranda',
                        'user' => '👤 Profil',
                        'newspaper' => '📰 Info & Berita',
                        'shield-check' => '🛡️ Peraturan',
                        'document-text' => '📄 Dokumen',
                        'headset' => '🎧 Layanan',
                        'default' => '☰ Umum (Menu)',
                    ])
                    ->afterStateHydrated(fn($component, $state) => $component->state($state ?? ''))
                    ->dehydrateStateUsing(fn($state) => $state ?: null)
                    ->default('default'),

                Hidden::make('parent_id'),

                TextInput::make('order')
                    ->label(__('Urutan'))
                    ->required()
                    ->numeric()
                    ->default(0),

                Toggle::make('status')
                    ->label(__('Aktif'))
                    ->onColor('info')
                    ->default(true),
            ]);
    }
}
