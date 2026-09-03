<?php

namespace App\Filament\Resources\Pengaduans\Pages;

use App\Filament\Resources\Pengaduans\PengaduanResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class ViewPengaduan extends ViewRecord
{
    protected static string $resource = PengaduanResource::class;

    protected string $view = 'filament.resources.pengaduans.pages.view-pengaduan';

    public function getTitle(): string
    {
        return __('Detail Laporan') . ': ' . $this->record->kode_laporan;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('update_status')
                ->label(__('Update Status'))
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->extraAttributes(['class' => 'btn-ta-custom btn-edit-custom'])
                ->fillForm(fn (): array => [
                    'status'        => $this->record->status,
                    'respon_publik' => $this->record->respon_publik,
                    'catatan_admin' => $this->record->catatan_admin,
                ])
                ->form([
                    Select::make('status')
                        ->label(__('Status Laporan'))
                        ->options([
                            'baru'     => __('Laporan Baru'),
                            'diproses' => __('Sedang Diproses'),
                            'selesai'  => __('Selesai'),
                            'ditolak'  => __('Ditolak'),
                        ])
                        ->required(),
                    Textarea::make('respon_publik')
                        ->label(__('Respon / Tanggapan (Dapat Dilihat Pelapor)'))
                        ->placeholder(__('Tulis tanggapan Anda terhadap laporan ini...'))
                        ->rows(4),
                    Textarea::make('catatan_admin')
                        ->label(__('Catatan Internal (Hanya Untuk Admin)'))
                        ->placeholder(__('Catatan internal...'))
                        ->rows(3),
                ])
                ->action(function (array $data): void {
                    $this->record->update([
                        'status'        => $data['status'],
                        'respon_publik' => $data['respon_publik'] ?? $this->record->respon_publik,
                        'catatan_admin' => $data['catatan_admin'] ?? $this->record->catatan_admin,
                        'handled_by'    => auth()->id(),
                        'handled_at'    => now(),
                    ]);

                    Notification::make()
                        ->title(__('Status laporan berhasil diperbarui'))
                        ->success()
                        ->send();
                }),

            Action::make('back')
                ->label(__('Kembali ke Daftar'))
                ->icon('heroicon-o-arrow-left')
                ->url(fn () => PengaduanResource::getUrl('index'))
                ->color('gray')
                ->extraAttributes(['class' => 'btn-ta-custom']),
        ];
    }
}
