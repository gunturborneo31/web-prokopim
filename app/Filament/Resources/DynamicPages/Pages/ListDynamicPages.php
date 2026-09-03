<?php

namespace App\Filament\Resources\DynamicPages\Pages;

use App\Filament\Resources\DynamicPages\DynamicPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDynamicPages extends ListRecords
{
    protected static string $resource = DynamicPageResource::class;

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    public function getTitle(): string
    {
        $menuId = request()->query('menu_id');
        if ($menuId) {
            $menu = \App\Models\Menu::find($menuId);
            if ($menu) {
                return __('Halaman') . ' - ' . $menu->name;
            }
        }
        return __('Halaman Dinamis');
    }

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        $table = parent::table($table);
        $menuId = request()->query('menu_id');
        
        if ($menuId) {
            $table->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->where('menu_id', $menuId));
        }

        return $table;
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label(__('Kembali'))
                ->color('gray')
                ->icon('heroicon-m-arrow-left')
                ->url(function () {
                    $menuId = request()->query('menu_id');
                    if ($menuId) {
                        $menu = \App\Models\Menu::find($menuId);
                        if ($menu) {
                            $root = $menu;
                            while ($root->parent_id) {
                                $parent = \App\Models\Menu::find($root->parent_id);
                                if (!$parent) break;
                                $root = $parent;
                            }
                            return DynamicPageResource::getUrl('index', ['active_id' => $root->id]);
                        }
                    }
                    return DynamicPageResource::getUrl('index');
                }),
            \Filament\Actions\Action::make('new_page')
                ->label(__('Buat Halaman Baru'))
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->url(function () {
                    $menuId = request()->query('menu_id');
                    $params = $menuId ? ['menu_id' => $menuId] : [];
                    return DynamicPageResource::getUrl('select-template', $params);
                }),
        ];
    }
}
