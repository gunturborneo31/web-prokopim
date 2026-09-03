<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PpidRequestResource\Pages;
use App\Filament\Resources\PpidRequestResource\Tables\PpidRequestsTable;
use App\Models\PpidRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PpidRequestResource extends Resource
{
    protected static ?string $model = PpidRequest::class;

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationParentItem(): ?string
    {
        return __('PPID');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function getModelLabel(): string
    {
        return __('Permohonan Informasi');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Data Permohonan Informasi');
    }

    public static function getNavigationLabel(): string
    {
        return __('Permohonan Informasi PPID');
    }

    public static function getNavigationBadge(): ?string
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable(app(static::getModel())->getTable())) {
            return null;
        }

        return (string) PpidRequest::where('status', 'diajukan')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return PpidRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPpidRequests::route('/'),
            'view'   => Pages\ViewPpidRequest::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
