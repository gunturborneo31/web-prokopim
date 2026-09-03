<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\FileSharing;
use App\Models\User;
use Filament\Widgets\Widget;

class SystemHealthCircles extends Widget
{
    protected string $view = 'filament.widgets.system-health-circles';
    protected static ?string $pollingInterval = '15s';

    public function getData(): array
    {
        return [
            [
                'label' => __('Total Publikasi'),
                'value' => Post::count(),
                'target' => 50,
                'color' => '#059669',
                'unit' => __('Post')
            ],
            [
                'label' => __('Arsip File'),
                'value' => FileSharing::count(),
                'target' => 100,
                'color' => '#059669',
                'unit' => __('File')
            ],
            [
                'label' => __('User Aktif'),
                'value' => User::count(),
                'target' => 20,
                'color' => '#059669',
                'unit' => __('User')
            ],
            [
                'label' => __('Traffic Harian'),
                'value' => Post::sum('read') % 100,
                'target' => 100,
                'color' => '#059669',
                'unit' => __('Hits')
            ],
        ];
    }
}
