<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\Widget;

class SystemLogsWidget extends Widget
{
    protected string $view = 'filament.widgets.system-logs-widget';
    protected static ?string $pollingInterval = '10s';

    public $filter = 'terbaru';

    public function getData(): array
    {
        $query = Post::query();

        if ($this->filter === 'lama') {
            $query->oldest();
        } else {
            $query->latest();
        }

        return $query->take(3)->get()->map(fn($post) => [
            'title' => __('Pembaruan Berita') . ': ' . $post->title,
            'date' => $post->created_at->translatedFormat('d M Y H:i'),
            'views' => number_format($post->read ?? 0),
            'body' => \Illuminate\Support\Str::limit(strip_tags($post->description ?? ''), 100),
            'url' => url('/site-admin/posts'),
        ])->toArray();
    }
}
