<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Nama Layanan'))
                    ->placeholder(__('Masukkan nama layanan'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('link')
                    ->label(__('Alamat Tautan'))
                    ->placeholder(__('Masukkan URL tautan (opsional)'))
                    ->url()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label(__('Deskripsi'))
                    ->placeholder(__('Masukkan deskripsi layanan'))
                    ->rows(4)
                    ->columnSpanFull(),

                Radio::make('status')
                    ->label(__('Status'))
                    ->boolean()
                    ->options([
                        1 => __('Tayang'),
                        0 => __('Konsep'),
                    ])
                    ->inline()
                    ->default(1),

                Section::make(__('Logo'))
                    ->relationship('file')
                    ->schema([
                        FileUpload::make('path')
                            ->label(__('Pilih Logo'))
                            ->disk('public')
                            ->directory('services')
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->helperText(__('Format: JPG, PNG, atau GIF.')),
                        Hidden::make('name')
                            ->default('service_logo'),
                        Hidden::make('disk')
                            ->default('public'),
                        Hidden::make('type')
                            ->default('image'),
                        Hidden::make('user_id')
                            ->default(fn () => auth()->id()),
                    ]),
            ]);
    }
}
