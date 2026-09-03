<?php

namespace App\Filament\Resources\PortalSettings\Pages;

use App\Filament\Resources\PortalSettings\PortalSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPortalSettings extends ListRecords
{
    protected static string $resource = PortalSettingResource::class;

    protected function getHeaderActions(): array
    {
        $canCreate = \App\Models\PortalSetting::count() === 0;

        return $canCreate ? [
            CreateAction::make(),
        ] : [];
    }
}
