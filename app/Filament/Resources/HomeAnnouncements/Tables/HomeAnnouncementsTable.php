<?php

namespace App\Filament\Resources\HomeAnnouncements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class HomeAnnouncementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__('GAMBAR'))
                    ->disk('public')
                    ->size(80)
                    ->square(),

                TextColumn::make('title')
                    ->label(__('KETERANGAN'))
                    ->searchable()
                    ->placeholder('-')
                    ->wrap(),

                TextColumn::make('order')
                    ->label(__('URUTAN'))
                    ->numeric()
                    ->sortable(),

                ToggleColumn::make('status')
                    ->label(__('STATUS'))
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('DIBUAT'))
                    ->dateTime('d M Y H:i'),
            ])
            ->defaultSort('order', 'asc')
            ->actions([
                EditAction::make()->iconButton()->tooltip(__('Ubah')),
                DeleteAction::make()->iconButton()->tooltip(__('Hapus')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ])
            ->emptyStateHeading(__('Belum ada pengumuman gambar'))
            ->searchPlaceholder(__('Cari pengumuman...'));
    }
}
