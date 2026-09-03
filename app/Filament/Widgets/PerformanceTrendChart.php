<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Post;

class PerformanceTrendChart extends ChartWidget
{
    public function getHeading(): ?string
    {
        return __('Tren Publikasi Bulanan');
    }
    protected ?string $pollingInterval = '30s';

    public function getMaxHeight(): ?string
    {
        return '300px';
    }

    protected function getFilters(): ?array
    {
        $years = Post::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year', 'year')
            ->toArray();

        $currentYear = now()->year;
        if (!isset($years[$currentYear])) {
            $years[$currentYear] = $currentYear;
        }

        return $years;
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? now()->year;

        $data = collect(range(0, 11))->map(function ($i) use ($activeFilter) {
            $date = \Illuminate\Support\Carbon::create($activeFilter, $i + 1, 1);
            return [
                'month' => $date->translatedFormat('M'),
                'count' => Post::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => __('Total Publikasi'),
                    'data' => $data->pluck('count')->toArray(),
                    'borderColor' => '#059669',
                    'backgroundColor' => 'rgba(5, 150, 105, 0.05)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointRadius' => 4,
                    'pointBackgroundColor' => '#fff',
                    'pointBorderWidth' => 2,
                    'borderWidth' => 4,
                ],
            ],
            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'y' => [
                    'grid' => ['display' => true, 'color' => 'rgba(148, 163, 184, 0.1)'],
                    'ticks' => ['display' => true, 'color' => '#94a3b8'],
                    'beginAtZero' => true,
                ],
                'x' => [
                    'grid' => ['display' => false],
                    'ticks' => ['color' => '#94a3b8'],
                ],
            ],
        ];
    }
}
