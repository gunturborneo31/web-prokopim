<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class Penjelasan2 implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            TextInput::make('content.subtitle')
                ->label('Sub Judul Singkat')
                ->placeholder('Teks kecil di bawah judul utama...'),

            \Filament\Schemas\Components\Tabs::make('Panel Editor')
                ->tabs([
                    \Filament\Schemas\Components\Tabs\Tab::make('Panel Kiri')
                        ->icon('heroicon-m-document-text')
                        ->schema([
                            TextInput::make('content.box_1_title')->label('Judul Kiri')->required(),
                            RichEditor::make('content.box_1_content')->label('Isi Kiri')->columnSpanFull()->extraInputAttributes(['style' => 'min-height: 480px;']),
                        ]),
                    \Filament\Schemas\Components\Tabs\Tab::make('Panel Kanan')
                        ->icon('heroicon-m-document-text')
                        ->schema([
                            TextInput::make('content.box_2_title')->label('Judul Kanan')->required(),
                            RichEditor::make('content.box_2_content')->label('Isi Kanan')->columnSpanFull()->extraInputAttributes(['style' => 'min-height: 480px;']),
                        ]),
                ])
                ->columnSpanFull()
                ->activeTab(1),
        ];
    }
}
