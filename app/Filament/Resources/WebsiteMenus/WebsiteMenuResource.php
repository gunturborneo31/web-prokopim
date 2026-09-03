<?php

namespace App\Filament\Resources\WebsiteMenus;

use App\Filament\Resources\WebsiteMenus\Pages\ListWebsiteMenus;
use App\Filament\Resources\WebsiteMenus\Schemas\WebsiteMenuForm;
use App\Filament\Resources\WebsiteMenus\Tables\WebsiteMenusTable;
use App\Models\Menu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class WebsiteMenuResource extends Resource
{
    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    protected static ?string $model = Menu::class;

    public static function getNavigationItems(): array
    {
        $childItems = [];

        try {
            // Ambil menu website utama dari database untuk dijadikan dropdown
            $menus = Menu::where('position', 'website')
                ->whereNull('parent_id')
                ->where('status', true)
                ->orderBy('order')
                ->get();

            foreach ($menus as $menu) {
                $menuNameLower = strtolower($menu->name);
                
                // Route it to show sub-menus
                $adminUrl = \App\Filament\Resources\WebsiteMenus\Pages\ListWebsiteMenus::getUrl(['parent_id' => $menu->id]);
                $icon = Heroicon::OutlinedLink;
                
                if (str_contains($menuNameLower, 'beranda') || str_contains($menuNameLower, 'home')) {
                    $icon = Heroicon::OutlinedHome;
                } elseif (str_contains($menuNameLower, 'profil') || str_contains($menuNameLower, 'profile')) {
                    $icon = Heroicon::OutlinedUser;
                } elseif (str_contains($menuNameLower, 'berita') || str_contains($menuNameLower, 'info')) {
                    $icon = Heroicon::OutlinedNewspaper;
                } elseif (str_contains($menuNameLower, 'layanan')) {
                    $icon = Heroicon::OutlinedChatBubbleLeftEllipsis;
                } elseif (str_contains($menuNameLower, 'ppid') || str_contains($menuNameLower, 'dokumen') || str_contains($menuNameLower, 'peraturan')) {
                    $icon = str_contains($menuNameLower, 'peraturan') ? Heroicon::OutlinedShieldCheck : Heroicon::OutlinedDocumentText;
                } elseif (str_contains($menuNameLower, 'halaman')) {
                    $icon = Heroicon::OutlinedDocument;
                }

                $childItems[] = \Filament\Navigation\NavigationItem::make()
                    ->label($menu->name)
                    ->icon($icon)
                    ->url($adminUrl); // Link to sub menu list
            }
        } catch (\Exception $e) {
            // Abaikan jika tabel belum ada saat run artisan migrate
        }

        return [
            \Filament\Navigation\NavigationItem::make()
                ->label(static::getNavigationLabel())
                ->icon(static::$navigationIcon)
                ->group(static::getNavigationGroup())
                ->sort(static::$navigationSort)
                ->url(static::getUrl())
                ->isActiveWhen(fn() => request()->routeIs('filament.admin.resources.website-menus.*'))
                ->childItems($childItems),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('Menu Website');
    }

    public static function getModelLabel(): string
    {
        return __('Menu Website');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Pengaturan Menu');
    }

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('position', 'website');
    }

    public static function form(Schema $schema): Schema
    {
        return WebsiteMenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WebsiteMenusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWebsiteMenus::route('/'),
        ];
    }
}
