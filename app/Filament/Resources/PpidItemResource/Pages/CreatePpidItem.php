<?php

namespace App\Filament\Resources\PpidItemResource\Pages;

use App\Filament\Resources\PpidItemResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;
use App\Models\Ppid;
use Filament\Support\Enums\Width;

class CreatePpidItem extends CreateRecord
{
    protected static string $resource = PpidItemResource::class;

    protected static bool $canCreateAnother = false;

    public function getMaxContentWidth(): Width | string | null
    {
        return Width::Full;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (request()->has('ppid_id')) {
            $data['ppid_id'] = request()->query('ppid_id');
        }

        return $data;
    }

    public function getTitle(): string
    {
        $ppidId = request()->query('ppid_id');
        if ($ppidId) {
            $ppid = Ppid::find($ppidId);
            if ($ppid) {
                $breadcrumb = $ppid->name;
                if ($ppid->parent_id) {
                    $parent = Ppid::find($ppid->parent_id);
                    if ($parent) {
                        $breadcrumb = $parent->name . ' / ' . $breadcrumb;
                    }
                }
                return __('Upload Info Publik') . ' — ' . $breadcrumb;
            }
        }
        return __('Upload Info Publik');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label(__('Kembali'))
                ->icon('heroicon-o-chevron-left')
                ->color('gray')
                ->url(function () {
                    $ppidId = request()->query('ppid_id');
                    if ($ppidId) {
                        return PpidItemResource::getUrl('index', ['ppid_id' => $ppidId]);
                    }
                    return PpidItemResource::getUrl('index');
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Ambil ppid_id dari record yang baru disimpan (lebih reliable dari query string)
        $ppidId = $this->record?->ppid_id ?? request()->query('ppid_id');
        if ($ppidId) {
            return $this->getResource()::getUrl('index', ['ppid_id' => $ppidId]);
        }
        return $this->getResource()::getUrl('index');
    }
}
