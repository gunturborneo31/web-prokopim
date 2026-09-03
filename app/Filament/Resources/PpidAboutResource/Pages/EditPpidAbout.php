<?php

namespace App\Filament\Resources\PpidAboutResource\Pages;

use App\Filament\Resources\PpidAboutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditPpidAbout extends EditRecord
{
    protected static string $resource = PpidAboutResource::class;

    public function getMaxContentWidth(): Width | string | null
    {
        return Width::Full;
    }

    public function getTitle(): string
    {
        return __('Edit Tentang PPID');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
