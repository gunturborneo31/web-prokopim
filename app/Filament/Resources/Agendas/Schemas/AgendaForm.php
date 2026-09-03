<?php

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                DatePicker::make('temp_date')
                    ->label(__('Tanggal Kegiatan'))
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->placeholder(__('Pilih tanggal'))
                    ->columnSpan(1),
                
                TimePicker::make('temp_time')
                    ->label(__('Pukul'))
                    ->native(false)
                    ->seconds(false)
                    ->required()
                    ->placeholder(__('Pilih waktu'))
                    ->columnSpan(1),
                
                TextInput::make('caption')
                    ->label(__('Judul Kegiatan'))
                    ->required()
                    ->placeholder(__('Masukkan judul kegiatan'))
                    ->maxLength(255)
                    ->columnSpan(2),
                
                Textarea::make('description')
                    ->label(__('Deskripsi'))
                    ->rows(5)
                    ->placeholder(__('Masukkan deskripsi kegiatan (opsional)'))
                    ->columnSpan(2),
                
                TextInput::make('location')
                    ->label(__('Lokasi'))
                    ->required()
                    ->placeholder(__('Masukkan lokasi kegiatan'))
                    ->maxLength(255)
                    ->columnSpan(2),
            ]);
    }
}