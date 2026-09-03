<?php

namespace App\Filament\Resources\DynamicPages\Pages;

use App\Filament\Resources\DynamicPages\DynamicPageResource;
use App\Models\Menu;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Collection;

class SelectMenuPage extends Page
{
    protected static string $resource = DynamicPageResource::class;

    protected string $view = 'filament.resources.dynamic-pages.pages.select-menu';

    public function getTitle(): string
    {
        return __('Pilih Menu Website');
    }

    public function getMenus(): Collection
    {
        return Menu::where('position', 'website')
            ->whereNull('parent_id')
            ->where('status', true)
            ->orderBy('order')
            ->with(['children' => function ($query) {
                $query->where('status', true)->orderBy('order')
                    ->with(['children' => function ($q) {
                        $q->where('status', true)->orderBy('order')
                            ->with(['children' => function ($q2) {
                                $q2->where('status', true)->orderBy('order');
                            }]);
                    }]);
            }])
            ->get();
    }

    public function getPageCount(int $menuId): int
    {
        return \App\Models\DynamicPage::where('menu_id', $menuId)->count();
    }

    public function getListUrl(int $menuId): string
    {
        return route('filament.admin.resources.dynamic-pages.list', ['menu_id' => $menuId]);
    }
}
