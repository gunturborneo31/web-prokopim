<?php

namespace App\Filament\Resources\PpidRequestResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PpidRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('kode_permohonan')
                    ->label(__('Kode Tracking'))
                    ->searchable()
                    ->copyable()
                    ->copyMessage(__('Kode disalin!'))
                    ->badge()
                    ->color('primary')
                    ->fontFamily('mono')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('nama_lengkap')
                    ->label(__('Nama Pemohon'))
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->no_telepon ?? ''),

                TextColumn::make('nik')
                    ->label(__('NIK'))
                    ->searchable()
                    ->fontFamily('mono')
                    ->copyable()
                    ->copyMessage(__('NIK disalin!'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('no_telepon')
                    ->label(__('Telepon'))
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('pekerjaan')
                    ->label(__('Pekerjaan'))
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('rincian_informasi')
                    ->label(__('Informasi Dimohon'))
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->rincian_informasi)
                    ->extraAttributes(['class' => 'text-left']),

                TextColumn::make('created_at')
                    ->label(__('Tanggal'))
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diajukan'  => 'info',
                        'diproses'  => 'warning',
                        'disetujui' => 'success',
                        'ditolak'   => 'danger',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'diajukan'  => __('Diajukan'),
                        'diproses'  => __('Diproses'),
                        'disetujui' => __('Disetujui'),
                        'ditolak'   => __('Ditolak'),
                        default     => $state,
                    }),

            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('Filter Status'))
                    ->options([
                        'diajukan'  => __('Baru Diajukan'),
                        'diproses'  => __('Sedang Diproses'),
                        'disetujui' => __('Disetujui'),
                        'ditolak'   => __('Ditolak'),
                    ]),
                SelectFilter::make('cara_mendapatkan')
                    ->label(__('Cara Mendapatkan'))
                    ->options([
                        'Melihat/Membaca/Mendengarkan/Mencatat' => 'Melihat/Membaca',
                        'Mendapatkan salinan informasi (Hardcopy/Softcopy)' => 'Salinan Info',
                    ]),
                SelectFilter::make('cara_memperoleh')
                    ->label(__('Cara Memperoleh'))
                    ->options([
                        'Mengambil Langsung' => 'Mengambil Langsung',
                        'Kurir/Pos' => 'Kurir/Pos',
                        'Faksimili' => 'Faksimili',
                        'Email' => 'Email',
                    ]),
            ])
            ->actions([
                ViewAction::make()
                    ->label(false)
                    ->icon('heroicon-s-eye')
                    ->tooltip(__('Detail'))
                    ->extraAttributes(['class' => 'btn-ta-custom btn-view-custom']),
                DeleteAction::make()
                    ->label(false)
                    ->icon('heroicon-s-trash')
                    ->tooltip(__('Hapus'))
                    ->color('danger')
                    ->extraAttributes(['class' => 'btn-ta-custom btn-delete-custom']),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label(__('Hapus Terpilih')),
                ])->label(__('Aksi Masal')),
            ])
            ->actionsColumnLabel(__('AKSI'))
            ->emptyStateHeading(__('Belum ada permohonan'))
            ->emptyStateDescription(__('Permohonan informasi dari masyarakat akan tampil di sini.'))
            ->emptyStateIcon('heroicon-o-document-text');
    }
}
