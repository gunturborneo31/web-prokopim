<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Post;

class ActivityBarChart extends ChartWidget
{
    public function getHeading(): ?string
    {
        return __('Aktivitas Publikasi Mingguan');
    }
    protected ?string $pollingInterval = '30s';

    public function getMaxHeight(): ?string
    {
        return '250px';
    }

    protected function getFilters(): ?array
    {
        return [
            '0' => __('Minggu Ini'),
            '1' => __('1 Minggu Lalu'),
            '2' => __('2 Minggu Lalu'),
            '3' => __('3 Minggu Lalu'),
        ];
    }

    protected function getData(): array
    {
        $activeFilter = (int) ($this->filter ?? 0);
        $startDate = now()->subWeeks($activeFilter)->startOfWeek();

        $data = collect(range(0, 6))->map(function ($i) use ($startDate) {
            $date = $startDate->copy()->addDays($i);
            $count = Post::whereDate('created_at', $date->toDateString())->count();
            return [
                'day' => $date->translatedFormat('D'),
                'count' => $count,
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => __('Berita Diterbitkan'),
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => $data->map(fn($item) => $item['count'] > 0 ? '#059669' : 'rgba(148, 163, 184, 0.1)')->toArray(),
                    'borderRadius' => 8,
                    'maxBarThickness' => 30,
                ],
            ],
            'labels' => $data->pluck('day')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => false],
                'tooltip' => [
                    'callbacks' => [
                        'label' => fn($context) => $context->parsed->y . ' ' . __('Berita dibuat')
                    ]
                ]
            ],
            'scales' => [
                'y' => ['display' => false],
                'x' => [
                    'grid' => ['display' => false],
                    'ticks' => ['color' => '#94a3b8', 'font' => ['weight' => 'bold']],
                ],
            ],
        ];
    }
}
