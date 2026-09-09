<?php

namespace App\Filament\Resources\BeritaVisualIgs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BeritaVisualIgForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('Judul / Keterangan'))
                    ->placeholder(__('Masukkan keterangan gambar (opsional)'))
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('link')
                    ->label(__('Tautan Instagram'))
                    ->placeholder(__('Masukkan URL post Instagram (opsional)'))
                    ->url()
                    ->maxLength(255)
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label(__('Gambar'))
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                    ])
                    ->directory('berita-visual-ig')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->required()
                    ->helperText(__('Gunakan rasio 1:1 (persegi) agar tampil optimal seperti feed Instagram. Format: JPG, PNG. Maksimal 5MB.'))
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label(__('Urutan'))
                    ->numeric()
                    ->default(0)
                    ->helperText(__('Semakin kecil angka, semakin awal ditampilkan')),

                Toggle::make('is_active')
                    ->label(__('Aktif'))
                    ->default(true)
                    ->helperText(__('Hanya gambar aktif yang akan ditampilkan di beranda')),
            ])
            ->columns(2);
    }
}
