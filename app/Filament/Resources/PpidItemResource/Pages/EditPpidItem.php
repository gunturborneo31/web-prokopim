<?php

namespace App\Filament\Resources\PpidItemResource\Pages;

use App\Filament\Resources\PpidItemResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;
use App\Models\Ppid;
use Filament\Support\Enums\Width;

class EditPpidItem extends EditRecord
{
    protected static string $resource = PpidItemResource::class;

    public function getMaxContentWidth(): Width | string | null
    {
        return Width::Full;
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        $ppidId = $this->record->ppid_id;
        if ($ppidId) {
            $ppid = Ppid::find($ppidId);
            if ($ppid) {
                if ($ppid->parent_id) {
                    $parent = Ppid::find($ppid->parent_id);
                    if ($parent) {
                        return __('Edit Info Publik') . ' — ' . $parent->name . ' / ' . $ppid->name;
                    }
                }
                return __('Edit Info Publik') . ' — ' . $ppid->name;
            }
        }
        return __('Edit Info Publik');
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return $this->getHeading();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label(__('Kembali'))
                ->icon('heroicon-o-chevron-left')
                ->color('gray')
                ->url(fn () => PpidItemResource::getUrl('index', ['ppid_id' => $this->record->ppid_id])),
            Actions\DeleteAction::make()
                ->label(__('Hapus'))
                ->icon('heroicon-o-trash'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index', ['ppid_id' => $this->record->ppid_id]);
    }
}
