<?php

namespace App\Filament\Resources\WebsiteIdentities\Pages;

use App\Filament\Resources\WebsiteIdentities\WebsiteIdentityResource;
use App\Models\WebsiteIdentity;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteIdentities extends ListRecords
{
    protected static string $resource = WebsiteIdentityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('Buat Identitas Website'))
                ->visible(fn () => WebsiteIdentity::count() === 0),
        ];
    }
}
