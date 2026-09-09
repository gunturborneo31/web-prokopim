<?php

namespace App\Filament\Resources\PostCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Nama Kategori'))
                    ->placeholder(__('Masukkan nama kategori'))
                    ->required(),
                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->disabled()
                    ->dehydrated()
                    ->helperText(__('Slug bersifat baku dan tidak dapat diubah karena dipakai sistem untuk mengenali kategori Berita, Pengumuman, dan Uncategorized.')),
                TextInput::make('active')
                    ->label(__('Status Aktif'))
                    ->helperText(__('1 = Aktif, 0 = Tidak Aktif'))
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
