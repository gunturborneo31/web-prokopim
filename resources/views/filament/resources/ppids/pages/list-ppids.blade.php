<x-filament-panels::page>
    <style>
        /* Override Filament page layout */
        /* DASHBOARD-LIKE DYNAMIC LAYOUT */
        .fi-main { padding: 1.5rem !important; }
        
        .layout-container {
            background: #f1f5f9;
            min-height: 80vh;
            border-radius: 1.5rem;
            padding: 1.5rem;
            width: 100% !important;
            max-width: 100% !important;
            margin: 0;
            transition: all 0.3s ease;
        }
        .dark .layout-container {
            background: #020617;
        }
        
        /* Force Table to be truly Dynamic */
        .filament-table-override {
            width: 100% !important;
            overflow: hidden;
        }

        .fi-ta-ctn {
            background: white !important;
            width: 100% !important;
            max-width: 100% !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 1.25rem !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02) !important;
            overflow-x: auto !important; /* Enable horizontal scroll if content is too wide */
        }
        .dark .fi-ta-ctn {
            background: #0f172a !important;
            border-color: #1e293b !important;
        }

        .fi-ta-content, .fi-ta-table {
            width: 100% !important;
            min-width: 0 !important;
            table-layout: auto !important; /* Let column content influence width */
        }

        .fi-ta-header-cell, .fi-ta-cell {
            white-space: nowrap !important; /* Start with no wrap for predictability */
        }
        
        /* Only allow wrapping for the description column specifically */
        .fi-ta-cell:nth-child(2) {
            white-space: normal !important;
            word-break: break-word !important;
        }

        /* == Modal Form Styling == */
        .custom-modal-card {
            background: transparent;
            border: none;
            padding: 0;
        }

        .modal-header-custom {
            background-color: #4b5563;
            color: white;
            padding: 1rem 1.5rem;
            margin: -1.5rem -1.5rem 1.5rem -1.5rem;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .modal-title-text {
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
        }

        /* == Modal Form Styling == */
        .custom-modal-card {
            background: transparent;
            border: none;
            padding: 0;
        }

        .modal-header-custom {
            background-color: #4b5563;
            color: white;
            padding: 1rem 1.5rem;
            margin: -1.5rem -1.5rem 1.5rem -1.5rem;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .modal-title-text {
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .modal-body-custom {
            padding: 0;
        }

        /* == Form Elements == */
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }
        .dark .form-label { color: #cbd5e1; }

        /* Button Custom Styles */
        .btn-custom {
            margin: 0 !important;
            border: none;
            border-radius: 0.75rem; /* Match Dashboard buttons */
            padding: 0 1.5rem !important;
            height: 42px !important;
            min-height: 42px !important;
            max-height: 42px !important;
            font-weight: 700;
            font-size: 0.85rem;
            line-height: 1 !important;
            cursor: pointer;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.6rem;
            transition: all 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            text-decoration: none !important;
            text-transform: uppercase;
            box-sizing: border-box !important;
            vertical-align: middle !important;
        }

        .btn-simpan { background-color: #2563eb; color: white; }
        .btn-simpan:hover { background-color: #1d4ed8; transform: translateY(-1px); }

        .btn-kembali { background-color: #ef4444; color: white; }
        .btn-kembali:hover { background-color: #dc2626; transform: translateY(-1px); }

        /* == Table Header Styling == */
        .fi-ta-header-cell {
            background-color: #4b5563 !important;
            color: white !important;
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            text-transform: uppercase;
        }

        /* == Aggressive Gap Removal == */
        .fi-ta-header {
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
            min-height: 0 !important;
            border: none !important;
        }

        .fi-ta-header-toolbar {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            padding: 0.75rem 1.25rem !important;
            margin: 0 !important;
            min-height: 0 !important;
            height: auto !important;
            background: transparent !important;
            border: none !important;
        }
        
        .fi-ta-header-toolbar > div {
            display: contents !important;
        }

        .fi-ta-header > *:not(.fi-ta-header-toolbar),
        .fi-ta-header-grid, 
        .fi-ta-header-actions-ctn,
        .fi-ta-header-toolbar > div > *:not(.fi-ta-search-field) {
            display: none !important;
        }

        .fi-ta-search-field {
            max-width: 320px !important;
            width: 100% !important;
            margin: 0 !important;
        }

        .fi-ta-search-field input {
            background: white !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            padding: 8px 12px 8px 40px !important;
            font-size: 0.875rem !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
        }
        .dark .fi-ta-search-field input {
            background: #1e293b !important;
            border-color: #334155 !important;
            color: white !important;
        }

        .fi-ta-content, .fi-ta-table {
            margin-top: 0 !important;
        }

        /* == Table Cell Centering == */
        .fi-ta-header-cell:not(.column-nama-menu), 
        .fi-ta-cell:not(.column-nama-menu) {
            text-align: center !important;
        }
        
        /* Column specific padding */
        .column-nama-menu {
            padding-left: 1.5rem !important;
        }
    </style>

    <div class="layout-container">
        
        {{-- Main Table Area --}}
        <div class="filament-table-override">
             {{ $this->table }}
        </div>

        {{-- == MODAL FORM PPID == --}}
        <x-filament::modal id="ppid-form-modal" width="xl" :display-classes="false">
            <div class="custom-modal-card">
                <div class="modal-header-custom">
                    <x-filament::icon icon="heroicon-s-pencil-square" class="h-5 w-5 text-white"/>
                    <span class="modal-title-text">
                        {{ $this->editingPpidId ? __('Ubah Data Kategori') : __('Buat Kategori Baru') }}
                    </span>
                </div>

                <div class="modal-body-custom">
                    <form wire:submit="save">
                        
                        <div class="space-y-4">
                            {{ $this->form }}
                        </div>

                        <div class="flex justify-end items-center gap-3 mt-8" style="min-height: 42px;">
                            <button type="button" x-on:click="close" class="btn-custom btn-kembali">
                                <span>{{ __('Tutup') }}</span>
                            </button>

                            <button type="submit" class="btn-custom btn-simpan">
                                <x-filament::icon icon="heroicon-s-document-check" class="h-5 w-5 flex-shrink-0"/>
                                <span>{{ $this->editingPpidId ? __('Simpan Perubahan') : __('Simpan Kategori') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </x-filament::modal>
        
    </div>
</x-filament-panels::page>