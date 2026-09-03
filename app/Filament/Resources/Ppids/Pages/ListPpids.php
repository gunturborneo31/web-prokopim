<?php

namespace App\Filament\Resources\Ppids\Pages;

use App\Filament\Resources\Ppids\PpidResource;
use App\Filament\Resources\Ppids\Schemas\PpidForm;
use App\Models\Ppid;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;

class ListPpids extends ListRecords 
{
    protected static string $resource = PpidResource::class;

    public function getMaxContentWidth(): \Filament\Support\Enums\Width | string | null
    {
        return \Filament\Support\Enums\Width::Full;
    }

    #[Url]
    public ?int $parent_id = null;

    #[Url]
    public ?string $activeTab = null;

    public ?int $editingPpidId = null;

    public array $ppidData = [];

    public ?Ppid $parentPpid = null;

    public function mount(): void
    {
        parent::mount();

        if ($this->parent_id) {
            $this->parentPpid = Ppid::find($this->parent_id);
        }
    }

    public function getTableQuery(): ?\Illuminate\Database\Eloquent\Builder
    {
        $query = Ppid::query();

        if ($this->parent_id) {
            return $query->where('parent_id', $this->parent_id);
        }

        return $query->whereNull('parent_id');
    }

    public function getTabs(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable 
    {
        if ($this->parentPpid) {
            return new \Illuminate\Support\HtmlString(
                '<div class="flex flex-col gap-1 -mt-1">' .
                    '<span class="text-xs font-bold uppercase tracking-wider text-primary-600">' . __('Info Publik / PPID') . '</span>' .
                    '<span class="text-2xl font-black tracking-tight text-gray-900 dark:text-white leading-tight">Sub Kategori: ' . e($this->parentPpid->name) . '</span>' .
                '</div>'
            );
        }
        return __('Info Publik / PPID');
    }

    protected function getHeaderActions(): array
    {
        $actions = [
            \Filament\Actions\Action::make('create')
                ->label(fn () => $this->parent_id ? __('Tambah Sub Kategori') : __('Tambah Kategori'))
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->form(fn (\Filament\Schemas\Schema $schema) => \App\Filament\Resources\Ppids\Schemas\PpidForm::configure($schema))
                ->fillForm(fn () => ['parent_id' => $this->parent_id ?? null])
                ->modalWidth('sm')
                ->modalHeading(fn () => $this->parent_id ? __('TAMBAH SUB KATEGORI') : __('TAMBAH KATEGORI'))
                ->modalSubmitActionLabel(__('Simpan'))
                ->action(function (array $data): void {
                    if ($this->parent_id) {
                        $data['parent_id'] = $this->parent_id;
                    }
                    \App\Models\Ppid::create($data);
                    \Filament\Notifications\Notification::make()
                        ->title(__('Kategori berhasil ditambahkan'))
                        ->success()
                        ->send();
                }),
        ];

        if ($this->parent_id) {
            array_unshift($actions, \Filament\Actions\Action::make('back')
                ->label(__('Kembali'))
                ->icon('heroicon-o-chevron-left')
                ->color('gray')
                ->url(function () {
                    $parent = \App\Models\Ppid::find($this->parent_id);
                    if ($parent && $parent->parent_id) {
                        return \App\Filament\Resources\Ppids\PpidResource::getUrl('index', ['parent_id' => $parent->parent_id]);
                    }
                    return \App\Filament\Resources\Ppids\PpidResource::getUrl('index');
                })
            );
        }

        return $actions;
    }
}