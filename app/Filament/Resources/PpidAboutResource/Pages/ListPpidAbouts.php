<?php

namespace App\Filament\Resources\PpidAboutResource\Pages;

use App\Filament\Resources\PpidAboutResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\PpidAbout;
use Filament\Support\Enums\Width;

class ListPpidAbouts extends ListRecords
{
    protected static string $resource = PpidAboutResource::class;

    public function getMaxContentWidth(): Width | string | null
    {
        return Width::Full;
    }

    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        return __('TENTANG PPID');
    }

    protected function getHeaderActions(): array
    {
        $hasRecord = PpidAbout::count() > 0;

        return [
            Actions\Action::make('back')
                ->label(__('Kembali'))
                ->color('gray')
                ->icon('heroicon-o-chevron-left')
                ->button()
                ->url(fn () => \App\Filament\Resources\Ppids\Pages\ListPpids::getUrl()),

            Actions\CreateAction::make()
                ->label(__('Isi Tentang PPID'))
                ->color('primary')
                ->icon('heroicon-o-plus')
                ->visible(!$hasRecord)
                ->button(),
        ];
    }
}
