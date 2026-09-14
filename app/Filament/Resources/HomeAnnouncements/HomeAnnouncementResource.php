<?php

namespace App\Filament\Resources\HomeAnnouncements;

use App\Filament\Resources\HomeAnnouncements\Pages\CreateHomeAnnouncement;
use App\Filament\Resources\HomeAnnouncements\Pages\EditHomeAnnouncement;
use App\Filament\Resources\HomeAnnouncements\Pages\ListHomeAnnouncements;
use App\Filament\Resources\HomeAnnouncements\Schemas\HomeAnnouncementForm;
use App\Filament\Resources\HomeAnnouncements\Tables\HomeAnnouncementsTable;
use App\Models\HomeAnnouncement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeAnnouncementResource extends Resource
{
    protected static ?string $model = HomeAnnouncement::class;

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
        return __('Pengumuman Gambar');
    }

    public static function getModelLabel(): string
    {
        return __('Pengumuman Gambar');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Pengumuman Gambar');
    }

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    public static function form(Schema $schema): Schema
    {
        return HomeAnnouncementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeAnnouncementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomeAnnouncements::route('/'),
            'create' => CreateHomeAnnouncement::route('/create'),
            'edit' => EditHomeAnnouncement::route('/{record}/edit'),
        ];
    }
}
