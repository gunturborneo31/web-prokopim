<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class Penjelasan1 implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            Section::make('Konten Halaman')
                ->schema([
                    TextInput::make('content.judul')->label('Judul Bagian'),
                    RichEditor::make('content.isi_konten')->label('Isi Konten')->columnSpanFull()->extraInputAttributes(['style' => 'min-height: 480px;']),
                ]),
        ];
    }
}
