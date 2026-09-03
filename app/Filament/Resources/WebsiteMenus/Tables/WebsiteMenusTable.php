<?php

namespace App\Filament\Resources\WebsiteMenus\Tables;

use App\Models\DynamicPage;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WebsiteMenusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('NAMA MENU'))
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('link')
                    ->label(__('LINK'))
                    ->color('gray'),

                TextColumn::make('parent.name')
                    ->label(__('PARENT'))
                    ->placeholder('-'),

                TextColumn::make('status')
                    ->label(__('AKTIF'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? __('Aktif') : __('Tidak Aktif'))
                    ->color(fn ($state) => $state ? 'info' : 'danger'),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('manage_page')
                    ->label(false)
                    ->icon('heroicon-s-document-text')
                    ->color('success')
                    ->tooltip(__('Atur Halaman'))
                    ->url(function (\App\Models\Menu $record) {
                        $pageId = DynamicPage::query()
                            ->where('menu_id', $record->id)
                            ->value('id');

                        if ($pageId) {
                            return route('filament.admin.resources.dynamic-pages.edit', ['record' => $pageId]);
                        }

                        return route('filament.admin.resources.dynamic-pages.select-template', [
                            'menu_id' => $record->id,
                            'menu_name' => $record->name,
                        ]);
                    }),

                \Filament\Actions\Action::make('submenu')
                    ->label(false) 
                    ->icon('heroicon-s-list-bullet')
                    ->color('info')
                    ->url(function (\App\Models\Menu $record) {
                        return \App\Filament\Resources\WebsiteMenus\Pages\ListWebsiteMenus::getUrl(['parent_id' => $record->id]);
                    }),

                EditAction::make()
                    ->label(false)
                    ->icon('heroicon-s-pencil-square')
                    ->color('primary')
                    ->modalHeading(__('Edit Menu Website'))
                    ->modalWidth('2xl'),

                DeleteAction::make()
                    ->label(false)
                    ->icon('heroicon-s-trash')
                    ->color('danger'),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->defaultSort('order', 'asc')
            ->reorderable('order');
    }
}
