<x-filament-panels::page>

@php
    $menus = $this->getMenus();
    $menusData = $menus->map(fn($m) => [
        'id'       => $m->id,
        'name'     => $m->name,
        'page_id'  => \App\Models\DynamicPage::where('menu_id', $m->id)->value('id'),
        'children' => $m->children->map(fn($c) => [
            'id'       => $c->id,
            'name'     => $c->name,
            'page_id'  => \App\Models\DynamicPage::where('menu_id', $c->id)->value('id'),
            'children' => $c->children->map(fn($g) => [
                'id'    => $g->id,
                'name'  => $g->name,
                'page_id' => \App\Models\DynamicPage::where('menu_id', $g->id)->value('id'),
                'children' => $g->children->map(fn($gg) => [
                    'id'    => $gg->id,
                    'name'  => $gg->name,
                    'page_id' => \App\Models\DynamicPage::where('menu_id', $gg->id)->value('id'),
                ])->values()->all(),
            ])->values()->all(),
        ])->values()->all(),
    ])->values()->all();
    $editBaseUrl = \App\Filament\Resources\DynamicPages\DynamicPageResource::getUrl('index'); 
    $selectBaseUrl = route('filament.admin.resources.dynamic-pages.select-template');
@endphp

<div>

    @push('styles')
    <style>
    /* ── Shell ── */
    .smv-shell {
        display: flex;
        min-height: 460px;
        border-radius: 0.75rem;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #fff;
        box-shadow: 0 1px 3px 0 rgb(0 0 0/.08);
    }
    .dark .smv-shell {
        border-color: #374151;
        background: #111827;
    }

    /* ── Left panel ── */
    .smv-left {
        width: 230px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        background: #f9fafb;
        border-right: 1px solid #e5e7eb;
    }
    .dark .smv-left {
        background: #1f2937;
        border-right-color: #374151;
    }
    .smv-left-header {
        padding: 0.75rem 1rem;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #9ca3af;
        border-bottom: 1px solid #e5e7eb;
    }
    .dark .smv-left-header { border-bottom-color: #374151; }
    .smv-left-body {
        flex: 1;
        overflow-y: auto;
        padding: 0.375rem;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    /* ── Nav items ── */
    .smv-nav {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 0.625rem;
        width: 100%;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
        box-sizing: border-box;
        transition: background 0.12s;
        color: #4b5563;
    }
    .dark .smv-nav { color: #9ca3af; }
    .smv-nav:hover { background: #f3f4f6; }
    .dark .smv-nav:hover { background: #374151; }
    .smv-nav.is-active { background: #ecfdf5; }
    .dark .smv-nav.is-active { background: rgba(16,185,129,.12); }

    .smv-nav-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #d1d5db;
        flex-shrink: 0;
        transition: background .12s;
    }
    .dark .smv-nav-dot { background: #4b5563; }
    .smv-nav.is-active .smv-nav-dot { background: #3b82f6; }

    .smv-nav-label {
        flex: 1;
        font-size: 0.8125rem;
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #374151;
        transition: color .12s;
    }
    .dark .smv-nav-label { color: #d1d5db; }
    .smv-nav.is-active .smv-nav-label { color: #2563eb; }
    .dark .smv-nav.is-active .smv-nav-label { color: #3b82f6; }

    .smv-nav-arrow {
        width: 0.75rem; height: 0.75rem;
        color: #d1d5db;
        flex-shrink: 0;
        transition: color .12s;
    }
    .dark .smv-nav-arrow { color: #4b5563; }
    .smv-nav.is-active .smv-nav-arrow { color: #3b82f6; }

    /* ── Right panel ── */
    .smv-right {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
        background: #fff;
    }
    .dark .smv-right { background: #111827; }

    /* ── Empty state ── */
    .smv-empty {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 3rem;
        color: #d1d5db;
    }
    .dark .smv-empty { color: #374151; }
    .smv-empty p { font-size: 0.875rem; color: #9ca3af; }

    /* ── Detail panel ── */
    .smv-detail {
        display: none; /* toggled via JS using style prop */
        flex-direction: column;
        flex: 1;
    }
    .smv-detail-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.125rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .dark .smv-detail-head { border-bottom-color: #1f2937; }
    .smv-detail-title { font-size: 1rem; font-weight: 700; color: #111827; }
    .dark .smv-detail-title { color: #f9fafb; }
    .smv-detail-meta { font-size: 0.75rem; color: #9ca3af; margin-top: 2px; }

    .smv-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.475rem 1rem;
        font-size: 0.8125rem;
        font-weight: 600;
        border-radius: 0.5rem;
        text-decoration: none;
        flex-shrink: 0;
        background: #3b82f6;
        color: #fff !important;
        transition: background .15s;
    }
    .smv-cta:hover { background: #2563eb; }

    .smv-body { flex: 1; padding: 1.125rem 1.5rem; overflow-y: auto; }

    /* ── Sub-menu items (built via JS) ── */
    .smv-section-lbl {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #9ca3af;
        margin-bottom: 0.625rem;
    }
    .smv-child {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 0.75rem;
        padding: 0.625rem 0.875rem;
        margin-bottom: 0.375rem;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: border-color .12s, background .12s;
    }
    .dark .smv-child { background: #1f2937; border-color: #374151; }
    .smv-child:hover { background: #f0fdf9; border-color: #6ee7b7; }
    .dark .smv-child:hover { background: #1e3a8a22; border-color: #3b82f6; }

    .smv-child-icon {
        width: 1.75rem; height: 1.75rem;
        border-radius: 0.375rem;
        background: #e5e7eb;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .dark .smv-child-icon { background: #374151; }
    .smv-child-name { flex: 1; font-size: 0.875rem; font-weight: 500; color: #374151; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .dark .smv-child-name { color: #d1d5db; }
    .smv-badge {
        font-size: 0.65rem; font-weight: 600;
        padding: 0.1rem 0.45rem;
        border-radius: 999px;
        background: #e5e7eb; color: #6b7280;
        border: 1px solid #d1d5db;
        white-space: nowrap; flex-shrink: 0;
    }
    .dark .smv-badge { background: #374151; color: #9ca3af; border-color: #4b5563; }
    .smv-ch-arrow { width: .8rem; height: .8rem; color: #9ca3af; flex-shrink: 0; }

    .smv-grand-wrap { margin-left: 1rem; padding-left: 0.75rem; border-left: 2px solid #e5e7eb; margin-bottom: 0.5rem; }
    .dark .smv-grand-wrap { border-left-color: #374151; }
    .smv-grand {
        display: flex; flex-direction: row; align-items: center; gap: 0.625rem;
        padding: 0.4rem 0.625rem; border-radius: 0.375rem;
        text-decoration: none; transition: background .12s; margin-bottom: 2px;
    }
    .smv-grand:hover { background: #f3f4f6; }
    .dark .smv-grand:hover { background: #1f2937; }
    .smv-grand-dot { width: 5px; height: 5px; background: #d1d5db; border-radius: 50%; flex-shrink: 0; }
    .dark .smv-grand-dot { background: #4b5563; }
    .smv-grand-name { flex: 1; font-size: 0.8rem; color: #6b7280; }
    .dark .smv-grand-name { color: #9ca3af; }
    .smv-grand-badge { font-size: 0.6rem; color: #9ca3af; white-space: nowrap; }

    /* ── Level 4 (Great-grand-children) ── */
    .smv-ggrand-wrap { margin-left: 1rem; padding-left: 0.5rem; border-left: 1px dashed #e5e7eb; margin-bottom: 0.25rem; }
    .dark .smv-ggrand-wrap { border-left-color: #374151; }
    .smv-ggrand {
        display: flex; flex-direction: row; align-items: center; gap: 0.5rem;
        padding: 0.3rem 0.5rem; border-radius: 0.25rem;
        text-decoration: none; transition: background .12s; margin-bottom: 1px;
    }
    .smv-ggrand:hover { background: #f3f4f6; }
    .dark .smv-ggrand:hover { background: #1f2937; }
    .smv-ggrand-dash { width: 4px; height: 1px; background: #d1d5db; flex-shrink: 0; }
    .dark .smv-ggrand-dash { background: #4b5563; }
    .smv-ggrand-name { flex: 1; font-size: 0.75rem; color: #9ca3af; }
    .dark .smv-ggrand-name { color: #6b7280; }
    .smv-ggrand-badge { font-size: 0.55rem; color: #9ca3af; white-space: nowrap; }
    </style>
    @endpush

    <p style="color:#6b7280;font-size:.875rem;margin-bottom:1.25rem;">
        {{ __('Pilih menu dari panel kiri untuk melihat sub-menu dan mengelola halaman terkait.') }}
    </p>

    <div class="smv-shell">

        {{-- LEFT --}}
        <div class="smv-left">
            <div class="smv-left-header">{{ __('Menu Website') }}</div>
            <div class="smv-left-body">
                @foreach($menusData as $menu)
                    <div class="smv-nav"
                        id="smv-nav-{{ $menu['id'] }}"
                        onclick="smvActivate({{ $menu['id'] }}, true)">
                        <div class="smv-nav-dot"></div>
                        <span class="smv-nav-label">{{ $menu['name'] }}</span>
                        @if(count($menu['children']) > 0)
                            <svg class="smv-nav-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="smv-right">

            {{-- Empty state --}}
            <div class="smv-empty" id="smv-empty">
                <svg style="width:2.5rem;height:2.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
                <p>{{ __('← Pilih menu dari kiri untuk melihat detailnya') }}</p>
            </div>

            {{-- Detail --}}
            <div class="smv-detail" id="smv-detail">
                <div class="smv-detail-head">
                    <div>
                        <div class="smv-detail-title" id="smv-title"></div>
                        <div class="smv-detail-meta" id="smv-meta"></div>
                    </div>
                    <a href="#" class="smv-cta" id="smv-cta">
                        <svg style="width:.875rem;height:.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        <span id="smv-cta-text">{{ __('Kelola Halaman') }}</span>
                    </a>
                </div>
                <div class="smv-body" id="smv-body"></div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
    (function () {
        const menus    = @json($menusData);
        const editBase = @json($editBaseUrl);
        const selectBase = @json($selectBaseUrl);

        // Translations for dynamic JS content
        const lang = {
            adaHalaman: "{{ __('Sudah ada Halaman') }}",
            belumAdaHalaman: "{{ __('Belum ada Halaman') }}",
            subMenu: "{{ __('sub-menu') }}",
            noSubMenu: "{{ __('Tidak ada sub-menu.') }}",
            sub: "{{ __('sub') }}",
            lblSubMenu: "{{ __('Sub-Menu') }}",
            btnEdit: "{{ __('Edit Halaman Dinamis') }}",
            btnCreate: "{{ __('Buat Halaman Dinamis') }}"
        };

        function urlChild(id) { 
            // Child links can just use javascript scroll or click to activate themselves!
            return 'javascript:window.smvActivate(' + id + ', true)'; 
        }
        
        // Find recursive flat list of all menus to quickly locate by id
        const flatMenus = [];
        function flatten(arr) {
            arr.forEach(a => { flatMenus.push(a); flatten(a.children || []); });
        }
        flatten(menus);

        function esc(s)  {
            return String(s)
                .replace(/&/g,'&amp;').replace(/</g,'&lt;')
                .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
        }

        window.smvToggle = function(id, ev) {
            ev.preventDefault();
            ev.stopPropagation();
            var wrap = document.getElementById('smv-wrap-' + id);
            var arr  = document.getElementById('smv-arr-' + id);
            if (!wrap) return;
            if (wrap.style.display === 'none') {
                wrap.style.display = 'block';
                if (arr) arr.style.transform = 'rotate(90deg)';
            } else {
                wrap.style.display = 'none';
                if (arr) arr.style.transform = 'rotate(0deg)';
            }
        };

        window.smvActivate = function (id, isClick = true) {
            const menu = flatMenus.find(m => m.id === id);
            if (!menu) return;

            /* Auto-redirect for leaf nodes (no sub-menus) *only* if triggered by manual click */
            if (isClick && (!menu.children || menu.children.length === 0)) {
                if (menu.page_id) {
                    window.location.href = editBase + '/' + menu.page_id + '/edit';
                } else {
                    window.location.href = selectBase + '?menu_id=' + menu.id + '&menu_name=' + encodeURIComponent(menu.name);
                }
                return;
            }

            /* Active nav highlight */
            document.querySelectorAll('.smv-nav').forEach(el => el.classList.remove('is-active'));
            const nav = document.getElementById('smv-nav-' + id);
            if (nav) nav.classList.add('is-active');

            /* Show detail panel */
            document.getElementById('smv-empty').style.display  = 'none';
            document.getElementById('smv-detail').style.display = 'flex';

            document.getElementById('smv-title').textContent = menu.name;
            
            let statusText = menu.page_id ? lang.adaHalaman : lang.belumAdaHalaman;
            let subCount = (menu.children && menu.children.length) ? menu.children.length : 0;
            
            document.getElementById('smv-meta').textContent  =
                statusText + ' · ' + subCount + ' ' + lang.subMenu;
            
            // Generate exact 1-to-1 URL depending on whether page exists
            if (menu.page_id) {
                document.getElementById('smv-cta').href = editBase + '/' + menu.page_id + '/edit';
                document.getElementById('smv-cta-text').textContent = lang.btnEdit;
            } else {
                document.getElementById('smv-cta').href = selectBase + '?menu_id=' + menu.id + '&menu_name=' + encodeURIComponent(menu.name);
                document.getElementById('smv-cta-text').textContent = lang.btnCreate;
            }

            /* Build child list */
            const body = document.getElementById('smv-body');
            if (!menu.children || !menu.children.length) {
                body.innerHTML = '<p style="font-size:.875rem;color:#9ca3af;padding:.5rem 0;">' + lang.noSubMenu + '</p>';
                return;
            }

            var html = '<div class="smv-section-lbl">' + lang.lblSubMenu + '</div>';
            menu.children.forEach(function (c) {
                var badge = c.page_id
                    ? '<span class="smv-badge" style="background:#dbeafe;color:#065f46;border-color:#a7f3d0;">✓ Halaman</span>' 
                    : '<span class="smv-badge">-</span>';
                var sub = c.children.length
                    ? '<span style="font-size:.68rem;color:#9ca3af;white-space:nowrap;margin-right:.25rem;">'
                      + c.children.length + ' ' + lang.sub + '</span>' : '';

                var toggleBtn = c.children.length
                    ? '<div onclick="smvToggle(' + c.id + ', event)" style="width:1.75rem;height:1.75rem;display:flex;align-items:center;justify-content:center;cursor:pointer;border-radius:.375rem;margin-left:-.25rem;"><svg id="smv-arr-' + c.id + '" style="width:1.1rem;height:1.1rem;transition:transform .2s;" class="smv-ch-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></div>'
                    : '<div style="width:1.75rem;height:1.75rem;display:flex;align-items:center;justify-content:center;margin-left:-.25rem;"><div style="width:4px;height:4px;border-radius:50%;" class="smv-grand-dot"></div></div>';

                html += '<div class="smv-child" style="padding-left:.5rem;">'
                    + toggleBtn
                    + '<div class="smv-child-icon">'
                    + '<svg style="width:.8rem;height:.8rem;color:#9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">'
                    + '<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>'
                    + '</svg></div>'
                    + '<a href="' + urlChild(c.id) + '" style="flex:1;text-decoration:none;" class="smv-child-name">' + esc(c.name) + '</a>'
                    + '<a href="' + urlChild(c.id) + '" style="text-decoration:none;display:flex;align-items:center;">' + sub + badge + '<svg class="smv-ch-arrow" style="margin-left:.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>'
                    + '</div>';

                if (c.children.length) {
                    html += '<div id="smv-wrap-' + c.id + '" class="smv-grand-wrap" style="display:none;">';
                    c.children.forEach(function (g) {
                        var gb = g.page_id ? '<span class="smv-grand-badge" style="color:#2563eb;">✓ Halaman</span>' : '';
                        
                        var toggleG = g.children.length
                            ? '<div onclick="smvToggle(' + g.id + ', event)" style="width:1.5rem;height:1.5rem;display:flex;align-items:center;justify-content:center;cursor:pointer;border-radius:.375rem;margin-left:-.25rem;"><svg id="smv-arr-' + g.id + '" style="width:.9rem;height:.9rem;transition:transform .2s;" class="smv-ch-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></div>'
                            : '<div class="smv-grand-dot" style="margin-right:.5rem;"></div>';

                        html += '<div class="smv-grand">'
                            + toggleG
                            + '<a href="' + urlChild(g.id) + '" style="flex:1;text-decoration:none;" class="smv-grand-name">' + esc(g.name) + '</a>'
                            + '<a href="' + urlChild(g.id) + '" style="text-decoration:none;display:flex;align-items:center;">' + gb + '<svg style="width:.7rem;height:.7rem;color:#9ca3af;margin-left:.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>'
                            + '</div>';

                        /* Level 4 */
                        if (g.children && g.children.length) {
                            html += '<div id="smv-wrap-' + g.id + '" class="smv-ggrand-wrap" style="display:none;">';
                            g.children.forEach(function (gg) {
                                var ggb = gg.page_id ? '<span class="smv-ggrand-badge" style="color:#2563eb;">✓</span>' : '';
                                html += '<a href="' + urlChild(gg.id) + '" class="smv-ggrand">'
                                    + '<div class="smv-ggrand-dash"></div>'
                                    + '<span class="smv-ggrand-name">' + esc(gg.name) + '</span>'
                                    + ggb
                                    + '<svg style="width:.6rem;height:.6rem;color:#9ca3af;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">'
                                    + '<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>'
                                    + '</a>';
                            });
                            html += '</div>';
                        }
                    });
                    html += '</div>';
                }
            });

            body.innerHTML = html;
        };


        // Auto-activate if active_id is in URL
        const urlParams = new URLSearchParams(window.location.search);
        const activeId = urlParams.get('active_id');
        if (activeId) {
            window.smvActivate(parseInt(activeId), false);
        }
    })();
    </script>
    @endpush

</div>
</x-filament-panels::page>
