<x-filament-panels::page>

{{-- ============================================ --}}
{{-- INLINE STYLE: Light + Dark mode support      --}}
{{-- Diinject di sini karena Tailwind v4 di file  --}}
{{-- Filament blade custom tidak di-scan.         --}}
{{-- ============================================ --}}
<style>
    /* --- Card Template --- */
    .tpl-card {
        display: flex;
        flex-direction: column;
        text-align: left;
        background-color: #ffffff;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.875rem;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.25s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.10), 0 1px 4px rgba(0,0,0,0.07);
        width: 100%;
    }
    .dark .tpl-card {
        background-color: #1e293b;
        border-color: #334155;
        box-shadow: 0 4px 16px rgba(0,0,0,0.35), 0 1px 4px rgba(0,0,0,0.2);
    }
    .tpl-card:hover {
        border-color: #3b82f6;
        transform: translateY(-4px);
        box-shadow: 0 16px 36px rgba(16,185,129,0.15), 0 4px 12px rgba(0,0,0,0.10);
    }
    .dark .tpl-card:hover {
        border-color: #60a5fa;
        transform: translateY(-4px);
        box-shadow: 0 16px 36px rgba(52,211,153,0.2), 0 4px 16px rgba(0,0,0,0.4);
    }

    /* --- Card Preview Area (SVG container) --- */
    .tpl-card-preview {
        padding: 1rem;
        background-color: #f9fafb;
        border-bottom: 1px solid #f1f5f9;
    }
    .dark .tpl-card-preview {
        background-color: #0f172a;
        border-bottom-color: #1e293b;
    }

    /* --- Card Body --- */
    .tpl-card-body {
        padding: 0.875rem 1rem;
        flex: 1;
    }
    .tpl-card-title {
        font-weight: 600;
        color: #111827;
        font-size: 0.875rem;
        margin-bottom: 0.2rem;
    }
    .dark .tpl-card-title {
        color: #f1f5f9;
    }
    .tpl-card-desc {
        color: #9ca3af;
        font-size: 0.75rem;
    }
    .dark .tpl-card-desc {
        color: #64748b;
    }

    /* --- Grid --- */
    .tpl-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.25rem;
    }

    /* --- Subtitle --- */
    .tpl-subtitle {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }
    .dark .tpl-subtitle {
        color: #64748b;
    }

    /* --- Modal Overlay --- */
    .tpl-modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background-color: rgba(17,24,39,0.55);
        backdrop-filter: blur(4px);
    }

    /* --- Modal Box --- */
    .tpl-modal-box {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        width: 100%;
        max-width: 28rem;
        box-shadow: 0 20px 60px -8px rgba(0,0,0,0.18);
        overflow: hidden;
    }
    .dark .tpl-modal-box {
        background-color: #1e293b;
        border-color: #334155;
        box-shadow: 0 20px 60px -8px rgba(0,0,0,0.6);
    }

    /* --- Modal Header --- */
    .tpl-modal-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    .dark .tpl-modal-header {
        border-bottom-color: #334155;
    }
    .tpl-modal-title {
        margin: 0;
        color: #111827;
        font-size: 1rem;
        font-weight: 700;
    }
    .dark .tpl-modal-title {
        color: #f1f5f9;
    }
    .tpl-modal-desc {
        margin: 0;
        color: #9ca3af;
        font-size: 0.75rem;
    }
    .dark .tpl-modal-desc {
        color: #64748b;
    }
    .tpl-modal-close {
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 0.375rem;
        transition: all 0.15s;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }
    .tpl-modal-close:hover {
        color: #374151;
        background-color: #f9fafb;
    }
    .dark .tpl-modal-close:hover {
        color: #e2e8f0;
        background-color: rgba(255,255,255,0.08);
    }

    /* --- Modal Body --- */
    .tpl-modal-body {
        padding: 1.5rem;
    }

    /* --- Label --- */
    .tpl-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    .dark .tpl-label {
        color: #cbd5e1;
    }
    .tpl-label-muted {
        color: #9ca3af;
        font-weight: 400;
    }
    .dark .tpl-label-muted {
        color: #475569;
    }

    /* --- Input --- */
    .tpl-input {
        width: 100%;
        background-color: #f9fafb;
        border: 1.5px solid #d1d5db;
        color: #111827;
        border-radius: 0.625rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        outline: none;
        box-sizing: border-box;
        transition: all 0.2s;
        font-family: inherit;
    }
    .dark .tpl-input {
        background-color: #0f172a;
        border-color: #334155;
        color: #f1f5f9;
    }
    .tpl-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(16,185,129,0.12);
        background-color: #ffffff;
    }
    .dark .tpl-input:focus {
        background-color: #1e293b;
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(52,211,153,0.12);
    }
    .tpl-input::placeholder {
        color: #d1d5db;
    }
    .dark .tpl-input::placeholder {
        color: #475569;
    }

    /* --- Slug Field --- */
    .tpl-slug-wrap {
        display: flex;
        border: 1.5px solid #d1d5db;
        border-radius: 0.625rem;
        overflow: hidden;
        background-color: #f9fafb;
        transition: all 0.2s;
    }
    .dark .tpl-slug-wrap {
        background-color: #0f172a;
        border-color: #334155;
    }
    .tpl-slug-wrap:focus-within {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(16,185,129,0.12);
    }
    .dark .tpl-slug-wrap:focus-within {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(52,211,153,0.12);
    }
    .tpl-slug-prefix {
        padding: 0.75rem 0.875rem;
        background-color: #f3f4f6;
        border-right: 1.5px solid #d1d5db;
        color: #6b7280;
        font-size: 0.8rem;
        font-family: monospace;
        user-select: none;
        white-space: nowrap;
        display: flex;
        align-items: center;
    }
    .dark .tpl-slug-prefix {
        background-color: #1e293b;
        border-right-color: #334155;
        color: #64748b;
    }
    .tpl-slug-input {
        flex: 1;
        background: transparent;
        border: none;
        color: #374151;
        padding: 0.75rem 1rem;
        font-size: 0.8rem;
        font-family: monospace;
        outline: none;
        min-width: 0;
    }
    .dark .tpl-slug-input {
        color: #cbd5e1;
    }

    /* --- Modal Footer --- */
    .tpl-modal-footer {
        padding: 1.125rem 1.5rem;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.75rem;
        background-color: #f9fafb;
    }
    .dark .tpl-modal-footer {
        border-top-color: #334155;
        background-color: #0f172a;
    }

    /* --- Tombol Batal --- */
    .tpl-btn-cancel {
        background: #ffffff;
        border: 1.5px solid #d1d5db;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        height: 2.625rem;
        padding: 0 1.25rem;
        border-radius: 0.625rem;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: inherit;
    }
    .tpl-btn-cancel:hover {
        border-color: #9ca3af;
        background-color: #f9fafb;
        color: #111827;
    }
    .dark .tpl-btn-cancel {
        background: transparent;
        border-color: #475569;
        color: #94a3b8;
    }
    .dark .tpl-btn-cancel:hover {
        border-color: #64748b;
        background-color: rgba(255,255,255,0.05);
        color: #e2e8f0;
    }

    /* --- Tombol Submit --- */
    .tpl-btn-submit {
        background-color: #3b82f6;
        color: #fff;
        border: none;
        font-size: 0.875rem;
        font-weight: 700;
        height: 2.625rem;
        padding: 0 1.5rem;
        border-radius: 0.625rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        white-space: nowrap;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        cursor: pointer;
        font-family: inherit;
    }
    .tpl-btn-submit:hover:not(:disabled) {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
    }
    .tpl-btn-submit:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }
