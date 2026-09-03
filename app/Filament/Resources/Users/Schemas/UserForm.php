<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Nama'))
                    ->required(),
                TextInput::make('username')
                    ->label(__('Nama Pengguna'))
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('email')
                    ->label(__('Alamat Email'))
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\Select::make('role')
                    ->label(__('Hak Akses'))
                    ->options(\App\Enums\UserRole::class)
                    ->required()
                    ->default(\App\Enums\UserRole::Contributor),

                TextInput::make('password')
                    ->label(__('Kata Sandi'))
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }
}
