<?php

namespace App\Filament\Resources\DynamicPages\Pages;

use App\Filament\Resources\DynamicPages\DynamicPageResource;
use App\Models\Menu;
use App\Services\DynamicPageLinker;
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
                ->label(function () {
                    $existingPage = $this->resolveExistingPage();

                    return $existingPage ? __('Buka Halaman') : __('Buat Halaman Baru');
                })
                ->icon(function () {
                    $existingPage = $this->resolveExistingPage();

                    return $existingPage ? 'heroicon-o-pencil-square' : 'heroicon-o-plus';
                })
                ->color('primary')
                ->url(function () {
                    $menuId = request()->query('menu_id');
                    $existingPage = $this->resolveExistingPage();

                    if ($existingPage) {
                        $params = ['record' => $existingPage];

                        // Page was only found via its legacy link (menu_id still null) —
                        // pass link_menu_id so EditDynamicPage backfills the link on save.
                        if ($menuId && blank($existingPage->menu_id)) {
                            $params['link_menu_id'] = $menuId;
                        }

                        return DynamicPageResource::getUrl('edit', $params);
                    }

                    $params = $menuId ? ['menu_id' => $menuId] : [];
                    return DynamicPageResource::getUrl('select-template', $params);
                }),
        ];
    }

    private function resolveExistingPage(): ?\App\Models\DynamicPage
    {
        $menuId = request()->query('menu_id');

        if (! $menuId) {
            return null;
        }

        $menu = Menu::find($menuId);

        return $menu ? DynamicPageLinker::resolveForMenu($menu) : null;
    }
}
