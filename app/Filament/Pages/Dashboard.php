<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Carbon;

class Dashboard extends BaseDashboard
{
    protected string $view = 'filament.pages.dashboard';
    public function getTitle(): string
    {
        return __('Dasbor');
    }
    protected static ?int $navigationSort = 1;

    public function getMaxContentWidth(): string
    {
        return 'full';
    }

    public function getGreetingProperty(): string
    {
        $hour = now('Asia/Makassar')->hour;
        if ($hour < 11) return __('Selamat Pagi');
        if ($hour < 15) return __('Selamat Siang');
        if ($hour < 19) return __('Selamat Sore');
        return __('Selamat Malam');
    }

    public function getSystemHealthProperty(): int
    {
        // Simulate real-time fluctuating health score
        return rand(95, 99);
    }

    public function getWidgets(): array
    {
        return [];
    }
}
