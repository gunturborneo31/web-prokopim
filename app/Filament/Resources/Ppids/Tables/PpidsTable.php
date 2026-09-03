<?php

namespace App\Filament\Resources\Ppids\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PpidsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(fn (\Livewire\Component $livewire) => $livewire->parentPpid?->parent_id !== null ? __('NAMA') : __('NAMA KATEGORI'))
                    ->searchable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->description(function (\App\Models\Ppid $record, \Livewire\Component $livewire): ?string {
                        // Hanya tampilkan deskripsi di level sub kategori
                        if (isset($livewire->parent_id) && $livewire->parentPpid?->parent_id === null) {
                            $itemCount = $record->items()->count();
                            return $itemCount > 0 ? $itemCount . ' file tersedia' : 'Belum ada file';
                        }
                        return null;
                    })
                    ->extraCellAttributes(['class' => 'ppid-name-col', 'style' => 'text-align: left !important;'])
                    ->extraHeaderAttributes(['class' => 'ppid-name-col', 'style' => 'text-align: left !important;'])
                    ->extraAttributes(['style' => 'justify-content: flex-start !important;'])
                    ->wrap()
                    ->grow(true),

                TextColumn::make('children_count')
                    ->label(__('SUB KATEGORI'))
                    ->counts('children')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'primary' : 'gray')
                    ->formatStateUsing(fn ($state) => $state . ' sub kategori')
                    ->alignCenter()
                    ->visible(fn (\Livewire\Component $livewire) => !isset($livewire->parent_id)),

                TextColumn::make('file')
                    ->label(__('FILE'))
                    ->placeholder('-')
                    ->visible(fn (\Livewire\Component $livewire) => $livewire->parentPpid?->parent_id !== null),

                TextColumn::make('tanggal_pembuatan')
                    ->label(__('TANGGAL & TEMPAT PEMBUATAN'))
                    ->formatStateUsing(fn ($record) => ($record->tanggal_pembuatan ? \Carbon\Carbon::parse($record->tanggal_pembuatan)->translatedFormat('d F Y') : '-') . ' ' . ($record->tempat_pembuatan ? '/ ' . $record->tempat_pembuatan : ''))
                    ->visible(fn (\Livewire\Component $livewire) => $livewire->parentPpid?->parent_id !== null),

                TextColumn::make('format_informasi')
                    ->label(__('FORMAT'))
                    ->placeholder('-')
                    ->visible(fn (\Livewire\Component $livewire) => $livewire->parentPpid?->parent_id !== null),

                TextColumn::make('penanggung_jawab')
                    ->label(__('PENANGGUNG JAWAB'))
                    ->placeholder('-')
                    ->visible(fn (\Livewire\Component $livewire) => $livewire->parentPpid?->parent_id !== null),

                TextColumn::make('jangka_waktu_penyimpanan')
                    ->label(__('JANGKA WAKTU PENYIMPANAN'))
                    ->placeholder('-')
                    ->badge()
                    ->color('info')
                    ->visible(fn (\Livewire\Component $livewire) => $livewire->parentPpid?->parent_id !== null),
            ])
            ->actions([
                \Filament\Actions\Action::make('subppid')
                    ->label(false)
                    ->icon('heroicon-s-list-bullet')
                    ->color('info')
                    ->tooltip(function (\App\Models\Ppid $record) {
                        if ($record->name === 'Permohonan Informasi') return __('Lihat Permohonan');
                        return $record->parent_id !== null ? __('Lihat File') : __('Lihat Sub Kategori');
                    })
                    ->extraAttributes(['class' => 'btn-ta-custom btn-submenu-custom'])
                    ->url(function (\App\Models\Ppid $record) {
                        if ($record->name === 'Permohonan Informasi') {
                            return \App\Filament\Resources\PpidRequestResource::getUrl('index');
                        }
                        if ($record->name === 'Tentang PPID') {
                            return \App\Filament\Resources\PpidAboutResource::getUrl('index');
                        }
                        if ($record->parent_id !== null) {
                            return \App\Filament\Resources\PpidItemResource::getUrl('index', ['ppid_id' => $record->id]);
                        }
                        return \App\Filament\Resources\Ppids\Pages\ListPpids::getUrl(['parent_id' => $record->id]);
                    }),

                \Filament\Actions\Action::make('upload')
                    ->label(false)
                    ->icon('heroicon-s-arrow-up-tray')
                    ->color('success')
                    ->tooltip(__('Upload File'))
                    ->extraAttributes(['class' => 'btn-ta-custom'])
                    ->url(fn (\App\Models\Ppid $record) => \App\Filament\Resources\PpidItemResource::getUrl('create', ['ppid_id' => $record->id]))
                    ->visible(fn (\App\Models\Ppid $record) => $record->parent_id !== null && !in_array($record->name, ['Permohonan Informasi', 'Tentang PPID'])),

                \Filament\Actions\EditAction::make()
                    ->label(false)
                    ->icon('heroicon-s-pencil-square')
                    ->color('warning')
                    ->extraAttributes(['class' => 'btn-ta-custom btn-edit-custom'])
                    ->form(fn (\Filament\Schemas\Schema $schema) => \App\Filament\Resources\Ppids\Schemas\PpidForm::configure($schema))
                    ->modalWidth('2xl')
                    ->modalHeading(__('EDIT KATEGORI INFO PUBLIK'))
                    ->successNotificationTitle(__('Data berhasil diperbarui')),

                \Filament\Actions\DeleteAction::make()
                    ->label(false)
                    ->icon('heroicon-s-trash')
                    ->color('danger')
                    ->extraAttributes(['class' => 'btn-ta-custom btn-delete-custom'])
                    ->successNotificationTitle(__('Kategori berhasil dihapus')),
            ])
            ->recordUrl(null)
            ->actionsColumnLabel(__('AKSI'))
            ->actionsAlignment('center')
            ->searchPlaceholder(__('Cari info publik...'))
            ->emptyStateHeading(__('Belum ada data'))
            ->emptyStateDescription(__('Silakan tambahkan data baru menggunakan tombol Tambah Kategori.'));
    }
}