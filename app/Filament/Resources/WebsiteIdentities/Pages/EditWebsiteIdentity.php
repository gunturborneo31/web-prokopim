<?php

namespace App\Filament\Resources\WebsiteIdentities\Pages;

use App\Filament\Resources\WebsiteIdentities\WebsiteIdentityResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteIdentity extends EditRecord
{
    protected static string $resource = WebsiteIdentityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview_beranda')
                ->label('Lihat Beranda')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(url('/website'))
                ->openUrlInNewTab(),

            Action::make('preview_portal')
                ->label('Lihat Portal')
                ->icon('heroicon-o-globe-alt')
                ->color('info')
                ->url(url('/'))
                ->openUrlInNewTab(),

            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
