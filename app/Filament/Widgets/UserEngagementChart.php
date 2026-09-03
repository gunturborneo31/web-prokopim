<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class UserEngagementChart extends ChartWidget
{
    public function getHeading(): ?string
    {
        return __('Analitik Publikasi & Pembaca');
    }
    protected static ?int $sort = 3;
    protected ?string $pollingInterval = '60s';
    protected int | string | array $columnSpan = 'half';

    protected function getData(): array
    {
        // Simple data fetch since Trend might not be installed
        $data = Post::selectRaw('DATE(created_at) as date, SUM(`read`) as total_reads, COUNT(*) as post_count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => __('Total Pembaca'),
                    'data' => $data->pluck('total_reads')->toArray(),
                    'borderColor' => '#3b82f6',
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
                [
                    'label' => __('Artikel Baru'),
                    'data' => $data->pluck('post_count')->toArray(),
                    'borderColor' => '#10b981',
                ],
            ],
            'labels' => $data->pluck('date')->map(fn ($date) => Carbon::parse($date)->format('d M'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
