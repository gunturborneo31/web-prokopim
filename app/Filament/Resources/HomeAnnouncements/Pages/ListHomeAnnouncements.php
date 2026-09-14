<?php

namespace App\Filament\Resources\HomeAnnouncements\Pages;

use App\Filament\Resources\HomeAnnouncements\HomeAnnouncementResource;
use App\Models\HomeAnnouncement;
use Filament\Resources\Pages\ListRecords;

class ListHomeAnnouncements extends ListRecords
{
    protected static string $resource = HomeAnnouncementResource::class;

    public function getTitle(): string
    {
        return __('Pengumuman Gambar');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public static function getNavigationLabel(): string
    {
        return __('Pengumuman Gambar');
    }

    protected function getDefaultTableSort(): ?array
    {
        return ['order' => 'asc'];
    }
}
