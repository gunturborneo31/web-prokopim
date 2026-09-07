<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class Galeri implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            TextInput::make('content.subtitle')
                ->label('Sub Judul Singkat')
                ->placeholder('Teks kecil di bawah judul utama...'),

            Repeater::make('content.images')
                ->label('Daftar Foto Galeri')
                ->schema([
                    FileUpload::make('image')->label('Foto')->image()->disk('public')->directory('dynamic-pages')->required(),
                    TextInput::make('caption')->label('Caption'),
                ])
                ->grid(3),
        ];
    }
}
