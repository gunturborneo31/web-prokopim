<?php

namespace App\Filament\Resources\Ppids\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PpidForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(fn ($get) => filled($get('parent_id')) ? __('Nama Sub Kategori') : __('Nama Kategori'))
                    ->placeholder(__('Masukkan nama'))
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label(__('Deskripsi'))
                    ->placeholder(__('Masukkan deskripsi singkat'))
                    ->rows(3)
                    ->maxLength(500),
                
                Hidden::make('parent_id'),
            ]);
    }
}