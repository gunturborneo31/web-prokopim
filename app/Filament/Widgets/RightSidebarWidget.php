<?php

namespace App\Filament\Widgets;

use App\Models\Agenda;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class RightSidebarWidget extends Widget
{
    protected string $view = 'filament.widgets.right-sidebar-widget';

    public $month;
    public $year;
    public $selectedDay;

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->selectedDay = now()->day;
    }

    public function selectDay($day)
    {
        $this->selectedDay = $day;
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function getCalendarData(): array
    {
        $currentDate = Carbon::create($this->year, $this->month, 1);
        $now = now();

        $allAgendas = Agenda::whereMonth('schedule', $this->month)
            ->whereYear('schedule', $this->year)
            ->get();

        $agendasByDay = $allAgendas->groupBy(fn($item) => $item->schedule->format('j'));
        
        $selectedDateAgendas = Agenda::whereDate('schedule', Carbon::create($this->year, $this->month, $this->selectedDay))
            ->orderBy('schedule', 'asc')
            ->get();

        return [
            'monthName' => $currentDate->translatedFormat('F'),
            'year' => $this->year,
            'daysInMonth' => $currentDate->daysInMonth,
            'startDay' => (int) $currentDate->copy()->startOfMonth()->format('w'),
            'today' => ($this->month == $now->month && $this->year == $now->year) ? $now->day : null,
            'agendas' => $agendasByDay,
            'selectedAgendas' => $selectedDateAgendas,
            'selectedDateFull' => Carbon::create($this->year, $this->month, $this->selectedDay)->translatedFormat('d F Y')
        ];
    }

    public function getUpcomingAgendas()
    {
        return Agenda::where('schedule', '>=', now())
            ->orderBy('schedule', 'asc')
            ->take(5)
            ->get();
    }
}
