<?php

namespace App\Filament\Resources\Agendas;

use App\Filament\Resources\Agendas\Pages\ListAgendas;
use App\Filament\Resources\Agendas\Schemas\AgendaForm;
use App\Filament\Resources\Agendas\Tables\AgendasTable;
use App\Models\Agenda;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationParentItem(): ?string
    {
        return 'Beranda';
    }

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('Agenda');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Agenda');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    public static function form(Schema $schema): Schema
    {
        return AgendaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AgendasTable::configure($table);
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
            'index' => ListAgendas::route('/'),
        ];
    }
}
