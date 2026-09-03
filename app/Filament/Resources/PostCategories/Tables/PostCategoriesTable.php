<?php

namespace App\Filament\Resources\PostCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
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
                \Filament\Actions\DeleteAction::make()->label(__('Hapus')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->searchPlaceholder(__('Cari kategori...'))
            ->emptyStateHeading(__('Tidak ada kategori ditemukan'));
    }
}
