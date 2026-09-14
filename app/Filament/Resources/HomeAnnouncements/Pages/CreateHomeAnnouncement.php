<?php

namespace App\Filament\Resources\HomeAnnouncements\Pages;

use App\Filament\Resources\HomeAnnouncements\HomeAnnouncementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeAnnouncement extends CreateRecord
{
    protected static string $resource = HomeAnnouncementResource::class;

    public function getTitle(): string
    {
        return __('Tambah Pengumuman Gambar');
    }
}
