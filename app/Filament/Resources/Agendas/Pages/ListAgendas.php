<?php

namespace App\Filament\Resources\Agendas\Pages;

use App\Filament\Resources\Agendas\AgendaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAgendas extends ListRecords
{
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('Tambah Agenda'))
                ->icon('heroicon-o-plus')
                ->modalHeading(__('Tambah Agenda Baru'))
                ->modalWidth('2xl')
                ->mutateFormDataUsing(function (array $data): array {
                    // Combine temp_date and temp_time into schedule
                    if (isset($data['temp_date']) && isset($data['temp_time'])) {
                        $date = is_object($data['temp_date']) 
                            ? $data['temp_date']->format('Y-m-d') 
                            : $data['temp_date'];
                        
                        $time = is_object($data['temp_time']) 
                            ? $data['temp_time']->format('H:i') 
                            : $data['temp_time'];
                        
                        $data['schedule'] = $date . ' ' . $time . ':00';
                    }

                    unset($data['temp_date']);
                    unset($data['temp_time']);

                    return $data;
                }),
        ];
    }
}