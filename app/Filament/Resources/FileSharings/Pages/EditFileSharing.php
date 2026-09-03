<?php

namespace App\Filament\Resources\FileSharings\Pages;

use App\Filament\Resources\FileSharings\FileSharingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFileSharing extends EditRecord
{
    protected static string $resource = FileSharingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
