<?php

namespace App\Filament\Resources\Pengaduans;

use App\Filament\Resources\Pengaduans\Pages\ListPengaduans;
use App\Filament\Resources\Pengaduans\Pages\ViewPengaduan;
use App\Filament\Resources\Pengaduans\Tables\PengaduansTable;
use App\Models\Pengaduan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;
    protected static bool $shouldRegisterNavigation = true;

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }



    public static function getModelLabel(): string
    {
        return __('Pengaduan');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Data Pengaduan');
    }

    public static function getNavigationLabel(): string
    {
        return __('Layanan Pengaduan');
    }

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    public static function getNavigationBadge(): ?string
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable(app(static::getModel())->getTable())) {
            return null;
        }

        return (string) Pengaduan::where('status', 'baru')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return PengaduansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPengaduans::route('/'),
            'view'   => ViewPengaduan::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
