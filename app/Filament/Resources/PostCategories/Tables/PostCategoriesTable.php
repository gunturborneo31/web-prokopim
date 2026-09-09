<?php

namespace App\Filament\Resources\PostCategories\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('NAMA KATEGORI'))
                    ->searchable(),
                TextColumn::make('posts_count')
                    ->counts('posts')
                    ->label(__('JUMLAH TULISAN'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()->label(__('Ubah')),
            ])
            ->searchPlaceholder(__('Cari kategori...'))
            ->emptyStateHeading(__('Tidak ada kategori ditemukan'));
    }
}
