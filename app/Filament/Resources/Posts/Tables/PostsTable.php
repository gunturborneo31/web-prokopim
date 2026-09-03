<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label(__('NO'))
                    ->rowIndex(),
                TextColumn::make('title')
                    ->label(__('JUDUL'))
                    ->searchable()
                    ->html()
                    ->formatStateUsing(function ($state, \App\Models\Post $record) {
                        // Palet warna hardcoded hex agar pasti muncul (mirip referensi)
                        $colors = [
                            ['#fee2e2', '#b91c1c'], // Red
                            ['#dbeafe', '#1d4ed8'], // Blue
                            ['#dcfce7', '#3255AA'], // Green
                            ['#fef9c3', '#a16207'], // Yellow
                            ['#f3e8ff', '#7e22ce'], // Purple
                            ['#ffedd5', '#c2410c'], // Orange
                            ['#ecfeff', '#0e7490'], // Cyan
                            ['#fce7f3', '#be185d'], // Pink
                        ];
                        
                        $categoryName = $record->category?->name ?? '-';
                        $hash = crc32(trim($categoryName));
                        $colorIndex = abs($hash) % count($colors);
                        [$bg, $text] = $colors[$colorIndex];

                        return new \Illuminate\Support\HtmlString("
                            <div class='flex flex-wrap items-start gap-y-1'>
                                <span class='inline-flex items-start px-2 py-0.5 rounded text-xs font-bold mr-2 mb-1' style='background-color: {$bg}; color: {$text}; border: 1px solid {$bg};'>
                                    " . strtoupper(__(strtolower($categoryName))) . "
                                </span>
                                <span class='font-medium text-gray-900 dark:text-white'>" . \Illuminate\Support\Str::limit($state, 100) . "</span>
                            </div>
                        ");
                    })
                    ->extraCellAttributes(['class' => 'long-text-column'])
                    ->extraHeaderAttributes([])
                    ->alignLeft()
                    ->wrap(),
                TextColumn::make('penulis')
                    ->label(__('PENULIS'))
                    ->searchable()
                    ->placeholder('-')
                    ->alignCenter(),
                TextColumn::make('views')
                    ->label(__('DIBACA'))
                    ->numeric()
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->label(__('DIBUAT'))
                    ->dateTime('Y-m-d H:i:s'),
                TextColumn::make('status')
                    ->label(__('STATUS'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 1 ? __('Tayang') : __('Konsep'))
                    ->colors([
                        'success' => 1,
                        'warning' => 0,
                    ])
                    ->alignCenter(),
 
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label(__('Kategori')),
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
            ->searchPlaceholder(__('Cari tulisan...'))
            ->emptyStateHeading(__('Tidak ada tulisan ditemukan'))
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ]);
    }
}