</style>

    <div class="tpl-subtitle">Pilih template visual untuk halaman yang akan Anda buat.</div>

    <div x-data="{
        modalOpen: false,
        selected: null,
        title: '',
        slug: '',
        menuName: new URLSearchParams(window.location.search).get('menu_name') || '',
        templates: @js($this->getTemplateData()),
        select(key) {
            this.selected = key;
            this.title = this.menuName;
            if (this.title) {
                this.generateSlug(this.title);
            } else {
                this.slug = '';
            }
            this.modalOpen = true;
            setTimeout(() => {
                const el = document.getElementById('page_title_input');
                if (el) el.focus();
            }, 150);
        },
        generateSlug(val) {
            this.slug = val.toLowerCase()
                .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
                .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o')
                .replace(/[ùúûü]/g, 'u').replace(/[^a-z0-9\s-]/g, '')
                .trim().replace(/\s+/g, '-');
        },
        submit() {
            if (!this.title.trim()) return;
            window.location.href = this.createUrl;
        },
        get createUrl() {
            if (!this.selected) return '#';
            const base = '{{ route('filament.admin.resources.dynamic-pages.create') }}';
            let url = base + '?template=' + encodeURIComponent(this.selected)
                       + '&title=' + encodeURIComponent(this.title)
                       + '&slug=' + encodeURIComponent(this.slug);
            const menuId = '{{ request()->query('menu_id') }}';
            if (menuId) {
                url += '&menu_id=' + encodeURIComponent(menuId);
            }
            return url;
        }
    }" @keydown.escape.window="modalOpen = false">

        {{-- GRID TEMPLATES --}}
        <div class="tpl-grid">
            @foreach($this->getTemplateData() as $key => $tpl)
                <button type="button" @click="select('{{ $key }}')" class="tpl-card">
                    {{-- SVG Miniatur --}}
                    <div class="tpl-card-preview">
                        @include('filament.resources.dynamic-pages.partials.template-preview', ['key' => $key])
                    </div>

                    {{-- Deskripsi --}}
                    <div class="tpl-card-body">
                        <div class="tpl-card-title">{{ $tpl['label'] }}</div>
                        <div class="tpl-card-desc">{{ $tpl['description'] }}</div>
                        <div
                            style="margin-top: 0.625rem; display: inline-block; padding: 0.15rem 0.6rem; font-size: 0.68rem; font-weight: 600; border-radius: 999px; background-color: {{ $tpl['cat_color'] }}22; color: {{ $tpl['cat_color'] }}; border: 1px solid {{ $tpl['cat_color'] }}44;">
                            {{ $tpl['category'] }}
                        </div>
                    </div>
                </button>
            @endforeach
        </div>

        {{-- MODAL --}}
        <div x-show="modalOpen" style="display: none;" x-transition.opacity>
            <div class="tpl-modal-overlay">
                <div @click.away="modalOpen = false"
                    class="tpl-modal-box"
                    x-show="modalOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95">

                    {{-- Header --}}
                    <div class="tpl-modal-header">
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.2rem;">
                                <span style="width: 0.5rem; height: 0.5rem; background-color: #3b82f6; border-radius: 50%; display: inline-block; flex-shrink: 0;"></span>
                                <h3 class="tpl-modal-title" x-text="selected ? templates[selected].label : ''"></h3>
                            </div>
                            <p class="tpl-modal-desc" x-text="selected ? templates[selected].description : ''"></p>
                        </div>
                        <button type="button" @click="modalOpen = false" class="tpl-modal-close">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Body --}}
                    <div class="tpl-modal-body">
                        <div style="margin-bottom: 1.25rem;">
                            <label for="page_title_input" class="tpl-label">
                                Judul Halaman <span style="color: #ef4444;">*</span>
                            </label>
                            <input id="page_title_input" type="text" x-model="title"
                                @input="generateSlug($event.target.value)" @keydown.enter.prevent="submit()"
                                placeholder="Contoh: Profil Instansi" autocomplete="off"
                                class="tpl-input" />
                        </div>

                        <div>
                            <label class="tpl-label">
                                URL Slug <span class="tpl-label-muted">(otomatis)</span>
                            </label>
                            <div class="tpl-slug-wrap">
                                <span class="tpl-slug-prefix">/halaman/</span>
                                <input type="text" x-model="slug" @keydown.enter.prevent="submit()" class="tpl-slug-input" />
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="tpl-modal-footer">
                        <button type="button" @click="modalOpen = false" class="tpl-btn-cancel">
                            Batal
                        </button>
                        <button type="button" @click="submit()" :disabled="!title.trim()" class="tpl-btn-submit">
                            <span>Buat Halaman</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.1rem; height: 1.1rem; flex-shrink: 0;"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

</x-filament-panels::page>