<?php

namespace App\Filament\Resources\Menus\Pages;

use App\Filament\Resources\Menus\MenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\Url;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    #[Url]
    public ?int $parent_id = null;

    protected ?\App\Models\Menu $parentMenu = null;

    public function mount(): void
    {
        parent::mount();

        if ($this->parent_id) {
            $this->parentMenu = \App\Models\Menu::find($this->parent_id);
        }
    }

    protected function getHeaderActions(): array
    {
        $actions = [];

        // Tambahkan tombol Kembali jika sedang di submenu
        if ($this->parent_id) {
            $actions[] = \Filament\Actions\Action::make('back')
                ->label(__('Kembali'))
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url($this->getBackUrl());
        }

        // Tambahkan tombol Create
        $actions[] = CreateAction::make()
            ->label(__('Tambah Menu'))
            ->icon('heroicon-o-plus')
            ->modalHeading(__('Tambah Menu Baru'))
            ->modalWidth('2xl')
            ->mutateFormDataUsing(function (array $data): array {
                $data['parent_id'] = $this->parent_id;
                $data['position'] = 'portal';
                return $data;
            });

        return $actions;
    }
    
    public function getTableQuery(): ?\Illuminate\Database\Eloquent\Builder
    {
        return parent::getTableQuery()
            ->where('parent_id', $this->parent_id)
            ->where('position', 'portal');
    }
    
    public function getTitle(): string 
    {
        if ($this->parentMenu) {
            return __('Submenu: :name', ['name' => $this->parentMenu->name]);
        }
        return __('Menu Navigasi');
    }

    public function getBackUrl(): string
    {
        if (! $this->parentMenu) {
            return MenuResource::getUrl();
        }

        if ($this->parentMenu->parent_id) {
            return MenuResource::getUrl('index', ['parent_id' => $this->parentMenu->parent_id]);
        }

        return MenuResource::getUrl();
    }

}