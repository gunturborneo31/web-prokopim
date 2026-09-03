<?php

namespace App\Filament\Resources\FileSharings\Schemas;

use App\Models\FileSharing;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class FileSharingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                    ->schema([
                        ToggleButtons::make('is_folder')
                            ->label(__('Tipe Item'))
                            ->options([
                                false => __('File'),
                                true => __('Folder'),
                            ])
                            ->icons([
                                false => 'heroicon-o-document',
                                true => 'heroicon-o-folder',
                            ])
                            ->colors([
                                false => 'info',
                                true => 'warning',
                            ])
                            ->default(false)
                            ->inline()
                            ->live()
                            ->required(),

                        TextInput::make('title')
                            ->label(fn ($get) => $get('is_folder') ? __('Nama Folder') : __('Nama File'))
                            ->required()
                            ->maxLength(255),

                        Select::make('parent_id')
                            ->label(__('Lokasi (Folder)'))
                            ->options(FileSharing::where('is_folder', true)->pluck('title', 'id'))
                            ->searchable()
                            ->placeholder(__('Root (Utama)'))
                            ->default(request()->input('tableFilters.parent_id.value')),

                        FileUpload::make('file_path')
                            ->label(__('Upload File'))
                            ->required(fn ($get) => ! $get('is_folder'))
                            ->hidden(fn ($get) => $get('is_folder'))
                            ->directory('shared-files')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $extension = pathinfo($state, PATHINFO_EXTENSION);
                                    $set('type', strtoupper($extension));

                                    try {
                                        $size = \Storage::disk('public')->size($state);
                                        $set('size', static::formatBytes($size));
                                    } catch (\Exception $e) {
                                        // Ignore
                                    }
                                }
                            }),

                        Textarea::make('description')
                            ->label(__('Keterangan'))
                            ->rows(3),

                        // === SHARING SECTION ===
                        \Filament\Forms\Components\Section::make(__('Pengaturan Berbagi'))
                            ->description(__('Atur siapa yang dapat mengakses file/folder ini'))
                            ->schema([
                                Select::make('access_level')
                                    ->label(__('Tingkat Akses'))
                                    ->options([
                                        'restricted' => __('Dibatasi - Hanya Anda'),
                                        'public' => __('Publik - Siapa saja dengan link'),
                                    ])
                                    ->default('restricted')
                                    ->required()
                                    ->live()
                                    ->helperText(fn ($get) => 
                                        $get('access_level') === 'public' 
                                            ? __('✓ Siapa saja yang memiliki link dapat mengakses file ini.')
                                            : __('🔒 Hanya orang dengan akses yang dapat membuka dengan link.')
                                    ),

                                TextInput::make('share_link')
                                    ->label(__('Link Berbagi'))
                                    ->disabled()
                                    ->visible(fn ($get) => $get('access_level') === 'public')
                                    ->default(fn ($record) => $record ? url('/dokumen/share/' . $record->share_token) : null)
                                    ->helperText(__('Link ini dapat dibagikan kepada siapa saja'))
                                    ->suffixAction(
                                        \Filament\Forms\Components\Actions\Action::make('copy_link')
                                            ->icon('heroicon-o-clipboard-document')
                                            ->action(function ($record) {
                                                // JavaScript will handle the copy
                                            })
                                            ->extraAttributes([
                                                'x-on:click' => 'navigator.clipboard.writeText($el.closest(\'.fi-fo-text-input\').querySelector(\'input\').value); $tooltip(\'Link disalin!\', { timeout: 2000 })'
                                            ])
                                    ),
                            ])
                            ->collapsible()
                            ->collapsed(false),

                        Select::make('status')
                            ->options([
                                1 => __('Aktif'),
                                0 => __('Non-Aktif'),
                            ])
                            ->default(1)
                            ->required(),

                        \Filament\Forms\Components\Hidden::make('type'),
                        \Filament\Forms\Components\Hidden::make('size'),
                        \Filament\Forms\Components\Hidden::make('download_count')
                            ->default(0),
                        \Filament\Forms\Components\Hidden::make('share_token')
                            ->default(fn () => \Illuminate\Support\Str::random(32)),
                    ]),
            ]);
    }

    public static function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision).' '.$units[$pow];
    }
}
