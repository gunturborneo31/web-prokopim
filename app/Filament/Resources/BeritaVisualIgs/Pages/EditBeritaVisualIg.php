<?php

namespace App\Filament\Resources\BeritaVisualIgs\Pages;

use App\Filament\Resources\BeritaVisualIgs\BeritaVisualIgResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\Width;

class EditBeritaVisualIg extends EditRecord
{
    protected static string $resource = BeritaVisualIgResource::class;

    public function getTitle(): string
    {
        return __('Ubah Berita Visual IG');
    }

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return __('Gambar berhasil diperbarui');
    }
}
