<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\FileSharing;
use App\Models\Post;
use App\Models\Service; // Changed from WebsiteServer

class SystemHealthWidget extends Widget
{
    protected static ?int $sort = 3;
    protected string $view = 'filament.widgets.system-health-widget';

    public function getData(): array
    {
        $totalFiles = FileSharing::count();
        $totalPosts = Post::count();
        // Use Service instead of WebsiteServer
        $totalServices = Service::count();
        $activeServices = Service::where('status', true)->count();
        $inactiveServices = $totalServices - $activeServices;
        
        // Simulating storage based on post/file counts to feel "integrated"
        $storageUsed = min(95, 40 + ($totalFiles * 0.5) + ($totalPosts * 0.1));
        
        // Performance score based on service status
        $score = $totalServices > 0 ? round(($activeServices / $totalServices) * 100) : 100;

        return [
            'storage' => [
                'used' => round($storageUsed),
                'label' => __('Penyimpanan Media'),
                'files' => $totalFiles,
            ],
            'performance' => [
                'score' => $score,
                'status' => $score >= 90 ? __('Sangat Baik') : ($score >= 70 ? __('Baik') : __('Perlu Perhatian')),
                'servers' => [ // Keeping key as 'servers' for view compatibility or rename it? View uses ['servers']['active']
                    'total' => $totalServices,
                    'active' => $activeServices,
                    'inactive' => $inactiveServices,
                ]
            ],
            'last_sync' => now('Asia/Makassar')->translatedFormat('H:i') . ' ' . __('WITA'),
        ];
    }
}
