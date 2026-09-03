<?php

namespace App\Filament\Resources\PortalSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class PortalSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Status Portal'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Terakhir Diubah'))
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label(__('Ubah Status'))
                    ->color('primary')
                    ->button(),
            ])
            ->actionsColumnLabel(__('Aksi'))
            ->toolbarActions([]);
    }
}
