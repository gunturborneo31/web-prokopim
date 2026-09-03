<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickAccessWidget extends Widget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.widgets.quick-access-widget';

    public function getLinks(): array
    {
        return [
            ['label' => __('Portal'), 'icon' => 'heroicon-o-home', 'url' => '/site-admin/slider-portals', 'color' => 'emerald'],
            ['label' => __('Profil'), 'icon' => 'heroicon-o-user-circle', 'url' => '/site-admin/static-pages', 'color' => 'teal'],
            ['label' => __('Berita'), 'icon' => 'heroicon-o-newspaper', 'url' => '/site-admin/posts', 'color' => 'emerald'],
            ['label' => __('Agenda'), 'icon' => 'heroicon-o-calendar', 'url' => '/site-admin/agendas', 'color' => 'teal'],
            ['label' => __('PPID'), 'icon' => 'heroicon-o-information-circle', 'url' => '/site-admin/ppids', 'color' => 'emerald'],
            ['label' => __('Layanan'), 'icon' => 'heroicon-o-briefcase', 'url' => '/site-admin/services', 'color' => 'teal'],
            ['label' => __('Media'), 'icon' => 'heroicon-o-photo', 'url' => '/site-admin/sliders', 'color' => 'emerald'],
            ['label' => __('Arsip File'), 'icon' => 'heroicon-o-folder', 'url' => '/site-admin/file-sharings', 'color' => 'teal'],
            ['label' => __('Menu Utama'), 'icon' => 'heroicon-o-list-bullet', 'url' => '/site-admin/menus', 'color' => 'emerald'],
            ['label' => __('User'), 'icon' => 'heroicon-o-users', 'url' => '/site-admin/users', 'color' => 'teal'],
            ['label' => __('Web Identity'), 'icon' => 'heroicon-o-globe-alt', 'url' => '/site-admin/website-identities', 'color' => 'emerald'],
        ];
    }
}
