<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                \Filament\Tables\Columns\Layout\Stack::make([
                    // Brand Logo Area: Defines the layout size but shows full image
                    \Filament\Tables\Columns\ImageColumn::make('file.path')
                        ->disk('public')
                        ->height(80) // Set a consistent height for the layout
                        ->width('100%') // Allow it to span the width of the card
                        ->extraImgAttributes([
                            'class' => 'object-contain w-full h-full p-2 bg-gray-50/50 dark:bg-gray-900/30 rounded-xl',
                            'style' => 'max-height: 80px;'
                        ])
                        ->extraAttributes([
                            'class' => 'mb-4 flex justify-center items-center overflow-hidden border border-gray-100 dark:border-gray-700/50 rounded-xl bg-gray-50/30'
                        ]),

                    \Filament\Tables\Columns\Layout\Stack::make([
                        // Service Name
                        \Filament\Tables\Columns\TextColumn::make('name')
                            ->size(\Filament\Support\Enums\TextSize::Large)
                            ->weight(\Filament\Support\Enums\FontWeight::Bold)
                            ->color('gray-900')
                            ->extraAttributes(['class' => 'dark:text-white'])
                            ->searchable(),

                        // URL/Link
                        \Filament\Tables\Columns\TextColumn::make('link')
                            ->icon('heroicon-o-link')
                            ->color('primary')
                            ->size(\Filament\Support\Enums\TextSize::ExtraSmall)
                            ->limit(45)
                            ->searchable(),
                    ])->space(1),

                    // Actions Row
                    \Filament\Tables\Columns\Layout\Split::make([
                        \Filament\Tables\Columns\Layout\Stack::make([]), // Spacer
                        
                        \Filament\Tables\Columns\Layout\Stack::make([])->grow(false), // Actions handled by method
                    ]),
                ])
                ->extraAttributes([
                    'class' => 'p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 transition-all duration-200 hover:shadow-md',
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\EditAction::make()
                    ->iconButton()
                    ->icon('heroicon-s-pencil-square')
                    ->color('primary')
                    ->tooltip(__('Ubah')),
                \Filament\Actions\DeleteAction::make()
                    ->iconButton()
                    ->icon('heroicon-s-trash')
                    ->color('danger')
                    ->tooltip(__('Hapus')),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->searchPlaceholder(__('Cari layanan...'))
            ->emptyStateHeading(__('Tidak ada layanan ditemukan'))
            ->actionsAlignment('end');
    }
}
