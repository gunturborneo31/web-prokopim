<x-filament-panels::page>
    <style>
        /* Override Filament page layout */
        .fi-main { max-width: 100% !important; }
        .fi-page { max-width: 100% !important; }
        .fi-page-content-wrapper { max-width: 100% !important; }
        .fi-page-content {
            max-width: 100% !important;
            padding-left: 0.25rem !important; /* Minimal gap with sidebar */
            padding-right: 0.25rem !important;
        }

        /* == Layout Utama == */
        .layout-container {
            display: block !important;
            width: 100% !important;
            position: relative; /* Base for absolute positioning */
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

        @media (max-width: 640px) {
            .table-custom-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .btn-add-wrapper {
                max-width: 100%;
                justify-content: flex-start;
            }
        }

        .table-wrapper {
            min-width: 0;
            overflow-x: auto;
        }
        
        /* == Styling Card Form (Inside Modal) == */
        .custom-card {
            background: transparent;
            border: none;
            padding: 0;
        }
        .dark .custom-card { background: transparent; }

        /* Custom Modal Title Styling */
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

        /* Header Form */
        .card-header {
            background-color: #4b5563 !important; 
            color: white !important;
            padding: 16px 20px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 12px !important;
            border-radius: 4px 4px 0 0;
        }
        .card-header * {
            background-color: transparent !important;
        }
        .card-title {
            color: white !important;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.025em;
            text-transform: uppercase;
        }

        .card-body {
            padding: 2rem;
        }

        /* == Form Elements == */
        .form-group { margin-bottom: 1.5rem; }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.6rem;
        }
        .dark .form-label {
            color: #cbd5e1;
        }

        /* Row Posisi, Urutan, Aktif */
        .triple-row {
            display: grid;
            grid-template-columns: 1.5fr 80px 60px;
            gap: 1rem;
            align-items: start;
        }

        /* Input Wrapper & Styling */
        .fi-input-wrp {
            border-radius: 2px !important;
            border-color: #cbd5e1 !important;
        }

        /* == CUSTOM ICON TRIGGER (BLUE BOX) == */
        .icon-name-wrapper {
            display: flex;
            align-items: stretch;
            height: 44px; /* Ensure fixed height matching standard inputs */
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            overflow: hidden;
            background: white;
        }
        .dark .icon-name-wrapper {
            background-color: #0f172a !important;
            border-color: #334155 !important;
        }
        .icon-trigger-box {
            width: 54px;
            flex-shrink: 0;
            background-color: #2b78af;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
            border-right: 1px solid rgba(0,0,0,0.1); /* Subtle internal divider */
        }
        .icon-trigger-box:hover {
            background-color: #1e5a85;
        }
        .dark .icon-trigger-box {
            border-right-color: rgba(255,255,255,0.1) !important;
        }
        .icon-trigger-box svg {
            color: white !important;
            width: 20px;
            height: 20px;
        }

        /* Name field next to icon */
        .name-field-box {
            flex-grow: 1;
        }
        .name-field-box .fi-input-wrp {
            border: none !important; /* Remove internal border */
            border-radius: 0 !important;
            height: 100% !important;
            box-shadow: none !important;
            margin: 0 !important; /* Ensure no displacement */
        }
        .name-field-box .fi-fo-field-wrp {
            margin: 0 !important;
        }
        .name-field-box input {
            height: 100% !important;
            border: none !important;
            box-shadow: none !important;
            padding-left: 1rem !important;
            background-color: transparent !important;
        }
        .dark .name-field-box input {
            color: white !important;
        }

        /* Suffix styling for Link */
        .fi-input-wrp:has(.fi-input-suffix) {
            border-radius: 4px !important;
        }
        .fi-input-wrp:has(.fi-input-suffix) .fi-input-suffix {
            background-color: #2b78af !important;
            padding: 0 12px !important;
            margin-left: 0 !important;
            height: 100% !important;
            display: flex !important;
            align-items: center !important;
            border-left: 1px solid #2b78af !important;
            border-radius: 0 4px 4px 0 !important;
        }
        .fi-input-wrp:has(.fi-input-suffix) svg {
            color: white !important;
            width: 1.1rem !important;
            height: 1.1rem !important;
        }

        /* Tombol Footer Container */
        .btn-footer {
            display: flex;
            justify-content: space-between; /* Align Kembali to left, Simpan to right */
            align-items: center;
            margin-top: 2rem;
            gap: 1rem;
        }

        /* Generic Button Style */
        .btn-custom {
            border: none;
            border-radius: 4px;
            padding: 0.7rem 1.5rem;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: all 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            text-decoration: none !important;
            text-transform: uppercase;
        }

        .btn-simpan {
            background-color: #2b78af; 
            color: white;
        }
        .btn-simpan:hover { background-color: #1e5a85; transform: translateY(-1px); }

        .btn-kembali {
            background-color: #ef4444;
            color: white;
            border: none;
        }
        .btn-kembali:hover { 
            background-color: #dc2626; 
            transform: translateY(-1px); 
            color: white;
        }

        /* == Table Customization == */
        .table-wrapper {
            background: white;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
            overflow: hidden;
        }
        .dark .table-wrapper {
            background: #1e293b;
            border-color: #334155;
        }
        /* REVISI AGRESIF: Hilangkan Garis Dobel */
        .fi-ta-header-cell {
            background-color: #4b5563 !important;
            padding: 12px 14px !important;
            border-right: 1px solid rgba(255, 255, 255, 0.2) !important; /* Garis tunggal */
            border-left: none !important;
            border-top: none !important;
            border-bottom: none !important;
            position: relative !important;
        }

        /* Hilangkan SEMUA border dari elemen anak (penyebab garis dobel) */
        .fi-ta-header-cell *, 
        .fi-ta-header-cell button,
        .fi-ta-header-cell div,
        .fi-ta-header-cell span,
        .fi-ta-header-cell svg {
            border: none !important;
            border-right: none !important;
            border-left: none !important;
            outline: none !important;
            box-shadow: none !important;
            background-color: transparent !important;
        }

        .fi-ta-header-cell:last-child { 
            border-right: none !important; 
        }

        /* Hilangkan Fitur Centang */
        .fi-ta-selection-cell, 
        .fi-ta-selection-header-cell { 
            display: none !important; 
        }

        /* == Spaced Search Area == */
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
            display: contents !important; /* Dissolve intermediate containers */
        }

        /* Hide everything else in the header */
        .fi-ta-header > *:not(.fi-ta-header-toolbar),
        .fi-ta-header-grid, 
        .fi-ta-header-actions-ctn,
        .fi-ta-header-toolbar > div > *:not(.fi-ta-search-field) {
            display: none !important;
        }

        /* Styling the search field to be clean and standalone */
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

        /* Ensure table header is clean */
        .fi-ta-content,
        .fi-ta-table {
            margin-top: 0 !important;
        }

        /* Restore container borders that might have been removed */
        .fi-ta-ctn {
            border: 1px solid #cbd5e1 !important;
            border-radius: 4px !important;
            overflow: hidden;
        }

        /* FIX: Force White & Center - CARA PAKSA (Global) */
        /* Kita kecualikan kolom Nama Menu dari pemaksaan center ini */
        .fi-ta-header-cell:not(.column-nama-menu), 
        .fi-ta-header-cell:not(.column-nama-menu) *,
        .fi-ta-cell:not(.column-nama-menu),
        .fi-ta-cell:not(.column-nama-menu) * {
            text-align: center !important;
            justify-content: center !important;
        }

        /* KHUSUS NAMA MENU: PAKSA RATA KIRI */
        .column-nama-menu,
        th.column-nama-menu,
        td.column-nama-menu {
            text-align: left !important;
            padding-left: 24px !important;
        }

        /* Target isi di dalam cell Nama Menu secara sangat spesifik */
        .column-nama-menu div,
        .column-nama-menu span,
        .column-nama-menu .fi-ta-text,
        .column-nama-menu .fi-ta-text-item,
        .column-nama-menu .fi-ta-text-item-label {
            text-align: left !important;
            justify-content: flex-start !important;
            margin-left: 0 !important;
            margin-right: auto !important;
            display: flex !important;
        }

        .fi-ta-header-cell,
        .fi-ta-header-cell * {
            color: white !important;
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            text-transform: uppercase;
        }

        /* Force Center Alignment for Header Content Deeply */
        .fi-ta-header-cell > div,
        .fi-ta-header-cell > span,
        .fi-ta-header-cell .group,
        .fi-ta-header-cell button {
            display: flex !important;
            width: 100% !important;
            margin: 0 auto !important;
        }

        /* SPECIFIC FIX FOR ACTIONS HEADER */
        .fi-ta-header-cell:last-child > span {
            display: flex !important;
            width: 100% !important;
        }
        
        /* Isi Tabel: TANPA garis vertikal agar bersih */
        .fi-ta-cell {
            border-right: none !important;
            border-inline-end: none !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            vertical-align: middle !important;
        }
        
        /* FIX: Force Center for Body Content */
        .fi-ta-cell > div,
        .fi-ta-cell .fi-ta-text-item,
        .fi-ta-cell .fi-badge {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .fi-ta-cell:last-child { border-right: none !important; }

        /* Compact Action Buttons */
        .fi-ta-actions {
            justify-content: center !important;
            gap: 6px !important;
            display: flex !important;
            align-items: center !important;
            min-height: 48px;
            width: 100% !important; /* Ensure it takes full width for centering */
        }

        /* Target the custom classes for solid boxes */
        .btn-ta-custom {
            width: 32px !important;
            height: 32px !important;
            border-radius: 4px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.2s !important;
            border: none !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1) !important;
            padding: 0 !important;
        }

        /* Ensure standard buttons also follow if classes match */
        .btn-submenu-custom { background-color: #2b78af !important; }
        .btn-edit-custom { background-color: #0ea5e9 !important; }
        .btn-delete-custom { background-color: #ef4444 !important; }

        /* Force icons to be white */
        .btn-ta-custom svg {
            width: 16px !important;
            height: 16px !important;
            color: white !important;
        }
        
        .btn-ta-custom:hover { 
            opacity: 0.9 !important; 
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1) !important;
        }

        /* Handle labels if any (should be hidden) */
        .btn-ta-custom span { display: none !important; }
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 columns for more space */
            gap: 0.75rem;
            max-height: 450px;
            overflow-y: auto;
            padding: 1.25rem;
            background: #f8fafc;
        }
        .dark .icon-grid {
            background: #0f172a;
        }
        .icon-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid transparent;
        }
        .icon-item:hover {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            transform: scale(1.05);
        }
        .icon-item.selected {
            background-color: #e0f2fe;
            border-color: #0ea5e9;
        }
        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .icon-circle svg {
            width: 18px;
            height: 18px;
            color: #64748b;
        }
        .icon-item.selected .icon-circle {
            background-color: #0ea5e9;
            border-color: #0ea5e9;
        }
        .icon-item.selected .icon-circle svg {
            color: white;
        }
        .icon-label {
            font-size: 0.6rem;
            text-align: center;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }
    </style>

    <div class="layout-container" x-data="{
        searchIcon: '',
        icons: {{ json_encode(\App\Filament\Resources\Menus\Schemas\MenuForm::getIcons()) }},
        get selectedIcon() {
            let id = $wire.get('menuData.icon') || 'heroicon-o-home';
            return this.icons.find(i => i.id === id) || this.icons[0];
        },
        get filteredIcons() {
            if (!this.searchIcon) return this.icons;
            let query = this.searchIcon.toLowerCase();
            return this.icons.filter(i => 
                i.label.toLowerCase().includes(query) || 
                i.id.toLowerCase().includes(query)
            );
        }
    }">




        {{-- Main Table Area --}}
        <div class="filament-table-override">
             {{ $this->table }}
        </div>

        {{-- == MODAL FORM MENU == --}}
        <x-filament::modal id="menu-form-modal" width="xl" :display-classes="false">
            <div class="custom-card">
                <div class="modal-header-custom">
                    <x-filament::icon icon="heroicon-s-pencil-square" class="h-5 w-5 text-white"/>
                    <span class="modal-title-text">
                        {{ $this->editingMenuId ? __('Ubah Data Menu') : __('Buat Menu Baru') }}
                    </span>
                </div>

                <div class="card-body" style="padding: 0;">
                    <form wire:submit="save">
                        
                        {{-- Hidden Icon Field --}}
                        {{ $this->form->getComponent('icon') }}

                        {{-- Nama Menu dengan Custom Trigger --}}
                        <div class="form-group">
                            <label class="form-label">{{ __('Nama Menu') }}</label>
                            <div class="icon-name-wrapper">
                                <div class="icon-trigger-box" 
                                     x-on:click="$dispatch('open-modal', { id: 'icon-picker-modal' })" 
                                     title="{{ __('Pilih Icon') }}">
                                    <template x-if="selectedIcon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" :d="selectedIcon.path"></path>
                                        </svg>
                                    </template>
                                </div>
                                <div class="name-field-box">
                                    {{ $this->form->getComponent('name') }}
                                </div>
                            </div>
                        </div>

                        {{-- Alamat Tautan --}}
                        <div class="form-group">
                            <label class="form-label">{{ __('Alamat Tautan') }}</label>
                            {{ $this->form->getComponent('link') }}
                        </div>

                        {{-- Baris Ketiga: Posisi, Urutan, Aktif --}}
                        <div class="triple-row">
                            <div>
                                <label class="form-label">{{ __('Posisi') }}</label>
                                {{ $this->form->getComponent('position') }}
                            </div>
                            <div>
                                <label class="form-label">{{ __('Urutan') }}</label>
                                {{ $this->form->getComponent('order') }}
                            </div>
                            <div style="text-align: center;">
                                <label class="form-label">{{ __('Aktif') }}</label>
                                <div class="flex justify-center">
                                    {{ $this->form->getComponent('status') }}
                                </div>
                            </div>
                        </div>

                        <div class="btn-footer" style="margin-bottom: 0;">
                            <div class="flex gap-3">
                                <button type="button" x-on:click="close" class="btn-custom btn-kembali">
                                    {{ __('Tutup') }}
                                </button>
                            </div>

                            <button type="submit" class="btn-custom btn-simpan">
                                <x-filament::icon icon="heroicon-s-document-check" class="h-5 w-5"/>
                                {{ $this->editingMenuId ? __('Simpan Perubahan') : __('Simpan Menu') }}
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </x-filament::modal>

        {{-- == MODAL ICON PICKER == --}}
        <x-filament::modal id="icon-picker-modal" width="md">
            <x-slot name="heading">
                {{ __('Pilih Icon Menu') }}
            </x-slot>

            <div class="space-y-4">
                {{-- Search --}}
                <div class="px-4">
                    <x-filament::input.wrapper>
                        <x-filament::input
                            type="text"
                            placeholder="{{ __('Cari icon menu...') }}"
                            x-model="searchIcon"
                            autofocus
                        />
                    </x-filament::input.wrapper>
                </div>

                {{-- Grid --}}
                <div class="icon-grid">
                    <template x-for="icon in filteredIcons" :key="icon.id">
                        <div class="icon-item" 
                            :class="{ 'selected': $wire.menuData.icon === icon.id }"
                            @click="$wire.set('menuData.icon', icon.id); $dispatch('close-modal', { id: 'icon-picker-modal' })"
                        >
                            <div class="icon-circle">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="icon.path"></path>
                                </svg>
                            </div>
                            <span class="icon-label" x-text="icon.label"></span>
                        </div>
                    </template>
                </div>
            </div>
        </x-filament::modal>
        
    </div>

</x-filament-panels::page>