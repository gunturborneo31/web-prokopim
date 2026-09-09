<?php

namespace App\Filament\Resources\BeritaVisualIgs;

use App\Filament\Resources\BeritaVisualIgs\Pages\CreateBeritaVisualIg;
use App\Filament\Resources\BeritaVisualIgs\Pages\EditBeritaVisualIg;
use App\Filament\Resources\BeritaVisualIgs\Pages\ListBeritaVisualIgs;
use App\Filament\Resources\BeritaVisualIgs\Schemas\BeritaVisualIgForm;
use App\Filament\Resources\BeritaVisualIgs\Tables\BeritaVisualIgsTable;
use App\Models\BeritaVisualIg;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BeritaVisualIgResource extends Resource
{
    protected static ?string $model = BeritaVisualIg::class;

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
        return __('Berita Visual IG');
    }

    public static function getModelLabel(): string
    {
        return __('Berita Visual IG');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Berita Visual IG');
    }

    protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCamera;

    public static function form(Schema $schema): Schema
    {
        return BeritaVisualIgForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BeritaVisualIgsTable::configure($table);
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
            'index' => ListBeritaVisualIgs::route('/'),
            'create' => CreateBeritaVisualIg::route('/create'),
            'edit' => EditBeritaVisualIg::route('/{record}/edit'),
        ];
    }
}
