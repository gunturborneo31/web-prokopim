<?php

namespace App\Filament\Pages;

use App\Filament\Resources\BeritaVisualIgs\BeritaVisualIgResource;
use App\Filament\Resources\HomeAnnouncements\HomeAnnouncementResource;
use App\Filament\Resources\Sliders\SliderResource;
use App\Models\BeritaVisualIg;
use App\Models\HomeAnnouncement;
use App\Models\Slider;
use BackedEnum;
use Filament\Pages\Page;

class KelolaHomepage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected string $view = 'filament.pages.kelola-homepage';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getNavigationParentItem(): ?string
    {
        return 'Beranda';
    }

    public static function getNavigationLabel(): string
    {
        return 'Kelola Homepage';
    }

    public function getTitle(): string
    {
        return 'Kelola Homepage';
    }

    public function getSliderStats(): array
    {
        $items = Slider::query()->latest('updated_at')->take(5)->get();

        return [
            'count' => Slider::query()->count(),
            'active_count' => Slider::query()->where('status', 1)->count(),
            'items' => $items,
            'url' => SliderResource::getUrl('index'),
            'create_url' => SliderResource::getUrl('create'),
        ];
    }

    public function getVisualIgStats(): array
    {
        $items = BeritaVisualIg::query()->latest('updated_at')->take(5)->get();

        return [
            'count' => BeritaVisualIg::query()->count(),
            'active_count' => BeritaVisualIg::query()->where('is_active', true)->count(),
            'items' => $items,
            'url' => BeritaVisualIgResource::getUrl('index'),
            'create_url' => BeritaVisualIgResource::getUrl('create'),
        ];
    }

    public function getPengumumanGambarStats(): array
    {
        $items = HomeAnnouncement::query()->latest('updated_at')->take(5)->get();

        return [
            'count' => HomeAnnouncement::query()->count(),
            'active_count' => HomeAnnouncement::query()->where('status', true)->count(),
            'items' => $items,
            'url' => HomeAnnouncementResource::getUrl('index'),
            'create_url' => HomeAnnouncementResource::getUrl('create'),
        ];
    }
}
