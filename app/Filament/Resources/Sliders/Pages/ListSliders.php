<?php

namespace App\Filament\Resources\Sliders\Pages;

use App\Filament\Resources\Sliders\SliderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\Slider;

class ListSliders extends ListRecords
{
    protected static string $resource = SliderResource::class;

    // 1. Definisikan custom view
    protected string $view = 'filament.resources.sliders.pages.list-sliders';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('Tambah Slider'))
                ->visible(fn () => Slider::count() < 10),
        ];
    }

    // 2. Kirim data sliders ke view
    protected function getViewData(): array
    {
        return [
            'sliders' => Slider::with('file')
                ->orderBy('is_pinned', 'desc') // Prioritaskan yang disematkan
                ->latest()
                ->paginate(12),
        ];
    }

    public function togglePin(int $id): void
    {
        $slider = Slider::findOrFail($id);
        $slider->is_pinned = !$slider->is_pinned;
        $slider->save();

        $status = $slider->is_pinned ? __('disematkan') : __('dilepas dari sematan');
        
        \Filament\Notifications\Notification::make()
            ->title(__('Slider berhasil :status', ['status' => $status]))
            ->success()
            ->send();
    }

    public function deleteSlider(int $id): void
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();

        \Filament\Notifications\Notification::make()
            ->title(__('Slider berhasil dihapus'))
            ->success()
            ->send();
    }
}