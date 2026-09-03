<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class GalleriesTable
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
                    ->label(__('JUDUL'))
                    ->searchable()
                    // ->sortable()
                    ->wrap()
                    ->extraCellAttributes(['class' => 'long-text-column'])
                    ->extraHeaderAttributes([]),
                
                TextColumn::make('description')
                    ->label(__('DESKRIPSI'))
                    ->limit(50)
                    ->wrap()
                    ->placeholder('-')
                    ->extraCellAttributes(['class' => 'long-text-column']),
                
                TextColumn::make('order')
                    ->label(__('URUTAN'))
                    // ->sortable()
                    ->alignCenter(),
                
                IconColumn::make('is_active')
                    ->label(__('STATUS'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter(),
                
                TextColumn::make('created_at')
                    ->label(__('DIBUAT'))
                    ->dateTime('d M Y H:i')
                    // ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                \Filament\Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('Status'))
                    ->placeholder(__('Semua'))
                    ->trueLabel(__('Aktif'))
                    ->falseLabel(__('Tidak Aktif')),
            ])
            ->actions([
                EditAction::make()
                    ->iconButton()
                    ->tooltip(__('Ubah')),

                DeleteAction::make()
                    ->iconButton()
                    ->tooltip(__('Hapus')),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->searchPlaceholder(__('Cari foto...'))
            ->emptyStateHeading(__('Tidak ada foto ditemukan'))
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ]);
    }
}
