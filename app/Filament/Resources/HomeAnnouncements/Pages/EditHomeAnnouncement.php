<?php

namespace App\Filament\Resources\HomeAnnouncements\Pages;

use App\Filament\Resources\HomeAnnouncements\HomeAnnouncementResource;
use Filament\Resources\Pages\EditRecord;

class EditHomeAnnouncement extends EditRecord
{
    protected static string $resource = HomeAnnouncementResource::class;

    public function getTitle(): string
    {
        return __('Ubah Pengumuman Gambar');
    }
}
