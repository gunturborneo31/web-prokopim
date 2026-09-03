<?php

namespace App\Filament\Resources\PpidRequestResource\Pages;

use App\Filament\Resources\PpidRequestResource;
use Filament\Resources\Pages\ListRecords;

class ListPpidRequests extends ListRecords
{
    protected static string $resource = PpidRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
