<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

interface TemplateSchema
{
    /**
     * Get the schema components for this template.
     */
    public static function schema(): array;
}
