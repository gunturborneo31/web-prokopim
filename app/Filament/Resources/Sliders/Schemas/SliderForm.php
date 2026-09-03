<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('caption')
                    ->label(__('Judul'))
                    ->placeholder(__('Masukkan judul slider'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('link')
                    ->label(__('Alamat Tautan'))
                    ->placeholder(__('Masukkan URL tautan (opsional)'))
                    ->url()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label(__('Deskripsi'))
                    ->placeholder(__('Masukkan deskripsi slider (opsional)'))
                    ->rows(4)
                    ->columnSpanFull(),
                \Filament\Forms\Components\Radio::make('status')
                    ->label(__('Status'))
                    ->boolean()
                    ->options([
                        1 => __('Tayang'),
                        0 => __('Konsep'),
                    ])
                    ->inline()
                    ->default(1), 
                \Filament\Schemas\Components\Section::make(__('Gambar'))
                    ->relationship('file')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('path')
                            ->label(__('Pilih Gambar'))
                            ->disk('public')
                            ->directory('sliders')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->required()
                            ->helperText(__('Format: JPG, PNG, atau GIF. Maksimal 2MB.')),
                        \Filament\Forms\Components\Hidden::make('name')
                            ->default('slider_image'),
                        \Filament\Forms\Components\Hidden::make('disk')
                            ->default('public'),
                        \Filament\Forms\Components\Hidden::make('type')
                            ->default('image'),
                    ]),
            ]);
    }
}
