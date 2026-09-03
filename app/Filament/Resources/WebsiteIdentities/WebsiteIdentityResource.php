<?php

namespace App\Filament\Resources\WebsiteIdentities;

use App\Filament\Resources\WebsiteIdentities\Pages\CreateWebsiteIdentity;
use App\Filament\Resources\WebsiteIdentities\Pages\EditWebsiteIdentity;
use App\Filament\Resources\WebsiteIdentities\Pages\ListWebsiteIdentities;
use App\Filament\Resources\WebsiteIdentities\Schemas\WebsiteIdentityForm;
use App\Filament\Resources\WebsiteIdentities\Tables\WebsiteIdentitiesTable;
use App\Models\WebsiteIdentity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WebsiteIdentityResource extends Resource
{
    protected static ?string $model = WebsiteIdentity::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationParentItem(): ?string
    {
        return 'Beranda';
    }

    public static function getNavigationLabel(): string
    {
        return __('Identitas Website');
    }

    public static function getModelLabel(): string
    {
        return __('Identitas Website');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Identitas Website');
    }

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WebsiteIdentityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WebsiteIdentitiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWebsiteIdentities::route('/'),
            'create' => CreateWebsiteIdentity::route('/create'),
            'edit' => EditWebsiteIdentity::route('/{record}/edit'),
        ];
    }
}
