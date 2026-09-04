<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;

use Illuminate\Support\Facades\Blade;
// use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {


        return $panel
            ->default()
            ->id('admin')
            ->path('site-admin')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->maxContentWidth('full')


            // === 1. LOGO & JUDUL ===
            ->brandName(__('CMS Government'))
            ->brandLogo(fn() => new HtmlString('
                <div style="display: flex; align-items: center; gap: 12px; padding-left: 8px;">
                     <!-- Placeholder Logo Container -->
                     <div style="background: white; padding: 6px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #f8fafc; display: flex; align-items: center; justify-content: center; width: 42px; height: 42px;">
                         
                         <!-- TODO: UNTUK MEMASANG LOGO NANTI, UNCOMMENT BARIS DI BAWAH INI -->
                         <img src="/images/logo_mahulu.png" alt="Logo" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                         
                         <!-- ... LALU HAPUS SVG PLACEHOLDER INI -->
                         <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="22" y2="22"/>
                            <line x1="6" x2="6" y1="18" y2="11"/>
                            <line x1="10" x2="10" y1="18" y2="11"/>
                            <line x1="14" x2="14" y1="18" y2="11"/>
                            <line x1="18" x2="18" y1="18" y2="11"/>
                            <polygon points="12 2 20 7 4 7"/>
                         </svg> --!>
                     </div>
                    <span style="
                        font-weight: 850; 
                        font-size: 1.15rem; 
                        color: #1e3a8a; 
                        letter-spacing: -0.5px;
                        line-height: 1;
                        font-family: \'Plus Jakarta Sans\', sans-serif;
                    ">
                        CMS PROKOPIM Mahulu<br>
                        <span style="font-size: 0.65rem; color: #2563eb; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">' . __('Admin Panel') . '</span>
                    </span>
                </div>
            '))

            // === 2. MODIFIKASI TAMPILAN MODERN (CSS INJECTION) ===
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn(): string => Blade::render(<<<'HTML'
                <style>
                    /* --- 1. GLOBAL BACKGROUND --- */
                    .fi-layout, .fi-body {
                        background-color: #f8fafc !important; 
                    }
                    .dark .fi-layout, .dark .fi-body {
                        background-color: #020617 !important;
                    }

                    /* --- 2. HEADER STYLING --- */
                    .fi-header {
                        background-color: rgba(255, 255, 255, 0.9) !important;
                        backdrop-filter: blur(10px);
                        border-bottom: 1px solid #e2e8f0;
                        position: sticky;
                        top: 0;
                        z-index: 20;
                        padding: 1rem 2rem !important;
                    }
                    
                    /* Topbar Right Icons Gap */
                    .fi-topbar-content > div:last-child {
                        display: flex !important;
                        align-items: center !important;
                        gap: 1rem !important;
                    }
                    .dark .fi-header {
                        background-color: rgba(15, 23, 42, 0.9) !important;
                        border-bottom-color: #1e293b;
                    }

                    .fi-header-heading {
                        font-weight: 700 !important;
                        color: #1e293b;
                        letter-spacing: -0.025em;
                        font-size: 1.5rem !important;
                    }
                    .dark .fi-header-heading {
                        color: #f1f5f9 !important;
                    }

                    /* --- GLOBAL TYPOGRAPHY REFINEMENT --- */
                    /* Memperhalus label input agar lebih terbaca dan tidak "kasar" */
                    .fi-fo-field-wrp-label {
                        color: #334155 !important; /* Warna lebih tegas supaya kelihatan */
                        font-weight: 600 !important;
                        font-size: 0.875rem !important;
                        letter-spacing: 0.01em;
                        margin-bottom: 0.5rem !important;
                        display: inline-block !important;
                    }
                    .dark .fi-fo-field-wrp-label {
                        color: #e2e8f0 !important; /* Kontras tinggi di mode gelap */
                    }

                    /* Smooth Section Headers */
                    .fi-section-header-heading {
                        font-weight: 700 !important;
                        font-size: 1.1rem !important;
                        letter-spacing: -0.01em;
                        color: #1e293b !important;
                        text-transform: none !important; /* Menghilangkan ALL CAPS agar lebih smooth */
                    }
                    .dark .fi-section-header-heading {
                        color: #f8fafc !important;
                    }

                    /* Input placeholder smoothness */
                    ::placeholder {
                        color: #94a3b8 !important;
                        font-weight: 400 !important;
                    }

                    /* --- 3. SIDEBAR COMPACT & MODERN --- */
                    .fi-sidebar {
                        background-color: white !important;
                        border-right: 1px solid #e2e8f0;
                        box-shadow: 4px 0 24px rgba(0,0,0,0.02);
                    }
                    .dark .fi-sidebar {
                        background-color: #0f172a !important;
                        border-right-color: #1e293b;
                        box-shadow: 4px 0 24px rgba(0,0,0,0.2);
                    }

                    .fi-sidebar-group-label {
                        color: #64748b !important;
                        font-weight: 700 !important;
                    }
                    .dark .fi-sidebar-group-label {
                        color: #94a3b8 !important;
                    }

                    /* --- GLOBAL TEXT VISIBILITY REFINEMENT --- */
                    /* Memastikan teks tabel & elemen umum selalu kontras */
                    .fi-ta-text-item-label, .fi-ta-text-item-description {
                        color: #334155 !important;
                    }
                    .dark .fi-ta-text-item-label, .dark .fi-ta-text-item-description {
                        color: #e2e8f0 !important;
                    }
                    
                    /* Background zebra tabel yang lebih smooth */
                    .fi-ta-row:nth-child(even) {
                        background-color: rgba(0, 0, 0, 0.01);
                    }
                    .dark .fi-ta-row:nth-child(even) {
                        background-color: rgba(255, 255, 255, 0.02);
                    }

                    .fi-sidebar-nav .fi-sidebar-item {
                        margin-bottom: 2px !important;
                    }
                    .fi-sidebar-item-button {
                        padding-top: 6px !important;
                        padding-bottom: 6px !important;
                        border-radius: 8px !important;
                    }

                    .fi-sidebar-item-active .fi-sidebar-item-button {
                        background-color: #eff6ff !important;
                        color: #2563eb !important;
                        font-weight: 600 !important;
                    }
                    .dark .fi-sidebar-item-active .fi-sidebar-item-button {
                        background-color: rgba(37, 99, 235, 0.15) !important;
                        color: #60a5fa !important;
                    }

                    /* --- 4. CONTENT CARDS (FORM & TABEL) --- */
                    .fi-main-ctn, .fi-form, .fi-section, .fi-ta-ctn {
                        border-radius: 12px !important;
                    }

                    /* Section Headers (seperti "CREATE KATEGORI INFO PUBLIK") */
                    .fi-section-header-heading {
                        font-weight: 700 !important;
                        font-size: 1rem !important;
                        color: #334155 !important;
                        text-transform: none !important; /* Lebih smooth, tidak dipaksa huruf besar */
                    }
                    .dark .fi-section-header-heading {
                        color: #f1f5f9 !important;
                    }
                    
                    .fi-fo {
                        background-color: white !important;
                        border: 1px solid #f1f5f9;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
                        padding: 2rem !important;
                        margin-top: 1rem !important;
                    }
                    .dark .fi-fo {
                        background-color: #1e293b !important;
                        border-color: #334155;
                        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.4) !important;
                    }

                    .fi-btn-primary {
                        background-image: linear-gradient(to bottom right, #2563eb, #1e3a8a);
                        border: none;
                        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
                        transition: transform 0.2s;
                    }
                    .fi-btn-primary:hover {
                        transform: translateY(-1px);
                        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
                    }

                    /* --- 5. ABSOLUTE FULL WIDTH LAYOUT (scoped to .fi-page only) --- */
                    /* Modals render OUTSIDE .fi-page, so they won't be affected */
                    .fi-main-ctn,
                    .fi-main-ctn > div,
                    .fi-header,
                    .fi-ta-ctn {
                        max-width: none !important;
                        width: 100% !important;
                    }

                    /* Full-width for page content ONLY */
                    .fi-page,
                    .fi-page > div,
                    .fi-page .fi-section,
                    .fi-page .fi-fo,
                    .fi-page .fi-fo-ctn,
                    .fi-page .fi-fo-ctn > div,
                    .fi-page .fi-schema,
                    .fi-page .fi-schema > div,
                    .fi-page .fi-form-ctn,
                    .fi-page .fi-form-ctn > div,
                    .fi-page-content,
                    .fi-page-content > div,
                    .fi-page-content > div > div {
                        max-width: none !important;
                        width: 100% !important;
                    }


                    .fi-header > div {
                        display: flex !important;
                        justify-content: space-between !important;
                        align-items: center !important;
                        flex-wrap: wrap !important;
                        gap: 1rem !important;
                    }
                    .fi-breadcrumbs {
                        width: 100% !important;
                        margin-bottom: -0.5rem !important;
                    }
                    .fi-main {
                        padding: 1rem 1.5rem !important;
                    }
                    
                    @media (min-width: 1024px) {
                        .fi-main { padding: 1.5rem 2rem !important; }
                    }

                    /* --- 6. PRECISE TREE SIDEBAR HIERARCHY --- */
                    /* Buletin Group (Group 2) */
                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(n+4) {
                        margin-left: 1.25rem !important;
                        padding-left: 0.75rem !important;
                        border-left: 1px solid #cbd5e1;
                        position: relative;
                        margin-bottom: 2px;
                        transition: all 0.2s ease;
                    }
                    .dark .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(n+4) {
                        border-left-color: #334155;
                    }

                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(n+4)::before {
                        content: "";
                        position: absolute;
                        left: 0;
                        top: 50%;
                        width: 0.5rem;
                        border-top: 1px solid #cbd5e1;
                    }
                    .dark .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(n+4)::before {
                        border-top-color: #334155;
                    }

                    /* Parent Item styling for Profil Buletin (the 3rd item in Buletin group) */
                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(3) {
                        position: relative;
                        z-index: 1;
                        border-radius: 8px !important;
                        background-color: #f1f5f9 !important;
                        margin-bottom: 4px !important;
                    }
                    .dark .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(3) {
                        background-color: rgba(255, 255, 255, 0.05) !important;
                    }

                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(3)::after {
                        content: "";
                        position: absolute;
                        left: 1.55rem;
                        top: 100%;
                        bottom: -10px;
                        border-left: 1px solid #cbd5e1;
                        z-index: 0;
                    }
                    .dark .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :nth-child(3)::after {
                        border-left-color: #334155;
                    }
                    
                    /* Hide child link if last child */
                    .fi-sidebar-nav > .fi-sidebar-group:nth-of-type(2) .fi-sidebar-group-items > :last-child {
                        border-left: none !important;
                    }

                    /* Smooth Breadcrumbs */
                    .fi-breadcrumbs-item-label {
                        font-weight: 500 !important;
                        font-size: 0.825rem !important;
                        color: #64748b !important;
                    }
                    .dark .fi-breadcrumbs-item-label {
                        color: #94a3b8 !important;
                    }
                    .fi-breadcrumbs-item-active .fi-breadcrumbs-item-label {
                        color: #1e293b !important;
                        font-weight: 600 !important;
                    }
                    .dark .fi-breadcrumbs-item-active .fi-breadcrumbs-item-label {
                        color: #f1f5f9 !important;
                    }

                    /* Smooth Input Text */
                    input, select, textarea {
                        font-family: inherit !important;
                        font-size: 0.925rem !important;
                    }

                    /* Rich editor must stay focusable/editable even with global layout overrides */
                    .fi-fo-rich-editor,
                    .fi-fo-rich-editor-main,
                    .fi-fo-rich-editor-content {
                        position: relative !important;
                        z-index: 2 !important;
                        overflow: visible !important;
                    }

                    .fi-fo-rich-editor .ProseMirror,
                    .fi-fo-rich-editor [contenteditable="true"] {
                        min-height: 24rem !important;
                        padding: 1rem !important;
                        pointer-events: auto !important;
                        user-select: text !important;
                        -webkit-user-select: text !important;
                        cursor: text !important;
                        position: relative !important;
                        z-index: 3 !important;
                        background: #fff !important;
                    }

                    .dark .fi-fo-rich-editor .ProseMirror,
                    .dark .fi-fo-rich-editor [contenteditable="true"] {
                        background: #0f172a !important;
                    }

                    .fi-fo-rich-editor-toolbar,
                    .fi-fo-rich-editor-panels {
                        position: relative !important;
                        z-index: 4 !important;
                    }

                    /* --- 7. GLOBAL TABLE STYLING (MODERN & CENTERED - FORCED) --- */
                    
                    /* Hilangkan fitur centang (Selection Checkbox) */
                    .fi-ta-selection-cell, 
                    .fi-ta-selection-header-cell {
                        display: none !important;
                    }

                    /* FORCE CENTER SEMUA ISI TABEL (HEADER & BODY) - KECUALI FILE MANAGER & KOLOM NAMA MENU */
                    /* Gunakan selektor yang lebih spesifik agar tidak tabrakan */
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-header-cell:not(.column-nama-menu):not(.text-left):not(.ppid-name-col), 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-header-cell:not(.column-nama-menu):not(.text-left):not(.ppid-name-col) *,
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-cell:not(.column-nama-menu):not(.long-text-column):not(.text-left):not(.ppid-name-col),
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-cell:not(.column-nama-menu):not(.long-text-column):not(.text-left):not(.ppid-name-col) * {
                        text-align: center !important;
                        justify-content: center !important;
                    }

                    /* PPID Name Column - Force Left Align */
                    .fi-ta-header-cell.ppid-name-col,
                    .fi-ta-header-cell.ppid-name-col * {
                        text-align: left !important;
                        justify-content: flex-start !important;
                    }
                    .fi-ta-cell.ppid-name-col .fi-ta-text-item,
                    .fi-ta-cell.ppid-name-col .fi-ta-text-item-label,
                    .fi-ta-cell.ppid-name-col .fi-ta-text-item-description {
                        text-align: left !important;
                        justify-content: flex-start !important;
                        width: 100%;
                        display: flex;
                    }

                    /* Center Text Items and Actions - ONLY FOR TABLES (Excluded in Grid View) */
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu):not(.ppid-name-col) .fi-ta-text-item, 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu):not(.ppid-name-col) .fi-ta-text-item-label, 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu):not(.ppid-name-col) .fi-ta-text-item-description,
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-actions {
                        width: 100% !important;
                        display: flex !important;
                        justify-content: center !important;
                    }

                    .fi-ta-header-cell, 
                    .fi-ta-header-cell * {
                        background-color: #4b5563 !important; /* Gray 600 - Unified Color */
                        color: white !important;
                        padding-top: 0.875rem !important;
                        padding-bottom: 0.875rem !important;
                        border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
                        transition: background-color 0.2s;
                    }

                    .dark .fi-ta-header-cell,
                    .dark .fi-ta-header-cell * {
                        background-color: #1e293b !important; /* Slate 800 */
                        border-right-color: rgba(255, 255, 255, 0.05) !important;
                    }

                    .fi-ta-header-cell:last-child {
                        border-right: none !important;
                    }

                    .fi-ta-header-cell-label {
                        font-weight: 700 !important;
                        text-transform: uppercase !important;
                        font-size: 0.75rem !important;
                        letter-spacing: 0.05em !important;
                        display: flex !important;
                        width: 100% !important;
                    }

                    /* Center All Table Content & Row Cells */
                    :not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-cell {
                        border-right: 1px solid #f1f5f9 !important;
                    }
                    .dark :not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-cell {
                        border-right: 1px solid #334155 !important;
                    }
                    .fi-ta-cell:last-child {
                        border-right: none !important;
                    }

                    /* Center Text Items and Actions - ONLY FOR TABLES (Excluded in Grid View) */
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu) .fi-ta-text-item, 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu) .fi-ta-text-item-label, 
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-cell:not(.column-nama-menu) .fi-ta-text-item-description,
                    body:not(.file-manager-grid-view):not(.fi-file-manager) .fi-ta-content .fi-ta-table .fi-ta-actions {
                        width: 100% !important;
                        display: flex !important;
                        justify-content: center !important;
                    }

                    /* Sort Icon */
                    .fi-ta-header-cell .fi-icon-btn, 
                    .fi-ta-header-cell button svg {
                        color: rgba(255, 255, 255, 0.8) !important;
                    }

                    /* --- 8. GLOBAL FLUID & RESPONSIVE TABLES --- */
                    /* Konteks Responsivitas yang Diperhalus */
                    .fi-ta-ctn:not(:has(.fi-ta-content-grid)), 
                    .fi-ta-content:not(.fi-ta-content-grid) {
                        display: block !important;
                        width: 100% !important;
                        overflow-x: auto !important;
                        overflow-y: visible !important;
                        -webkit-overflow-scrolling: touch;
                        position: relative !important;
                    }

                    .fi-ta-table {
                        width: 100% !important;
                        min-width: 0 !important; /* Truly dynamic, no fixed space wasted */
                        table-layout: auto !important;
                        border-collapse: collapse !important;
                    }

                    .fi-ta-header-cell, 
                    .fi-ta-cell {
                        padding: 12px 16px !important;
                        white-space: nowrap !important; /* Default to no-wrap to protect labels */
                    }

                    /* Allow wrapping for long-text columns like PPID name */
                    .fi-ta-cell.ppid-name-col {
                        white-space: normal !important;
                        word-break: break-word !important;
                        min-width: 200px;
                    }

                    /* Class khusus untuk kolom yang isinya panjang (seperti deskripsi) */
                    .fi-ta-cell.long-text-column,
                    .fi-ta-cell.long-text-column * {
                        white-space: normal !important;
                        word-break: break-word !important;
                    }

                    /* CUSTOM SCROLLBAR */
                    .fi-ta-ctn::-webkit-scrollbar, .fi-ta-content::-webkit-scrollbar {
                        height: 8px;
                        background-color: #f8fafc;
                    }
                    .fi-ta-ctn::-webkit-scrollbar-thumb, .fi-ta-content::-webkit-scrollbar-thumb {
                        background: #cbd5e1;
                        border-radius: 10px;
                        border: 2px solid #f8fafc;
                    }

                </style>
                <script>
                    (() => {
                        const marker = 'rv=20260904a';
                        const richEditorPath = '/js/filament/forms/components/rich-editor.js';

                        const patchLoadSrc = (root = document) => {
                            const nodes = root.querySelectorAll('[x-load-src]');

                            nodes.forEach((el) => {
                                const src = el.getAttribute('x-load-src');

                                if (!src || !src.includes(richEditorPath) || src.includes(marker)) {
                                    return;
                                }

                                const separator = src.includes('?') ? '&' : '?';
                                el.setAttribute('x-load-src', `${src}${separator}${marker}`);
                            });
                        };

                        patchLoadSrc();
                        document.addEventListener('livewire:navigated', () => patchLoadSrc());

                        const observer = new MutationObserver((mutations) => {
                            for (const mutation of mutations) {
                                for (const node of mutation.addedNodes) {
                                    if (node instanceof Element) {
                                        patchLoadSrc(node);
                                    }
                                }
                            }
                        });

                        observer.observe(document.documentElement, {
                            childList: true,
                            subtree: true,
                        });
                    })();
                </script>
                HTML)
            )


            // === 3. KONFIGURASI WARNA (DEFAULT STYLE) ===
            ->colors([
                'primary' => Color::Blue,
                'warning' => Color::Yellow,
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => Color::Blue,
            ])

            // === 4. KONFIGURASI UMUM ===
            ->globalSearch(false)
            ->font('Poppins')
            ->icons([
                'panels::sidebar.collapse-button' => 'heroicon-o-bars-3',
                'panels::sidebar.expand-button' => 'heroicon-o-bars-3',
            ])
            ->sidebarWidth('250px')
            ->sidebarCollapsibleOnDesktop()
            ->userMenuItems([
                // Language switcher moved outside to top bar for easier access
            ])
            ->navigationGroups([
                'Portal' => \Filament\Navigation\NavigationGroup::make('Portal')
                    ->label(__('Portal')),
                'Website' => \Filament\Navigation\NavigationGroup::make('Website')
                    ->label(__('Website')),
                'Media & Arsip' => \Filament\Navigation\NavigationGroup::make('Media & Arsip')
                    ->label(__('Media & Arsip')),
                'Pengaturan' => \Filament\Navigation\NavigationGroup::make('Pengaturan')
                    ->label(__('Pengaturan'))
                    ->collapsed(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->spa()
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->renderHook(
                'panels::head.done',
                fn() => new \Illuminate\Support\HtmlString('
                    <style>
                        .fi-wi { gap: 2rem; }
                        .flex { display: flex; }
                        .grid { display: grid; }
                        .gap-8 { gap: 2rem; }
                        .space-y-8 > * + * { margin-top: 2rem; }
                        .rounded-2xl { border-radius: 1rem; }
                    </style>
                ')
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\SetLocale::class,
            ])
            ->renderHook(
                'panels::user-menu.before',
                fn(): string => Blade::render('@include("filament.components.language-switcher")'),
            )
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
