<?php

namespace App\Filament\Resources\WbsAbouts\Pages;

use App\Filament\Resources\WbsAbouts\WbsAboutResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageWbsAbouts extends ManageRecords
{
    protected static string $resource = WbsAboutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->hidden(fn () => \App\Models\WbsAbout::count() >= 1),
        ];
    }
}
