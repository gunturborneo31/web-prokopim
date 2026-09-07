<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class Aparatur implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            TextInput::make('content.subtitle')
                ->label('Sub Judul Singkat')
                ->placeholder('Contoh: Sumber Daya Manusia yang Profesional...'),

            Section::make('Pimpinan Utama (Top Leader)')
                ->schema([
                    Group::make()->schema([
                        Grid::make(12)->schema([
                            TextInput::make('content.main_leader.name')->label('Nama Lengkap')->placeholder('Nama Inspektur')->columnSpan(6),
                            TextInput::make('content.main_leader.position')->label('Jabatan')->placeholder('INSPEKTUR')->columnSpan(6),
                            TextInput::make('content.main_leader.pangkat')->label('Pangkat')->columnSpan(6),
                            TextInput::make('content.main_leader.golongan')->label('Golongan')->columnSpan(6),
                            FileUpload::make('content.main_leader.photo')->label('Foto Pimpinan Utama')->image()->disk('public')->directory('dynamic-pages/aparatur')->columnSpanFull(),
                        ])
                    ])
                ])
                ->collapsible()
                ->collapsed(false),

            Repeater::make('content.aparaturs')
                ->label('Daftar Aparatur / Staf')
                ->schema([
                    Grid::make(12)->schema([
                        TextInput::make('name')->label('Nama Lengkap')->required()->columnSpan(6),
                        TextInput::make('position')->label('Jabatan')->required()->columnSpan(6),
                        TextInput::make('pangkat')->label('Pangkat')->columnSpan(6),
                        TextInput::make('golongan')->label('Golongan')->columnSpan(6),
                        FileUpload::make('photo')->label('Foto')->image()->disk('public')->directory('dynamic-pages/aparatur')->columnSpanFull(),
                    ])
                ])
                ->addActionLabel('+ Tambah Aparatur')
                ->collapsible()
                ->collapsed(false),
        ];
    }
}
