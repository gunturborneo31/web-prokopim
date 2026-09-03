<?php

namespace App\Filament\Resources\Pengaduans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PengaduansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('kode_laporan')
                    ->label(__('Kode Laporan'))
                    ->searchable()
                    ->copyable()
                    ->copyMessage(__('Kode disalin!'))
                    ->badge()
                    ->color('primary')
                    ->fontFamily('mono'),

                TextColumn::make('kategori')
                    ->label(__('Kategori'))
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                TextColumn::make('judul_laporan')
                    ->label(__('Judul Laporan'))
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->judul_laporan)
                    ->searchable()
                    ->extraAttributes(['class' => 'text-left long-text-column']),

                TextColumn::make('nama_lengkap')
                    ->label(__('Pelapor'))
                    ->formatStateUsing(fn ($record) => $record->is_anonymous ? '🔒 ' . __('Anonim') : $record->nama_lengkap)
                    ->searchable(),

                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baru'     => 'info',
                        'diproses' => 'warning',
                        'selesai'  => 'success',
                        'ditolak'  => 'danger',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'baru'     => __('Baru'),
                        'diproses' => __('Diproses'),
                        'selesai'  => __('Selesai'),
                        'ditolak'  => __('Ditolak'),
                        default    => $state,
                    }),

                TextColumn::make('tanggal_kejadian')
                    ->label(__('Tgl. Kejadian'))
                    ->date('d/m/Y')
                    // ->sortable()
                    ->placeholder('-'),

                TextColumn::make('created_at')
                    ->label(__('Dilaporkan'))
                    ->dateTime('d/m/Y H:i')
                    // ->sortable()
                    ->since(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('Filter Status'))
                    ->options([
                        'baru'     => __('Laporan Baru'),
                        'diproses' => __('Sedang Diproses'),
                        'selesai'  => __('Selesai'),
                        'ditolak'  => __('Ditolak'),
                    ]),

                SelectFilter::make('kategori')
                    ->label(__('Filter Kategori'))
                    ->options([
                        'Korupsi'                    => __('Korupsi'),
                        'Gratifikasi'                => __('Gratifikasi'),
                        'Penyalahgunaan Wewenang'    => __('Penyalahgunaan Wewenang'),
                        'Pelanggaran Disiplin'       => __('Pelanggaran Disiplin'),
                        'Pelayanan Publik'           => __('Pelayanan Publik'),
                        'Lainnya'                    => __('Lainnya'),
                    ]),
            ])
            ->actions([
                ViewAction::make()
                    ->label(false)
                    ->icon('heroicon-s-eye')
                    ->tooltip(__('Detail'))
                    ->extraAttributes(['class' => 'btn-ta-custom btn-view-custom']),
                \Filament\Actions\DeleteAction::make()
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
            ->emptyStateHeading(__('Belum ada laporan pengaduan'))
            ->emptyStateDescription(__('Laporan dari masyarakat akan tampil di sini.'))
            ->emptyStateIcon('heroicon-o-megaphone');
    }
}
