<?php

namespace App\Filament\Resources\PpidItemResource\Pages;

use App\Filament\Resources\PpidItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Ppid;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;

class ListPpidItems extends ListRecords
{
    protected static string $resource = PpidItemResource::class;

    public ?int $ppid_id = null;

    public function getMaxContentWidth(): Width | string | null
    {
        return Width::Full;
    }


    protected function getTableQuery(): ?Builder
    {
        $ppidId = request()->query('ppid_id');
        if ($ppidId) {
            return parent::getTableQuery()->where('ppid_id', $ppidId);
        }
        // Kembalikan query kosong jika tidak ada filter agar tidak tampil semua data
        return parent::getTableQuery()->where('id', 0);
    }

    protected function getHeaderActions(): array
    {
        $ppidId = request()->query('ppid_id');

        $backUrl = \App\Filament\Resources\Ppids\PpidResource::getUrl('index');
        if ($ppidId) {
            $ppid = Ppid::find($ppidId);
            if ($ppid && $ppid->parent_id) {
                $backUrl = \App\Filament\Resources\Ppids\PpidResource::getUrl('index', ['parent_id' => $ppid->parent_id]);
            }
        }

        return [
            Actions\Action::make('back')
                ->label(__('Kembali'))
                ->icon('heroicon-o-chevron-left')
                ->color('gray')
                ->url($backUrl),
                
            Actions\Action::make('create')
                ->label(__('Tambah File'))
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->url(fn () => PpidItemResource::getUrl('create', ['ppid_id' => $ppidId])),
        ];
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        $ppidId = request()->query('ppid_id');
        if ($ppidId) {
            $ppid = \App\Models\Ppid::find($ppidId);
            if ($ppid) {
                if ($ppid->parent_id) {
                    $parent = \App\Models\Ppid::find($ppid->parent_id);
                    if ($parent) {
                        return new \Illuminate\Support\HtmlString(
                            '<div class="flex flex-col gap-1 -mt-1">' .
                                '<span class="text-xs font-bold uppercase tracking-wider text-primary-600">' . e($parent->name) . '</span>' .
                                '<span class="text-2xl font-black tracking-tight text-gray-900 dark:text-white leading-tight">' . e($ppid->name) . '</span>' .
                            '</div>'
                        );
                    }
                }
                return $ppid->name;
            }
        }
        return __('Data Info Publik');
    }

    public function getTitle(): string|Htmlable
    {
        return $this->getHeading();
    }
}
