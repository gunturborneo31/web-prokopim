<?php

namespace App\Filament\Resources\BeritaVisualIgs\Pages;

use App\Filament\Resources\BeritaVisualIgs\BeritaVisualIgResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListBeritaVisualIgs extends ListRecords
{
    protected static string $resource = BeritaVisualIgResource::class;

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('Tambah Gambar'))
                ->icon('heroicon-o-plus'),
        ];
    }
}
