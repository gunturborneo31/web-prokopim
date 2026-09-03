<?php

namespace App\Filament\Resources\Ppids\Pages;

use App\Filament\Resources\Ppids\PpidResource;
use App\Models\Ppid;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreatePpid extends CreateRecord
{
    protected static string $resource = PpidResource::class;

    public function getMaxContentWidth(): \Filament\Support\Enums\Width | string | null
    {
        return \Filament\Support\Enums\Width::Full;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (request()->has('parent_id')) {
            $data['parent_id'] = request()->query('parent_id');
        }

        return $data;
    }

    public function getTitle(): string|Htmlable
    {
        $title = __('Upload Info Publik');
        
        $parentId = request()->query('parent_id');
        if ($parentId) {
            $parent = Ppid::find($parentId);
            if ($parent) {
                $breadcrumb = $parent->name;
                if ($parent->parent_id) {
                    $grandParent = Ppid::find($parent->parent_id);
                    if ($grandParent) {
                        $breadcrumb = $grandParent->name . ' / ' . $breadcrumb;
                    }
                }
                $title .= ' — ' . $breadcrumb;
            }
        }

        return $title;
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label(__('Kembali'))
                ->color('gray')
                ->url($this->getRedirectUrl()),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label(__('Simpan')),
            $this->getCancelFormAction()
                ->label(__('Kembali')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        $parentId = request()->query('parent_id');
        if ($parentId) {
            return $this->getResource()::getUrl('index', ['parent_id' => $parentId]);
        }

        return $this->getResource()::getUrl('index');
    }
}
