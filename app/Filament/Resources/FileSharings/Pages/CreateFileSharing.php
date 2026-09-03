<?php

namespace App\Filament\Resources\FileSharings\Pages;

use App\Filament\Resources\FileSharings\FileSharingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFileSharing extends CreateRecord
{
    protected static string $resource = FileSharingResource::class;

    protected static bool $canCreateAnother = false;
}
