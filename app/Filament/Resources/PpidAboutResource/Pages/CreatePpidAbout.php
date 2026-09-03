<?php

namespace App\Filament\Resources\PpidAboutResource\Pages;

use App\Filament\Resources\PpidAboutResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreatePpidAbout extends CreateRecord
{
    protected static string $resource = PpidAboutResource::class;

    public function getMaxContentWidth(): Width | string | null
    {
        return Width::Full;
    }

    public function getTitle(): string
    {
        return __('Buat Tentang PPID');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
