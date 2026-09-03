<?php

namespace App\Filament\Resources\PortalSettings;

use App\Filament\Resources\PortalSettings\Pages\CreatePortalSetting;
use App\Filament\Resources\PortalSettings\Pages\EditPortalSetting;
use App\Filament\Resources\PortalSettings\Pages\ListPortalSettings;
use App\Filament\Resources\PortalSettings\Schemas\PortalSettingForm;
use App\Filament\Resources\PortalSettings\Tables\PortalSettingsTable;
use App\Models\PortalSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PortalSettingResource extends Resource
{
    protected static ?string $model = PortalSetting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    public static function getNavigationGroup(): ?string
    {
        return 'Portal';
    }

    public static function getModelLabel(): string
    {
        return __('Pengaturan Portal');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Pengaturan Portal');
    }

    public static function getNavigationLabel(): string
    {
        return __('Pengaturan Portal');
    }

    protected static ?int $navigationSort = 4;

    public static function canCreate(): bool
    {
        return PortalSetting::count() === 0;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return PortalSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortalSettingsTable::configure($table);
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
            'index' => ListPortalSettings::route('/'),
            'create' => CreatePortalSetting::route('/create'),
            'edit' => EditPortalSetting::route('/{record}/edit'),
        ];
    }
}
