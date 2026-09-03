<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class Tabel implements TemplateSchema
{
    public static function schema(): array
    {
        return Dokumen::schema();
    }
}
