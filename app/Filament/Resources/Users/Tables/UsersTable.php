<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('NAMA'))
                    ->searchable(),
                TextColumn::make('username')
                    ->label(__('USERNAME'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('EMAIL'))
                    ->searchable(),
                TextColumn::make('role')
                    ->label(__('HAK AKSES'))
                    ->searchable()
                    ->badge()
                    ->color(fn (\App\Enums\UserRole $state): string => match ($state) {
                        \App\Enums\UserRole::SuperAdmin => 'danger',
                        \App\Enums\UserRole::Editor => 'warning',
                        \App\Enums\UserRole::Contributor => 'info',
                    })
                    ->formatStateUsing(fn (\App\Enums\UserRole $state): string => $state->label()),

                TextColumn::make('created_at')
                    ->label(__('DIBUAT PADA'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('DIUBAH PADA'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('')
                    ->tooltip(__('Ubah')),
                DeleteAction::make()
                    ->label('')
                    ->tooltip(__('Hapus')),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->searchPlaceholder(__('Cari pengguna...'))
            ->emptyStateHeading(__('Tidak ada pengguna ditemukan'))
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ]);
    }
}
