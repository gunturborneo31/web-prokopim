<x-filament-panels::page>
    <style>
        /* Override Filament page layout */
        .fi-main { max-width: 100% !important; }
        .fi-page { max-width: 100% !important; }
        .fi-page-content-wrapper { max-width: 100% !important; }
        .fi-page-content {
            max-width: 100% !important;
            padding-left: 0.25rem !important;
            padding-right: 0.25rem !important;
        }

        /* == Layout Utama == */
        .agenda-layout-container {
            display: block !important;
            width: 100% !important;
            position: relative;
        }

        /* Adjust Table Appearance */
        .fi-ta-ctn {
            background: white !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
            overflow: hidden !important;
        }
        .dark .fi-ta-ctn {
            background: #1e293b !important;
            border-color: #334155 !important;
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

        .agenda-modal-body {
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

        .datetime-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* Button Custom Styles */
        .btn-custom {
            margin: 0 !important;
            border: none;
            border-radius: 4px;
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

        .btn-simpan { background-color: #1976d2; color: white; }
        .btn-simpan:hover { background-color: #1565c0; transform: translateY(-1px); }

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
            padding: 0.5rem !important;
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
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 8px 12px 8px 40px !important;
            font-size: 0.875rem !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
        }
        .dark .fi-ta-search-field input {
            background: #0f172a !important;
            border-color: #334155 !important;
            color: white !important;
        }

        .fi-ta-content, .fi-ta-table {
            margin-top: 0 !important;
        }
    </style>

    <div class="agenda-layout-container">
        


        {{-- Main Table Area --}}
        <div class="filament-table-override">
             {{ $this->table }}
        </div>

        {{-- == MODAL FORM AGENDA == --}}
        <x-filament::modal id="agenda-form-modal" width="xl" :display-classes="false">
            <div class="custom-modal-card">
                <div class="modal-header-custom">
                    <x-filament::icon icon="heroicon-s-calendar" class="h-5 w-5 text-white"/>
                    <span class="modal-title-text">
                        {{ $this->editingAgendaId ? __('Ubah Data Agenda') : __('Tambah Agenda Baru') }}
                    </span>
                </div>

                <div class="agenda-modal-body">
                    <form wire:submit="save">
                        
                        <div class="form-group datetime-grid">
                            <div>
                                <label class="form-label">{{ __('Tanggal Kegiatan') }}</label>
                                {{ $this->form->getComponent('temp_date') }}
                            </div>
                            <div>
                                <label class="form-label">{{ __('Pukul') }}</label>
                                {{ $this->form->getComponent('temp_time') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Judul Kegiatan') }}</label>
                            {{ $this->form->getComponent('caption') }}
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Deskripsi') }}</label>
                            {{ $this->form->getComponent('description') }}
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Lokasi') }}</label>
                            {{ $this->form->getComponent('location') }}
                        </div>

                        <div class="flex justify-end items-center gap-3 mt-8" style="min-height: 42px;">
                            <button type="button" x-on:click="close" class="btn-custom btn-kembali">
                                <span>{{ __('Tutup') }}</span>
                            </button>

                            <button type="submit" class="btn-custom btn-simpan">
                                <x-filament::icon icon="heroicon-s-document-check" class="h-5 w-5 flex-shrink-0"/>
                                <span>{{ $this->editingAgendaId ? __('Simpan Perubahan') : __('Simpan Agenda') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </x-filament::modal>
        
    </div>
</x-filament-panels::page>