<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Beranda extends Page
{
    protected string $view = 'filament.pages.beranda';

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-home';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationLabel(): string
    {
        return 'Beranda';
    }

    protected static ?int $navigationSort = 1;
}
