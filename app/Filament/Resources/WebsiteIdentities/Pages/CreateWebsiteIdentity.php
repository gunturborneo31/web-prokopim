<?php

namespace App\Filament\Resources\WebsiteIdentities\Pages;

use App\Filament\Resources\WebsiteIdentities\WebsiteIdentityResource;
use App\Models\WebsiteIdentity;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateWebsiteIdentity extends CreateRecord
{
    protected static string $resource = WebsiteIdentityResource::class;

    protected static bool $canCreateAnother = false;

    public function mount(): void
    {
        if (WebsiteIdentity::count() >= 1) {
            Notification::make()
                ->title(__('Identitas Website Sudah Ada'))
                ->body(__('Hanya dapat membuat satu identitas website. Silakan edit yang sudah ada.'))
                ->warning()
                ->send();

            $this->redirect($this->getResource()::getUrl('index'));
            return;
        }

        parent::mount();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
