<?php

namespace App\Filament\Resources\WebsiteMenus\Pages;

use App\Filament\Resources\WebsiteMenus\WebsiteMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListWebsiteMenus extends ListRecords
{
    protected static string $resource = WebsiteMenuResource::class;

    #[\Livewire\Attributes\Url]
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
            $actions[] = Actions\Action::make('back')
                ->label(__('Kembali ke :parent', ['parent' => $this->parentMenu && $this->parentMenu->parent ? $this->parentMenu->parent->name : __('Menu Utama')]))
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url($this->getBackUrl());
        }

        $actions[] = Actions\CreateAction::make()
            ->label(__('Tambah Menu Website'))
            ->modalWidth('2xl')
            ->mutateFormDataUsing(function (array $data): array {
                $data['position'] = 'website';
                $data['parent_id'] = $this->parent_id;
                return $data;
            });

        return $actions;
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()
            ->where('parent_id', $this->parent_id)
            ->where('position', 'website');
    }

    public function getTitle(): string 
    {
        if ($this->parentMenu) {
            return __('Submenu Content: :name', ['name' => $this->parentMenu->name]);
        }
        return __('Menu Website');
    }

    public function getBackUrl(): string
    {
        if (! $this->parentMenu) {
            return WebsiteMenuResource::getUrl();
        }

        if ($this->parentMenu->parent_id) {
            return WebsiteMenuResource::getUrl('index', ['parent_id' => $this->parentMenu->parent_id]);
        }

        return WebsiteMenuResource::getUrl();
    }
}
