<?php

namespace App\Filament\Resources\PpidRequestResource\Pages;

use App\Filament\Resources\PpidRequestResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewPpidRequest extends ViewRecord
{
    protected static string $resource = PpidRequestResource::class;

    protected string $view = 'filament.resources.ppid-request.pages.view-ppid-request';

    public function getTitle(): string
    {
        return __('Detail Permohonan') . ': ' . $this->record->nama_lengkap;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('update_status')
                ->label(__('Update Status'))
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->extraAttributes(['class' => 'btn-ta-custom btn-edit-custom'])
                ->mountUsing(fn ($form) => $form->fill([
                    'status'        => $this->record->status,
                    'respon_admin'  => $this->record->respon_admin,
                    'catatan_admin' => $this->record->catatan_admin,
                ]))
                ->form([
                    Select::make('status')
                        ->label(__('Status Permohonan'))
                        ->options([
                            'diajukan'  => __('Baru Diajukan'),
                            'diproses'  => __('Sedang Diproses'),
                            'disetujui' => __('Disetujui'),
                            'ditolak'   => __('Ditolak'),
                        ])
                        ->required(),
                    Textarea::make('respon_admin')
                        ->label(__('Respon / Tanggapan (Dapat Dilihat Pemohon)'))
                        ->placeholder(__('Tulis tanggapan Anda terhadap permohonan ini...'))
                        ->rows(4),
                    Textarea::make('catatan_admin')
                        ->label(__('Catatan Internal (Hanya Untuk Admin)'))
                        ->placeholder(__('Catatan internal...'))
                        ->rows(3),
                ])
                ->action(function (array $data): void {
                    $this->record->update([
                        'status'        => $data['status'],
                        'respon_admin'  => $data['respon_admin'] ?? $this->record->respon_admin,
                        'catatan_admin' => $data['catatan_admin'] ?? $this->record->catatan_admin,
                        'handled_by'    => auth()->id(),
                        'handled_at'    => now(),
                    ]);

                    Notification::make()
                        ->title(__('Status permohonan berhasil diperbarui'))
                        ->success()
                        ->send();
                }),

            Action::make('back')
                ->label(__('Kembali ke Daftar'))
                ->icon('heroicon-o-arrow-left')
                ->url(fn () => PpidRequestResource::getUrl('index'))
                ->color('gray')
                ->extraAttributes(['class' => 'btn-ta-custom']),
        ];
    }
}
