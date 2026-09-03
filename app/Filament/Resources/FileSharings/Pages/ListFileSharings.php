<?php

namespace App\Filament\Resources\FileSharings\Pages;

use App\Filament\Resources\FileSharings\FileSharingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\Url;

use League\CommonMark\Node\Block\Document;
use Livewire\Attributes\On;

class ListFileSharings extends ListRecords
{
    protected function getBodyAttributes(): array
    {
        return [
            'class' => ($this->viewMode === 'list' ? 'list-mode-active' : 'file-manager-grid-view') . ' fi-file-manager',
        ];
    }

    protected static string $resource = FileSharingResource::class;

    protected string $view = 'filament.resources.file-sharings.pages.list-file-sharings';

    #[Url]
    public string $viewMode = 'grid';

    #[Url(as: 'folder_id')]
    public ?string $folderId = null;

    #[Url]
    public ?string $activeTab = null;

    public function getExtraBodyAttributes(): array
    {
        return [
            'class' => ($this->viewMode === 'list' ? 'list-mode-active' : 'file-manager-grid-view') . ' fi-file-manager',
        ];
    }

    public function getFooterWidgetsColumns(): int|array
    {
        return 1;
    }

    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'customCss' => $this->getCustomCss(),
        ]);
    }

    protected function getCustomCss(): string
    {
        return <<<'CSS'
        <style>
            /* BASE LAYOUT */
            .fi-ta-content { background-color: #f8fafc !important; }
            .dark .fi-ta-content { background-color: #020617 !important; }
            .fi-header-heading { font-weight: 800 !important; }
            
            /* SIMPLIFIED FILTERS */
            .fi-ta-filters {
                background: white !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 12px !important;
                padding: 1rem !important;
                margin-bottom: 1.5rem !important;
                box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
            }
            .dark .fi-ta-filters {
                background: #1e293b !important;
                border-color: #334155 !important;
                color: white !important;
            }
            .fi-ta-filters-header { display: none !important; }
            
            /* Force input text to be readable in dark mode filters */
            .dark .fi-ta-filters input,
            .dark .fi-ta-filters select,
            .dark .fi-ta-filters button {
                color: white !important;
                background-color: rgba(255, 255, 255, 0.03) !important;
                border-color: rgba(255, 255, 255, 0.1) !important;
            }
            .dark .fi-ta-filters input::placeholder {
                color: #94a3b8 !important;
            }
            .dark .fi-ta-header-toolbar input {
                background-color: #1e293b !important;
                color: white !important;
                border-color: #334155 !important;
            }
            .dark .fi-ta-header-toolbar input::placeholder {
                color: #94a3b8 !important;
            }
            
            /* ACTION BUTTONS STYLE */
            .fi-ac-btn-action { border-radius: 8px !important; font-weight: 600 !important; }
            
            /* PREMIUM GRID CONTAINER */
            .fi-ta-content-grid-wrp {
                padding: 1.5rem !important;
                background-color: #f8fafc !important;
                min-height: 400px;
            }
            .dark .fi-ta-content-grid-wrp {
                background-color: #020617 !important;
            }

            /* HIDE REDUNDANT ACTIONS IN GRID MODE */
            .file-manager-grid-view .fi-ta-record-actions,
            .file-manager-grid-view .fi-ta-actions:not([style*="position: absolute"]) {
                display: none !important;
            }

            /* MAKE SURE LIST VIEW IS STANDARD & FULL WIDTH */
            .list-mode-active .fi-ta-ctn,
            .list-mode-active .fi-ta-content,
            .list-mode-active .fi-main-ctn {
                width: 100% !important;
                max-width: 100% !important;
            }
            .list-mode-active .fi-ta-content-grid-wrp {
                background: transparent !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }
            .list-mode-active .fi-ta-table {
                width: 100% !important;
                table-layout: auto !important; /* Allow columns to flex naturally */
            }
            
            /* Remove ALL side padding for true edge-to-edge feel */
            .fi-file-manager.list-mode-active .fi-main,
            .fi-file-manager.list-mode-active .fi-main-ctn,
            .fi-file-manager.list-mode-active .fi-page,
            .fi-file-manager.list-mode-active .fi-ta-ctn,
            .fi-file-manager.list-mode-active .fi-ta-content {
                padding-left: 0 !important;
                padding-right: 0 !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }

            .fi-file-manager.list-mode-active .fi-ta-header,
            .fi-file-manager.list-mode-active .fi-page-header,
            .fi-file-manager.list-mode-active .fi-ta-header-toolbar {
                padding-left: 2rem !important;
                padding-right: 2rem !important;
            }

            /* Ensure table is fixed for consistent column spacing and full width */
            .list-mode-active .fi-ta-table {
                width: 100% !important;
                table-layout: fixed !important;
                border-spacing: 0 !important;
                border-collapse: collapse !important;
            }

            /* Ensure consistent header background and remove gaps */
            .list-mode-active thead {
                background-color: #4b5563 !important;
            }
            .list-mode-active .fi-ta-header-cell {
                background-color: #4b5563 !important;
                border: none !important;
            }
            .dark .list-mode-active thead,
            .dark .list-mode-active .fi-ta-header-cell {
                background-color: #1e293b !important;
            }

            /* Allow first column to be wider */
            .list-mode-active th.column-nama-menu {
                width: 40% !important;
            }

            /* Folder name text color in dark mode */
            .dark .text-gray-950 {
                color: white !important;
            }

            /* HIDE HORIZONTAL SCROLLBAR AND FIX OVERFLOW */
            .fi-ta-ctn,
            .fi-ta-content,
            .fi-ta-content-grid-wrp {
                overflow-x: hidden !important;
                overflow-y: visible !important;
            }

            /* Ensure table wrapper doesn't overflow */
            .fi-ta-table-wrp {
                overflow-x: hidden !important;
                width: 100% !important;
            }

            /* Force table to fit container */
            .list-mode-active .fi-ta-table {
                width: 100% !important;
                max-width: 100% !important;
                table-layout: fixed !important;
            }

            /* Distribute column widths properly */
            .list-mode-active th,
            .list-mode-active td {
                overflow: hidden !important;
                text-overflow: ellipsis !important;
                white-space: nowrap !important;
            }

            /* Specific column widths for better distribution */
            .list-mode-active th:nth-child(1),
            .list-mode-active td:nth-child(1) {
                width: 35% !important;
            }

            .list-mode-active th:nth-child(2),
            .list-mode-active td:nth-child(2) {
                width: 25% !important;
            }

            .list-mode-active th:nth-child(3),
            .list-mode-active td:nth-child(3) {
                width: 15% !important;
            }

            .list-mode-active th:nth-child(4),
            .list-mode-active td:nth-child(4) {
                width: 20% !important;
            }

            .list-mode-active th:nth-child(5),
            .list-mode-active td:nth-child(5) {
                width: 5% !important;
            }
        </style>
CSS;
    }

    public function getHeading(): string
    {
        if ($this->folderId) {
            $folder = \App\Models\FileSharing::find($this->folderId);

            return $folder ? $folder->title : 'File';
        }

        return __('Penyimpanan File');
    }

    public function getSubheading(): ?string
    {
        return null;
    }

    public function getTabs(): array
    {
        return [
            'all' => \Filament\Schemas\Components\Tabs\Tab::make(__('Penyimpanan Saya'))
                ->icon('heroicon-o-home')
                ->modifyQueryUsing(fn ($query) => $query->whereNull('deleted_at')),

            'recent' => \Filament\Schemas\Components\Tabs\Tab::make(__('Baru Saja'))
                ->icon('heroicon-o-clock')
                ->modifyQueryUsing(fn ($query) => $query->whereNull('deleted_at')->latest('updated_at')),

            'favorites' => \Filament\Schemas\Components\Tabs\Tab::make(__('Berbintang'))
                ->icon('heroicon-o-star')
                ->modifyQueryUsing(fn ($query) => $query->whereNull('deleted_at')->where('is_favorite', true)),

            'trash' => \Filament\Schemas\Components\Tabs\Tab::make(__('Sampah'))
                ->icon('heroicon-o-trash')
                ->modifyQueryUsing(fn ($query) => $query->onlyTrashed()),
        ];
    }

    public function getBreadcrumbs(): array
    {
        // Breadcrumbs only make sense in the main "My Drive" view
        if ($this->activeTab && $this->activeTab !== 'all') {
            return [];
        }

        $breadcrumbs = [
            FileSharingResource::getUrl('index') => __('Penyimpanan Saya'),
        ];

        if ($this->folderId) {
            $folder = \App\Models\FileSharing::find($this->folderId);
            $parents = [];

            $current = $folder;
            while ($current) {
                array_unshift($parents, $current);
                $current = $current->parent;
            }

            foreach ($parents as $parent) {
                $breadcrumbs[FileSharingResource::getUrl('index', ['folder_id' => $parent->id])] = $parent->title;
            }
        }

        return $breadcrumbs;
    }

    protected function getHeaderActions(): array
    {
        return [
            // View Mode Toggle
            \Filament\Actions\Action::make('gridView')
                ->label(__('Kotak'))
                ->icon('heroicon-o-squares-2x2')
                ->color($this->viewMode === 'grid' ? 'primary' : 'gray')
                ->tooltip(__('Tampilan Kotak'))
                ->button()
                ->url(fn () => FileSharingResource::getUrl('index', [
                    'folder_id' => $this->folderId,
                    'activeTab' => $this->activeTab,
                    'viewMode' => 'grid',
                ])),

            \Filament\Actions\Action::make('listView')
                ->label(__('Daftar'))
                ->icon('heroicon-o-list-bullet')
                ->color($this->viewMode === 'list' ? 'primary' : 'gray')
                ->tooltip(__('Tampilan Daftar'))
                ->button()
                ->url(fn () => FileSharingResource::getUrl('index', [
                    'folder_id' => $this->folderId,
                    'activeTab' => $this->activeTab,
                    'viewMode' => 'list',
                ])),

            CreateAction::make('folder')
                ->label(__(' +Folder'))
                ->icon(null)
                ->color('warning')
                ->button()
                ->modalHeading(__('Buat Folder Baru'))
                ->modalDescription(__('Buat folder baru untuk mengorganisir file Anda'))
                ->modalSubmitActionLabel(__('Buat Folder'))
                ->modalWidth('md')
                ->form([
                    \Filament\Forms\Components\TextInput::make('title')
                        ->label(__('Nama Folder'))
                        ->required()
                        ->maxLength(255)
                        ->placeholder(__('Masukkan nama folder...'))
                        ->autofocus(),
                    \Filament\Forms\Components\Textarea::make('description')
                        ->label(__('Keterangan (Opsional)'))
                        ->rows(2)
                        ->placeholder(__('Tambahkan keterangan folder...')),
                ])
                ->using(function (array $data): \App\Models\FileSharing {
                    // Manually create the folder with proper parent_id
                    return \App\Models\FileSharing::create([
                        'title' => $data['title'],
                        'description' => $data['description'] ?? null,
                        'parent_id' => $this->folderId,
                        'is_folder' => true,
                        'user_id' => auth()->id(),
                        'status' => 1,
                    ]);
                })
                ->successNotificationTitle(__('Folder berhasil dibuat!'))
                ->modal(),

            CreateAction::make('file')
                ->label(__('Unggah File'))
                ->icon('heroicon-o-document-plus')
                ->color('primary')
                ->button()
                ->modalHeading(__('Upload File Baru'))
                ->modalDescription(__('Upload file ke folder saat ini'))
                ->modalSubmitActionLabel(__('Upload'))
                ->modalWidth('lg')
                ->form([
                    \Filament\Forms\Components\TextInput::make('title')
                        ->label(__('Nama File'))
                        ->placeholder(__('Masukkan nama file...')),
                    \Filament\Forms\Components\FileUpload::make('file_path')
                        ->label(__('Pilih File'))
                        ->required()
                        ->disk('public')
                        ->directory('shared-files')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->live()
                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                            if ($state) {
                                try {
                                    $name = $state->getClientOriginalName();

                                    // Only auto-fill if title is empty
                                    if (empty($get('title'))) {
                                        $set('title', pathinfo($name, PATHINFO_FILENAME));
                                    }

                                    $set('type', strtoupper(pathinfo($name, PATHINFO_EXTENSION)));

                                    $size = $state->getSize();
                                    $set('size', $size);
                                } catch (\Throwable $e) {
                                    // ignore
                                }
                            }
                        })
                        ->helperText(__('Upload file yang ingin disimpan')),
                    \Filament\Forms\Components\Textarea::make('description')
                        ->label(__('Keterangan (Opsional)'))
                        ->rows(2)
                        ->placeholder(__('Tambahkan keterangan file...')),
                    \Filament\Forms\Components\Hidden::make('type'),
                    \Filament\Forms\Components\Hidden::make('size'),
                ])
                ->using(function (array $data): \App\Models\FileSharing {
                    // Use uploaded filename if title is empty
                    $title = $data['title'];
                    if (empty($title) && ! empty($data['file_path'])) {
                        $title = pathinfo($data['file_path'], PATHINFO_FILENAME);
                    }

                    // Manually create the file record with proper parent_id
                    return \App\Models\FileSharing::create([
                        'title' => $title,
                        'description' => $data['description'] ?? null,
                        'file_path' => $data['file_path'],
                        'type' => $data['type'] ?? null,
                        'size' => $data['size'] ?? null,
                        'parent_id' => $this->folderId,
                        'is_folder' => false,
                        'user_id' => auth()->id(),
                        'status' => 1,
                    ]);
                })
                ->successNotificationTitle(__('File berhasil diupload!'))
                ->modal(),
        ];
    }
}
