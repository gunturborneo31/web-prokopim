<?php

namespace App\Filament\Resources\HomeAnnouncements\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HomeAnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('Judul / Keterangan'))
                    ->placeholder(__('Opsional'))
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('link')
                    ->label(__('Tautan'))
                    ->placeholder(__('Opsional'))
                    ->url()
                    ->maxLength(255)
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label(__('Gambar'))
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->directory('home-announcements')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->required()
                    ->helperText(__('Format gambar yang boleh digunakan: JPG, PNG, WebP. Maksimal 5MB.'))
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label(__('Urutan'))
                    ->numeric()
                    ->default(0)
                    ->helperText(__('Semakin kecil angka, semakin awal ditampilkan')),

                Toggle::make('status')
                    ->label(__('Aktif'))
                    ->default(true)
                    ->helperText(__('Hanya gambar aktif yang muncul di beranda')),
            ])
            ->columns(2);
    }
}
