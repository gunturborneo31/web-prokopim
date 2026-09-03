<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';

    public function getTitle(): string | Htmlable
    {
        return __('filament-panels::auth/pages/login.title');
    }

    public function getHeading(): string | Htmlable
    {
        return '';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label(__('filament-panels::auth/pages/login.form.email.label'))
                    ->email()
                    ->required()
                    ->autocomplete()
                    ->autofocus()
                    ->prefixIcon('heroicon-m-envelope')
                    ->extraInputAttributes(['style' => 'border-radius: 12px']),
                TextInput::make('password')
                    ->label(__('filament-panels::auth/pages/login.form.password.label'))
                    ->password()
                    ->required()
                    ->prefixIcon('heroicon-m-lock-closed')
                    ->revealable()
                    ->extraInputAttributes(['style' => 'border-radius: 12px']),
                Checkbox::make('remember')
                    ->label(__('filament-panels::auth/pages/login.form.remember.label')),
            ]);
    }
}
