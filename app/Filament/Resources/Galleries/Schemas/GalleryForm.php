<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('Judul Foto'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                
                Textarea::make('description')
                    ->label(__('Deskripsi'))
                    ->rows(3)
                    ->columnSpanFull(),
                
                FileUpload::make('image')
                    ->label(__('Gambar'))
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->directory('galleries')
                    ->visibility('public')
                    ->maxSize(5120) // 5MB
                    ->required()
                    ->helperText(__('Format: JPG, PNG, atau GIF. Maksimal 5MB.'))
                    ->columnSpanFull(),
                
                TextInput::make('order')
                    ->label(__('Urutan'))
                    ->numeric()
                    ->default(0)
                    ->helperText(__('Semakin kecil angka, semakin awal ditampilkan')),
                
                Toggle::make('is_active')
                    ->label(__('Aktif'))
                    ->default(true)
                    ->helperText(__('Hanya foto aktif yang akan ditampilkan di website')),
            ])
            ->columns(2);
    }
}
