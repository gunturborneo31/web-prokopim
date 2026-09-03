<?php

namespace App\Filament\Widgets;

use App\Models\FileSharing;
use Filament\Widgets\Widget;

class RecentDocumentsWidget extends Widget
{
    protected string $view = 'filament.widgets.recent-documents-widget';
    protected static ?string $pollingInterval = '10s';

    public function getData(): array
    {
        return FileSharing::where('is_folder', false)
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($file) => [
                'name' => $file->title,
                'size' => $file->file_size_formatted,
                'type' => strtoupper(pathinfo($file->file_path, PATHINFO_EXTENSION) ?: 'FILE'),
                'date' => $file->created_at->diffForHumans(),
            ])
            ->toArray();
    }
}
