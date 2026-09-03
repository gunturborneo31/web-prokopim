{{-- SVG Miniature Previews — light-colored so they look like paper mockups in both light AND dark mode --}}

@php
$svgs = [
    'penjelasan_1' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#3b82f6"/>
        <rect x="12" y="22" width="50" height="4" rx="2" fill="#cbd5e1"/>
        <rect x="12" y="36" width="176" height="76" rx="4" fill="#f1f5f9"/>
        <rect x="20" y="48" width="100" height="5" rx="2" fill="#94a3b8"/>
        <rect x="20" y="58" width="148" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="20" y="65" width="140" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="20" y="72" width="130" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="20" y="82" width="148" height="3" rx="2" fill="#e2e8f0"/>
        <rect x="20" y="89" width="120" height="3" rx="2" fill="#e2e8f0"/>
    </svg>',

    'penjelasan_2' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#3b82f6"/>
        <rect x="12" y="22" width="50" height="4" rx="2" fill="#cbd5e1"/>
        <rect x="12" y="36" width="84" height="76" rx="4" fill="#f1f5f9"/>
        <rect x="104" y="36" width="84" height="76" rx="4" fill="#f1f5f9"/>
        <rect x="20" y="46" width="60" height="4" rx="2" fill="#94a3b8"/>
        <rect x="20" y="54" width="68" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="20" y="61" width="60" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="20" y="68" width="64" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="20" y="78" width="68" height="3" rx="2" fill="#e2e8f0"/>
        <rect x="20" y="85" width="55" height="3" rx="2" fill="#e2e8f0"/>
        <rect x="112" y="46" width="60" height="4" rx="2" fill="#94a3b8"/>
        <rect x="112" y="54" width="68" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="112" y="61" width="60" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="112" y="68" width="64" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="112" y="78" width="68" height="3" rx="2" fill="#e2e8f0"/>
        <rect x="112" y="85" width="55" height="3" rx="2" fill="#e2e8f0"/>
    </svg>',

    'aparatur' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#3b82f6"/>
        <circle cx="46" cy="68" r="20" fill="#dbeafe" stroke="#3b82f6" stroke-width="1.5"/>
        <circle cx="100" cy="68" r="20" fill="#dbeafe" stroke="#3b82f6" stroke-width="1.5"/>
        <circle cx="154" cy="68" r="20" fill="#dbeafe" stroke="#3b82f6" stroke-width="1.5"/>
        <rect x="28" y="94" width="36" height="4" rx="2" fill="#94a3b8"/>
        <rect x="32" y="102" width="28" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="82" y="94" width="36" height="4" rx="2" fill="#94a3b8"/>
        <rect x="86" y="102" width="28" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="136" y="94" width="36" height="4" rx="2" fill="#94a3b8"/>
        <rect x="140" y="102" width="28" height="3" rx="2" fill="#cbd5e1"/>
    </svg>',

    'profil_pimpinan' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#6366f1"/>
        <circle cx="40" cy="60" r="18" fill="#e0e7ff" stroke="#6366f1" stroke-width="1.5"/>
        <rect x="68" y="48" width="120" height="5" rx="2" fill="#6b7280"/>
        <rect x="68" y="58" width="100" height="3" rx="2" fill="#d1d5db"/>
        <rect x="68" y="65" width="90" height="3" rx="2" fill="#d1d5db"/>
        <rect x="12" y="88" width="176" height="3" rx="2" fill="#e5e7eb"/>
        <rect x="12" y="96" width="160" height="3" rx="2" fill="#e5e7eb"/>
        <rect x="12" y="104" width="140" height="3" rx="2" fill="#e5e7eb"/>
    </svg>',

    'gambar_1' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="176" height="72" rx="6" fill="#fce7f3"/>
        <rect x="12" y="12" width="176" height="72" rx="6" fill="url(#img_grad)" opacity="0.6"/>
        <defs>
            <linearGradient id="img_grad" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="#f9a8d4"/>
                <stop offset="100%" stop-color="#ec4899"/>
            </linearGradient>
        </defs>
        <circle cx="86" cy="48" r="16" fill="#fbcfe8" opacity="0.8"/>
        <rect x="12" y="92" width="120" height="6" rx="3" fill="#94a3b8"/>
        <rect x="12" y="103" width="160" height="4" rx="2" fill="#cbd5e1"/>
        <rect x="12" y="111" width="140" height="4" rx="2" fill="#cbd5e1"/>
    </svg>',

    'galeri' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#f59e0b"/>
        <rect x="12" y="30" width="56" height="42" rx="4" fill="#fef3c7" stroke="#fcd34d" stroke-width="1"/>
        <rect x="76" y="30" width="56" height="42" rx="4" fill="#ede9fe" stroke="#a78bfa" stroke-width="1"/>
        <rect x="140" y="30" width="48" height="42" rx="4" fill="#dcfce7" stroke="#6ee7b7" stroke-width="1"/>
        <rect x="12" y="80" width="56" height="36" rx="4" fill="#fee2e2" stroke="#fca5a5" stroke-width="1"/>
        <rect x="76" y="80" width="56" height="36" rx="4" fill="#fce7f3" stroke="#f9a8d4" stroke-width="1"/>
        <rect x="140" y="80" width="48" height="36" rx="4" fill="#dbeafe" stroke="#93c5fd" stroke-width="1"/>
    </svg>',

    'dokumen_grid' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#6b7280"/>
        <rect x="12" y="30" width="84" height="40" rx="4" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="104" y="30" width="84" height="40" rx="4" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="20" y="40" width="40" height="4" rx="2" fill="#94a3b8"/>
        <rect x="20" y="48" width="60" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="20" y="54" width="50" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="112" y="40" width="40" height="4" rx="2" fill="#94a3b8"/>
        <rect x="112" y="48" width="60" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="112" y="54" width="50" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="12" y="78" width="84" height="40" rx="4" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="104" y="78" width="84" height="40" rx="4" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="1"/>
    </svg>',

    'dokumen_list' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#6b7280"/>
        <rect x="12" y="28" width="176" height="20" rx="3" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="20" y="34" width="80" height="4" rx="2" fill="#475569"/>
        <rect x="148" y="32" width="30" height="8" rx="3" fill="#e2e8f0"/>
        <rect x="12" y="54" width="176" height="20" rx="3" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="20" y="60" width="80" height="4" rx="2" fill="#475569"/>
        <rect x="148" y="58" width="30" height="8" rx="3" fill="#e2e8f0"/>
        <rect x="12" y="80" width="176" height="20" rx="3" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="20" y="86" width="80" height="4" rx="2" fill="#475569"/>
        <rect x="148" y="84" width="30" height="8" rx="3" fill="#e2e8f0"/>
        <rect x="12" y="106" width="176" height="18" rx="3" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="1"/>
    </svg>',

    'tabel' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#8b5cf6"/>
        <rect x="12" y="28" width="176" height="14" rx="3" fill="#ede9fe"/>
        <rect x="20" y="32" width="40" height="4" rx="2" fill="#7c3aed"/>
        <rect x="80" y="32" width="40" height="4" rx="2" fill="#7c3aed"/>
        <rect x="140" y="32" width="40" height="4" rx="2" fill="#7c3aed"/>
        <rect x="12" y="46" width="176" height="14" rx="3" fill="#f8fafc"/>
        <rect x="20" y="50" width="40" height="4" rx="2" fill="#94a3b8"/>
        <rect x="80" y="50" width="40" height="4" rx="2" fill="#94a3b8"/>
        <rect x="140" y="50" width="40" height="4" rx="2" fill="#94a3b8"/>
        <rect x="12" y="64" width="176" height="14" rx="3" fill="#f1f5f9"/>
        <rect x="20" y="68" width="40" height="4" rx="2" fill="#94a3b8"/>
        <rect x="80" y="68" width="40" height="4" rx="2" fill="#94a3b8"/>
        <rect x="140" y="68" width="40" height="4" rx="2" fill="#94a3b8"/>
        <rect x="12" y="82" width="176" height="14" rx="3" fill="#f8fafc"/>
        <rect x="12" y="100" width="176" height="14" rx="3" fill="#f1f5f9"/>
    </svg>',

    'blank_editor' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="80" height="6" rx="3" fill="#94a3b8"/>
        <rect x="12" y="30" width="176" height="4" rx="2" fill="#e2e8f0"/>
        <rect x="12" y="40" width="160" height="3" rx="2" fill="#f1f5f9"/>
        <rect x="12" y="48" width="170" height="3" rx="2" fill="#f1f5f9"/>
        <rect x="12" y="56" width="140" height="3" rx="2" fill="#f1f5f9"/>
        <rect x="12" y="68" width="176" height="4" rx="2" fill="#e2e8f0"/>
        <rect x="12" y="78" width="165" height="3" rx="2" fill="#f1f5f9"/>
        <rect x="12" y="86" width="155" height="3" rx="2" fill="#f1f5f9"/>
        <rect x="12" y="94" width="170" height="3" rx="2" fill="#f1f5f9"/>
        <rect x="12" y="106" width="176" height="4" rx="2" fill="#e2e8f0"/>
    </svg>',

    'berita' => '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full">
        <rect width="200" height="130" fill="#f8fafc" rx="4"/>
        <rect x="12" y="12" width="176" height="20" rx="6" fill="#fce7f3"/>
        <rect x="20" y="18" width="60" height="8" rx="3" fill="#ec4899"/>
        <rect x="12" y="42" width="56" height="70" rx="4" fill="#f8fafc" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="76" y="42" width="56" height="70" rx="4" fill="#f8fafc" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="140" y="42" width="48" height="70" rx="4" fill="#f8fafc" stroke="#e2e8f0" stroke-width="1"/>
        <rect x="16" y="46" width="48" height="28" rx="2" fill="#f1f5f9"/>
        <rect x="16" y="80" width="40" height="4" rx="2" fill="#6b7280"/>
        <rect x="16" y="88" width="48" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="80" y="46" width="48" height="28" rx="2" fill="#f1f5f9"/>
        <rect x="80" y="80" width="40" height="4" rx="2" fill="#6b7280"/>
        <rect x="80" y="88" width="48" height="3" rx="2" fill="#cbd5e1"/>
        <rect x="144" y="46" width="40" height="28" rx="2" fill="#f1f5f9"/>
        <rect x="144" y="80" width="32" height="4" rx="2" fill="#6b7280"/>
        <rect x="144" y="88" width="40" height="3" rx="2" fill="#cbd5e1"/>
    </svg>',
];
@endphp

{!! $svgs[$key] ?? '<svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" class="w-full"><rect width="200" height="130" fill="#f1f5f9" rx="4"/></svg>' !!}
