<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema; // Menggunakan Schema untuk Filament v4
use BackedEnum;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getNavigationGroup(): ?string
    {
        return 'Pengaturan';
    }

    public static function getNavigationLabel(): string
    {
        return __('Pengguna');
    }

    public static function getModelLabel(): string
    {
        return __('Pengguna');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Daftar Pengguna');
    }

    protected static ?int $navigationSort = 1;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-users';

    // PERBAIKAN KHUSUS FILAMENT V4:
    // Method ini sekarang wajib menerima parameter (Schema $schema) 
    // dan mengembalikan tipe data Schema.
    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}