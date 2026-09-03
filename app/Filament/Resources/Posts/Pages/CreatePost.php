<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function mount(): void
    {
        parent::mount();

        if (request()->has('category_id')) {
            $this->data['category_id'] = request()->query('category_id');
        }
    }

    public function getTitle(): string
    {
        return __('Tambah Tulisan');
    }

    public function getMaxContentWidth(): \Filament\Support\Enums\Width | string | null
    {
        return \Filament\Support\Enums\Width::Full;
    }
}
