<?php

namespace App\Filament\Resources\Agendas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AgendasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label(__('NO'))
                    ->rowIndex()
                    ->alignCenter()
                    ->width('60px'),
                TextColumn::make('schedule')
                    ->label(__('JADWAL'))
                    ->formatStateUsing(fn (\App\Models\Agenda $record): string => 
                        $record->schedule ? $record->schedule->format('d/m/Y H:i') : '-'
                    )
                    ->searchable()
                    ->extraCellAttributes(['class' => 'column-nama-menu'])
                    ->alignCenter(),
                TextColumn::make('caption')
                    ->label(__('DETAIL'))
                    ->description(fn (\App\Models\Agenda $record): string => 
                        \Illuminate\Support\Str::limit($record->description ?? '', 80)
                    )
                    ->searchable()
                    ->extraCellAttributes(['class' => 'long-text-column'])
                    ->alignLeft(),
                TextColumn::make('location')
                    ->label(__('LOKASI KEGIATAN'))
                    ->searchable()
                    ->extraCellAttributes(['class' => 'long-text-column'])
                    ->alignCenter(),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('')
                    ->tooltip(__('Ubah'))
                    ->modalHeading(__('Edit Agenda'))
                    ->modalWidth('2xl')
                    ->fillForm(function (\App\Models\Agenda $record): array {
                        $data = $record->attributesToArray();
                        
                        // Fill virtual fields from schedule
                        if ($record->schedule) {
                            $data['temp_date'] = $record->schedule; 
                            $data['temp_time'] = $record->schedule;
                        }
                        
                        return $data;
                    })
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
                \Filament\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip(__('Hapus'))
                    ->modalHeading(__('Hapus Agenda'))
                    ->modalDescription(__('Apakah Anda yakin ingin menghapus agenda ini?'))
                    ->modalSubmitActionLabel(__('Ya, Hapus'))
                    ->modalCancelActionLabel(__('Batal')),
            ])
            ->recordUrl(null)
            ->filters([
                \Filament\Tables\Filters\Filter::make('schedule')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('tanggal')
                            ->label(__('Tanggal'))
                            ->placeholder(__('Pilih tanggal'))
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->closeOnDateSelection(),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['tanggal'],
                            fn ($query, $date) => $query->whereDate('schedule', $date)
                        );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if ($data['tanggal'] ?? null) {
                            return __('Tanggal') . ': ' . \Carbon\Carbon::parse($data['tanggal'])->format('d/m/Y');
                        }
                        
                        return null;
                    }),

                \Filament\Tables\Filters\SelectFilter::make('location')
                    ->label(__('Lokasi'))
                    ->options(fn () => 
                        \App\Models\Agenda::whereNotNull('location')
                            ->distinct()
                            ->pluck('location', 'location')
                    ),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->emptyStateHeading(__('Belum ada agenda'))
            ->emptyStateDescription(__('Silakan tambahkan agenda baru menggunakan tombol "Tambah Agenda" di atas.'))
            ->searchPlaceholder(__('Cari agenda...'))
            ->paginationPageOptions([5, 10, 25, 50])
            ->defaultPaginationPageOption(5)
            ->defaultSort('id', 'desc');
    }
}
