<?php

namespace App\Filament\Resources\Menus\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class MenusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('name')
                    ->label(__('NAMA MENU'))
                    ->searchable()
                    // ->sortable()
                    ->weight('bold')
                    ->alignLeft()
                    ->extraCellAttributes(['class' => 'column-nama-menu'])
                    ->extraHeaderAttributes(['class' => 'column-nama-menu']),

                \Filament\Tables\Columns\ImageColumn::make('logo')
                    ->label(__('LOGO'))
                    ->disk('public')
                    ->height(40) // Biarkan lebar menyesuaikan secara proporsional
                    ->alignCenter()
                    ->extraImgAttributes([
                        'class' => 'object-contain mx-auto',
                        'style' => 'max-height: 40px; width: auto; max-width: 120px;'
                    ])
                    ->extraAttributes([
                        'class' => 'p-2 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-100 dark:border-gray-700 mx-auto',
                        'style' => 'width: fit-content; min-width: 60px;'
                    ])
                    ->toggleable()
                    ->placeholder(__('No Logo')),

                TextColumn::make('parent.name')
                    ->label(__('PARENT'))
                    ->placeholder('-')
                    ->alignCenter(),

                TextColumn::make('position')
                    ->label(__('POSISI'))
                    ->badge()
                    ->color('info')
                    ->alignCenter(),

                TextColumn::make('status')
                    ->label(__('AKTIF'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? __('Aktif') : __('Tidak Aktif'))
                    ->color(fn ($state) => $state ? 'info' : 'danger') // Teal like in screenshot
                    ->alignCenter(),
            ])
            ->recordActions([
                // Tombol Submenu (Icon List)
                \Filament\Actions\Action::make('submenu')
                    ->label(false) 
                    ->icon('heroicon-s-list-bullet')
                    ->color('info')
                    ->extraAttributes(['class' => 'btn-ta-custom btn-submenu-custom'])
                    ->url(fn (\App\Models\Menu $record) => \App\Filament\Resources\Menus\Pages\ListMenus::getUrl(['parent_id' => $record->id])),

                // Tombol Edit (Icon Pencil) - Modal Pop-up
                EditAction::make()
                    ->label(false)
                    ->icon('heroicon-s-pencil-square')
                    ->color('primary')
                    ->extraAttributes(['class' => 'btn-ta-custom btn-edit-custom'])
                    ->modalHeading(__('Edit Menu'))
                    ->modalWidth('2xl'),

                // Tombol Delete (Icon Trash)
                DeleteAction::make()
                    ->label(false)
                    ->icon('heroicon-s-trash')
                    ->color('danger')
                    ->extraAttributes(['class' => 'btn-ta-custom btn-delete-custom']),
            ])
            ->recordUrl(null)
            ->actionsColumnLabel(__('AKSI'))
            ->actionsAlignment('center')
            ->searchPlaceholder(__('Cari menu...'))
            ->emptyStateHeading(__('Belum ada menu'))
            ->emptyStateDescription(__('Silakan tambahkan menu baru menggunakan tombol "Tambah Menu" di atas.'))
            ->paginated([5, 10, 25])
            ->defaultSort('order', 'asc')
            ->reorderable('order');
    }
}