<?php

namespace App\Filament\Resources\DynamicPages\Schemas\Templates;

use App\Models\Ppid;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;

class Dokumen implements TemplateSchema
{
    public static function schema(): array
    {
        return [
            Select::make('content.mode')
                ->label('Sumber Dokumen')
                ->options([
                    'manual' => 'Isi Manual (Input satu per satu)',
                    'automatic' => 'Otomatis (Ambil dari PPID)',
                ])
                ->default('manual')
                ->live(),

            Group::make([
                Select::make('content.ppid_id')
                    ->label('Kategori Dokumen / Peraturan')
                    ->placeholder('Pilih kategori...')
                    ->options(function () {
                        // Ambil seluruh akar utama PPID, kecualikan kategori sistem
                        $roots = Ppid::whereNull('parent_id')
                            ->whereNotIn('name', ['Tentang PPID', 'Permohonan Informasi', 'Profil PPID'])
                            ->with('children')->get();
                        
                        $options = [];
                        foreach ($roots as $root) {
                            $children = $root->children->pluck('name', 'id')->toArray();
                            
                            if (!empty($children)) {
                                $groupOptions = [];
                                foreach ($children as $id => $name) {
                                    $groupOptions[$id] = trim($name);
                                }
                                $options[trim($root->name)] = $groupOptions;
                            } else {
                                // Jika tidak punya sub-kategori, tampilkan langsung tanpa grup
                                $options[$root->id] = trim($root->name);
                            }
                        }
                        return $options;
                    })
                    ->searchable()
                    ->live()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Nama Kategori Baru')
                            ->required(),
                        Select::make('parent_id')
                            ->label('Induk Kategori')
                            ->placeholder('Jadikan Kategori Utama')
                            ->options(Ppid::whereNull('parent_id')
                                ->whereNotIn('name', ['Tentang PPID', 'Permohonan Informasi', 'Profil PPID'])
                                ->pluck('name', 'id')),
                    ])
                    ->createOptionUsing(function (array $data): int {
                        return Ppid::create($data)->id;
                    }),
                
                Placeholder::make('ppid_hint')
                    ->hiddenLabel()
                    ->content(function (Get $get) {
                        $ppidId = $get('content.ppid_id');
                        $ppidName = 'kategori ini';
                        $url = route('filament.admin.resources.ppids.index');

                        if ($ppidId) {
                            $ppid = Ppid::find($ppidId);
                            if ($ppid) {
                                $ppidName = '"' . $ppid->name . '"';
                                if ($ppid->parent_id !== null) {
                                    $url = \App\Filament\Resources\PpidItemResource::getUrl('index', ['ppid_id' => $ppid->id]);
                                } else {
                                    $url = \App\Filament\Resources\Ppids\Pages\ListPpids::getUrl(['parent_id' => $ppid->id]);
                                }
                            }
                        }

                        $linkText = $ppidId ? "Buka Pengaturan File {$ppidName}" : "Buka Menu PPID Utama";

                        return new HtmlString('
                            <style>
                                .ppid-sync-box {
                                    padding: 1.25rem; border-radius: 0.75rem; font-size: 0.875rem; line-height: 1.5;
                                    background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.2);
                                    color: var(--fi-color-gray-700, #374151); margin-top: 0.5rem;
                                }
                                .dark .ppid-sync-box {
                                    background: rgba(16, 185, 129, 0.02); border-color: rgba(16, 185, 129, 0.15);
                                    color: var(--fi-color-gray-300, #d1d5db);
                                }
                                .ppid-sync-header { display: flex; align-items: center; gap: 0.5rem; font-weight: 600; color: #059669; margin-bottom: 0.75rem; font-size: 0.95rem; }
                                .dark .ppid-sync-header { color: #10b981; }
                                .ppid-sync-warning {
                                    padding: 0.75rem; border-radius: 0.5rem; 
                                    background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2);
                                    margin-bottom: 0.75rem;
                                }
                                .dark .ppid-sync-warning { background: rgba(245, 158, 11, 0.05); border-color: rgba(245, 158, 11, 0.15); }
                                .ppid-sync-warning-title { display: flex; align-items: center; gap: 0.375rem; font-weight: 600; color: #d97706; margin-bottom: 0.25rem; }
                                .dark .ppid-sync-warning-title { color: #10192d; }
                                .ppid-sync-btn {
                                    display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.5rem 1rem;
                                    background: #059669; color: white !important; font-weight: 600; font-size: 0.75rem;
                                    border-radius: 0.5rem; text-decoration: none; text-transform: uppercase; letter-spacing: 0.05em;
                                    margin-top: 0.5rem; transition: all 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.1);
                                }
                                .ppid-sync-btn:hover { background: #047857; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
                                .dark .ppid-sync-btn { background: #059669; }
                                .dark .ppid-sync-btn:hover { background: #047857; }
                            </style>
                            <div class="ppid-sync-box">
                                <div class="ppid-sync-header">
                                    <svg style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Langkah Sinkronisasi:
                                </div>
                                <div class="ppid-sync-warning">
                                    <div class="ppid-sync-warning-title">
                                        <svg style="width:15px;height:15px" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                        PENTING:
                                    </div>
                                    <div style="font-size: 0.8125rem;">
                                        Klik tombol <b>' . ($get('../../id') ? 'Simpan' : 'Buat') . '</b> di bagian bawah halaman ini terlebih dahulu agar pilihan kategori tersimpan secara permanen.
                                    </div>
                                </div>
                                <div style="font-size: 0.85rem; margin-bottom: 0.75rem;">
                                    Setelah disimpan, Anda bisa klik tombol di bawah untuk mulai mengunggah file PDF ke folder yang tepat:
                                </div>
                                <a href="'. $url .'" target="_blank" class="ppid-sync-btn">
                                    <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    '. $linkText .'
                                </a>
                            </div>
                        ');
                    }),
            ])
            ->visible(fn(Get $get) => $get('content.mode') === 'automatic'),

            Repeater::make('content.documents')
                ->label('Daftar Dokumen (Manual)')
                ->visible(fn(Get $get) => $get('content.mode') === 'manual')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')->label('Nama Dokumen')->required(),
                        TextInput::make('date')->label('Tanggal / Tahun'),
                    ]),
                    Textarea::make('description')->label('Deskripsi Singkat')->rows(2),
                    FileUpload::make('file_url')
                        ->label('File PDF')
                        ->acceptedFileTypes(['application/pdf'])
                        ->directory('dokumen-dinamis'),
                ])
                ->itemLabel(fn(array $state): ?string => $state['name'] ?? null),
        ];
    }
}
