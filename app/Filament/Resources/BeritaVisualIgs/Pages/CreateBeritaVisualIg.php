<?php

namespace App\Filament\Resources\BeritaVisualIgs\Pages;

use App\Filament\Resources\BeritaVisualIgs\BeritaVisualIgResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateBeritaVisualIg extends CreateRecord
{
    protected static string $resource = BeritaVisualIgResource::class;

    public function getTitle(): string
    {
        return __('Tambah Berita Visual IG');
    }

    public function getMaxContentWidth(): Width|string|null
    {
        return Width::Full;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return __('Gambar berhasil ditambahkan');
    }
}
