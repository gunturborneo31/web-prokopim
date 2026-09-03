<?php

return [
    'menus' => [
        [
            'route' => 'beranda',
            'icon' => 'home',
            'label' => 'Beranda',
        ],
        [
            'route' => 'profil.visi-misi',
            'icon' => 'badge',
            'label' => 'Profil',
            'active_routes' => ['profil.*'],
            'dropdown' => [
                ['url' => '/halaman/sejarah-mahulu', 'label' => 'Sejarah Mahulu', 'icon' => 'history_edu'],
                ['url' => '/halaman/kondisi-geografis', 'label' => 'Kondisi Geografis', 'icon' => 'public'],
                ['url' => '/halaman/lambang-daerah', 'label' => 'Lambang Daerah', 'icon' => 'shield'],
                ['route' => 'profil.pimpinan', 'label' => 'Profil Pimpinan', 'icon' => 'groups'],
                ['route' => 'profil.motto', 'label' => 'Kata Pengantar', 'icon' => 'edit_note'],
                ['route' => 'profil.visi-misi', 'label' => 'Visi dan Misi', 'icon' => 'flag'],
                ['route' => 'profil.tujuan-sasaran', 'label' => 'Tujuan dan Sasaran', 'icon' => 'target'],
                ['route' => 'profil.tupoksi', 'label' => 'Tugas Pokok dan Fungsi', 'icon' => 'task'],
                ['route' => 'profil.struktur', 'label' => 'Struktur Organisasi', 'icon' => 'account_tree'],
            ],
        ],
        [
            'route' => 'berita.index',
            'icon' => 'newspaper',
            'label' => 'Informasi',
            'active_routes' => ['berita.*'],
            'dropdown' => [
                ['route' => 'berita.index', 'label' => 'Berita', 'icon' => 'article'],
                ['url' => '/halaman/pengumuman', 'label' => 'Pengumuman', 'icon' => 'campaign'],
            ],
        ],
        [
            'route' => 'regulasi.peraturan-bupati',
            'icon' => 'gavel',
            'label' => 'Regulasi',
            'active_routes' => ['regulasi.*'],
            'dropdown' => [
                ['route' => 'regulasi.undang-undang', 'label' => 'Undang-Undang', 'icon' => 'gavel'],
                ['route' => 'regulasi.peraturan-menteri', 'label' => 'Peraturan Menteri', 'icon' => 'inventory_2'],
                ['route' => 'regulasi.peraturan-daerah', 'label' => 'Peraturan Daerah', 'icon' => 'description'],
                ['route' => 'regulasi.peraturan-bupati', 'label' => 'Peraturan Bupati', 'icon' => 'gavel'],
                ['route' => 'regulasi.sk-bupati', 'label' => 'SK Bupati', 'icon' => 'verified'],
            ],
        ],
        [
            'route' => 'ppid.index',
            'icon' => 'contact_page',
            'label' => 'PPID',
            'active_routes' => ['ppid.*'],
            'dropdown' => [
                ['route' => 'ppid.index', 'label' => 'Beranda PPID', 'icon' => 'home'],
                ['route' => 'ppid.informasi', 'label' => 'Informasi', 'icon' => 'info'],
                ['route' => 'ppid.permohonan', 'label' => 'Permohonan', 'icon' => 'assignment'],
            ],
        ],
        [
            'route' => 'layanan.pengaduan',
            'icon' => 'support_agent',
            'label' => 'Layanan',
            'active_routes' => ['layanan.*', 'egov'],
            'dropdown' => [
                ['url' => '/halaman/keprotokolan', 'label' => 'Keprotokolan', 'icon' => 'shield'],
                ['url' => '/halaman/kopim', 'label' => 'Kopim', 'icon' => 'campaign'],
                ['url' => '/halaman/dokpim', 'label' => 'Dokpim', 'icon' => 'description'],
                ['route' => 'layanan.pengaduan', 'label' => 'Pengaduan', 'icon' => 'campaign'],
                ['route' => 'layanan.cek-status', 'label' => 'Cek Status', 'icon' => 'search'],
                ['route' => 'egov', 'label' => 'e-Gov', 'icon' => 'public'],
            ],
        ],
    ],
];
