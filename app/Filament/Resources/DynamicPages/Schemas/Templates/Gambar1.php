<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class Gambar1 implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            TextInput::make('content.subtitle')
                ->label('Sub Judul Singkat')
                ->placeholder('Teks kecil di bawah judul utama...'),

            Section::make('Gambar Utama')
                ->schema([
                    FileUpload::make('content.image')
                        ->label('Upload Gambar')
                        ->image()
                        ->disk('public')
                        ->directory('dynamic-pages')
                        ,
                    TextInput::make('content.caption')
                        ->label('Keterangan / Caption Gambar'),
                ]),
        ];
    }
}
