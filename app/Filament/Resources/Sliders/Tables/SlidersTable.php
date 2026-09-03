<?php

namespace App\Filament\Resources\Sliders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SlidersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\Layout\Stack::make([
                    // Custom View with Top-Left Pin Clickable
                    \Filament\Tables\Columns\Layout\View::make('filament.tables.columns.slider-image-with-pin'),

                    \Filament\Tables\Columns\Layout\Stack::make([
                        TextColumn::make('caption')
                            ->weight(\Filament\Support\Enums\FontWeight::Bold)
                            ->size(\Filament\Support\Enums\TextSize::Medium)
                            ->lineClamp(2),
                        TextColumn::make('created_at')
                            ->date('d M, Y')
                            ->icon('heroicon-o-calendar')
                            ->color('gray')
                            ->size(\Filament\Support\Enums\TextSize::Small),
                    ])->space(2)->extraAttributes(['class' => 'p-4']),
                ])->space(0),
            ])
            ->contentGrid([
                'md' => 2,
                'lg' => 3,
                'xl' => 3,
            ])
            ->recordClasses(fn ($record) => 
                ($record->is_pinned ? 'border-2 border-primary-500 shadow-md ' : '') .
                'bg-white dark:bg-gray-900 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 overflow-hidden relative transition-all duration-300'
            )
            ->actions([
                // PIN ACTION in Dropdown/Record Actions
                \Filament\Actions\Action::make('pin')
                    ->label(fn ($record) => $record->is_pinned ? __('Lepas Sematan') : __('Sematkan ke Atas'))
                    ->icon('heroicon-s-bookmark')
                    ->color(fn ($record) => $record->is_pinned ? 'danger' : 'primary')
                    ->action(fn ($record) => $record->update(['is_pinned' => !$record->is_pinned])),
                
                \Filament\Actions\EditAction::make()
                    ->label(__('Ubah'))
                    ->tooltip(__('Ubah')),
                \Filament\Actions\DeleteAction::make()
                    ->label(__('Hapus'))
                    ->tooltip(__('Hapus')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->searchPlaceholder(__('Cari slider...'))
            ->emptyStateHeading(__('Tidak ada slider ditemukan'))
            ->defaultSort('is_pinned', 'desc');
    }
}
