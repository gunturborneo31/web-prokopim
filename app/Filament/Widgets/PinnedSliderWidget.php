<?php

namespace App\Filament\Widgets;

use App\Models\Slider;
use Filament\Widgets\Widget;

class PinnedSliderWidget extends Widget
{
    protected static ?int $sort = -10; // High priority
    protected string $view = 'filament.widgets.pinned-slider-widget';

    public function getPinnedSliders()
    {
        return Slider::where('is_pinned', true)
            ->where('status', 1)
            ->latest()
            ->get();
    }
}
