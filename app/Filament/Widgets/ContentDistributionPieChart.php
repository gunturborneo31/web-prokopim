<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Post;
use App\Models\Ppid;
use App\Models\Agenda;
use App\Models\Service;

class ContentDistributionPieChart extends ChartWidget
{
    public function getHeading(): ?string
    {
        return __('Proporsi Data Ekosistem');
    }

    public function getMaxHeight(): ?string
    {
        return '200px';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => __('Distribusi Konten'),
                    'data' => [
                        Post::count(),
                        Ppid::count(),
                        Agenda::count(),
                        Service::count(),
                    ],
                    'backgroundColor' => ['#059669', '#10b981', '#34d399', '#064e3b'],
                ],
            ],
            'labels' => [__('Berita'), __('PPID'), __('Agenda'), __('Layanan')],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'font' => ['size' => 10, 'weight' => '600']
                    ],
                ],
            ],
            'cutout' => '70%',
        ];
    }
}
