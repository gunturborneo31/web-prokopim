<div x-data="{ open: false }" class="relative" style="display: flex; align-items: center;">
    <button 
        @click="open = !open" 
        @click.away="open = false"
        type="button"
        class="lang-trigger"
    >
        <x-heroicon-o-language style="width: 20px; height: 20px;" />
        <span class="lang-code">{{ app()->getLocale() }}</span>
        <x-heroicon-m-chevron-down class="chevron" ::class="open ? 'rotate' : ''" style="width: 12px; height: 12px;" />
    </button>

    <div 
        x-show="open" 
        x-transition
        class="lang-dropdown"
        style="display: none;"
    >
        <div class="dropdown-header">{{ __('Pilih Bahasa') }}</div>
        <div class="dropdown-list custom-scrollbar">
            @foreach(config('languages.supported') as $locale => $label)
                <a 
                    href="{{ route('language.switch', ['locale' => $locale]) }}"
                    class="lang-item {{ app()->getLocale() === $locale ? 'active' : '' }}"
                >
                    <span class="dot"></span>
                    <span class="label">{{ $label }}</span>
                    @if(app()->getLocale() === $locale)
                        <x-heroicon-s-check-circle style="width: 18px; height: 18px; color: white;" />
                    @endif
                </a>
            @endforeach
        </div>
    </div>

    <style>
        .lang-trigger {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 10px;
            transition: all 0.2s;
            cursor: pointer;
            color: #64748b;
            background: rgba(0,0,0,0.03);
            border: 1px solid transparent;
        }
        .dark .lang-trigger {
            color: #94a3b8;
            background: rgba(255,255,255,0.05);
        }
        .lang-trigger:hover {
            background: rgba(0,0,0,0.06);
            color: #2563eb;
        }
        .dark .lang-trigger:hover {
            background: rgba(255,255,255,0.08);
            color: #60a5fa;
        }
        .lang-code {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .chevron { transition: transform 0.2s; }
        .chevron.rotate { transform: rotate(180deg); }

        .lang-dropdown {
            position: absolute;
            right: 0;
            top: 130%;
            width: 240px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.2);
            border: 1px solid #e2e8f0;
            padding: 8px;
            z-index: 9999;
        }
        .dark .lang-dropdown {
            background: #1e293b;
            border-color: #334155;
            box-shadow: 0 20px 50px -12px rgba(0,0,0,0.5);
        }
        .dropdown-header {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94a3b8;
            padding: 8px 12px 4px;
        }
        .dropdown-list {
            max-height: 320px;
            overflow-y: auto;
            margin-top: 4px;
        }
        .lang-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            color: #475569;
            text-decoration: none !important;
            transition: all 0.2s;
            margin-bottom: 2px;
        }
        .dark .lang-item { color: #cbd5e1; }
        .lang-item:hover { background: #f1f5f9; color: #2563eb; }
        .dark .lang-item:hover { background: rgba(255,255,255,0.05); color: #60a5fa; }
        
        .lang-item.active {
            background: #2563eb;
            color: white !important;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #cbd5e1;
            transition: background 0.2s;
        }
        .lang-item.active .dot { background: white; }
        .lang-item:hover:not(.active) .dot { background: #2563eb; }
        .label { flex-grow: 1; }

        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; }
    </style>
</div>

