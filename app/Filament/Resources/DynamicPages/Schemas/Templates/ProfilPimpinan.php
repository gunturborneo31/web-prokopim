<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;

class ProfilPimpinan implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            TextInput::make('content.subtitle')
                ->label('Sub Judul Singkat')
                ->placeholder('Contoh: Mengenal lebih dekat pimpinan Inspektorat...'),

            Repeater::make('content.leaders')
                ->label('Daftar Profil Pimpinan')
                ->schema([
                    Tabs::make('Profil Pimpinan')
                        ->tabs([
                            Tabs\Tab::make('Data Utama')
                                ->icon('heroicon-m-user-circle')
                                ->schema([
                                    Grid::make(12)->schema([
                                        TextInput::make('label')->label('Badge/ Singkatan')->placeholder('INSPEKTUR')->columnSpan(4),
                                        TextInput::make('name')->label('Nama Lengkap')->required()->columnSpan(4),
                                        TextInput::make('position')->label('Jabatan')->required()->columnSpan(4),
                                        TextInput::make('nip')->label('NIP')->columnSpan(6),
                                        TextInput::make('pangkat')->label('Pangkat')->columnSpan(6),
                                        TextInput::make('golongan')->label('Golongan')->columnSpan(6),
                                        TextInput::make('pendidikan')->label('Pendidikan Terakhir')->columnSpan(6),
                                        Textarea::make('quote')->label('Kutipan / Motto')->columnSpan(12),
                                        FileUpload::make('photo')->label('Foto Pimpinan')->image()->directory('dynamic-pages/leaders')->columnSpanFull(),
                                    ])
                                ]),
                            Tabs\Tab::make('Riwayat Jabatan')
                                ->icon('heroicon-m-clock')
                                ->schema([
                                    Repeater::make('histories')
                                        ->label('Riwayat Jabatan (Timeline)')
                                        ->schema([
                                            Grid::make(12)->schema([
                                                TextInput::make('year_start')->label('Tahun Mulai')->required()->columnSpan(4),
                                                TextInput::make('year_end')->label('Tahun Selesai')->placeholder('Kosong = Sekarang')->columnSpan(4),
                                                Toggle::make('is_current')->label('Sedang Menjabat?')->default(false)->inline(false)->columnSpan(4),
                                                TextInput::make('position')->label('Nama Jabatan')->required()->columnSpan(6),
                                                TextInput::make('institution')->label('Instansi / Lembaga')->columnSpan(6),
                                                Textarea::make('description')->label('Deskripsi Singkat')->columnSpanFull(),
                                            ])
                                        ])
                                        ->addActionLabel('+ Tambah Riwayat')
                                        ->collapsible()
                                        ->collapsed()
                                ])
                        ])
                        ->columnSpanFull()
                ])
                ->addActionLabel('+ Tambah Pimpinan')
                ->collapsible()
                ->collapsed(false)
        ];
    }
}
