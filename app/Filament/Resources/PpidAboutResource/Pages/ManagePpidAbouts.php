<?php

namespace App\Filament\Resources\PpidAboutResource\Pages;

use App\Filament\Resources\PpidAboutResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePpidAbouts extends ManageRecords
{
    protected static string $resource = PpidAboutResource::class;

    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        return 'TENTANG-PPID';
    }

    protected function getHeaderActions(): array
    {
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
                ->modalWidth('5xl')
                ->button(),
        ];
    }
}
