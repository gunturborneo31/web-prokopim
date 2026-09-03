<x-layouts.app>
    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-80">
                <img src="{{ asset('images/batucermin.jpg') }}" alt="PPID" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="" class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
    
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="ppSS" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#10192d" stop-opacity="0"/><stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/><stop offset="100%" stop-color="#10192d" stop-opacity="0"/></linearGradient></defs><path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#ppSS)" stroke-width="2"/></svg>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#274CA5] opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-[#9ae600]"></span></div>PPID
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">Informasi <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">Setiap Saat</span></h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">Informasi yang harus disediakan oleh Badan Publik dan siap tersedia untuk bisa langsung diberikan kepada pemohon informasi publik ketika terdapat permohonan.</p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a><span>/</span><span>PPID</span><span>/</span><span class="text-[#274CA5]">Informasi Setiap Saat</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface"><path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/></svg></div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @include('pages.ppid._sidebar')
            <main class="lg:col-span-3" data-aos="fade-up">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-[#274CA5] flex items-center gap-3">
                            <span class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></span>
                            Informasi Setiap Saat
                        </h2>
                        <p class="text-slate-500 text-sm mt-1 ml-[52px]">Informasi yang wajib tersedia setiap saat</p>
                    </div>
                </div>

                {{-- â•â•â• ACCORDION INFORMASI SETIAP SAAT â•â•â• --}}
                @php
                $ppidCategory = 'setiap_saat';
                $accordions = [
                    [
                        'id'    => 1,
                        'title' => 'Daftar Informasi Publik (DIP)',
                        'rows'  => [
                            ['key' => 'ppid_ss_dip_2025', 'no' => 1, 'judul' => 'Daftar Informasi Publik PROKOPIM Kab. Mahakam Ulu Tahun 2025', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/dip-2025.pdf'],
                            ['key' => 'ppid_ss_dip_2024', 'no' => 2, 'judul' => 'Daftar Informasi Publik PROKOPIM Kab. Mahakam Ulu Tahun 2024', 'tahun' => '2024', 'format' => 'PDF', 'file' => 'documents/ppid/dip-2024.pdf'],
                            ['key' => 'ppid_ss_dikecualikan', 'no' => 3, 'judul' => 'Daftar Informasi Dikecualikan PROKOPIM Kab. Mahakam Ulu', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/dip-dikecualikan.pdf'],
                        ],
                    ],
                    [
                        'id'    => 2,
                        'title' => 'Profil, Tugas Pokok, dan Struktur Organisasi',
                        'rows'  => [
                            ['key' => 'ppid_ss_profil', 'no' => 1, 'judul' => 'Profil PROKOPIM Kabupaten Mahakam Ulu', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/profil.pdf'],
                            ['key' => 'ppid_ss_struktur', 'no' => 2, 'judul' => 'Struktur Organisasi PROKOPIM Kab. Mahakam Ulu', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/struktur.pdf'],
                            ['key' => 'ppid_ss_tupoksi', 'no' => 3, 'judul' => 'Tugas Pokok dan Fungsi (Tupoksi) PROKOPIM', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/tupoksi.pdf'],
                            ['key' => 'ppid_ss_pejabat', 'no' => 4, 'judul' => 'Daftar Pejabat Struktural PROKOPIM', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/pejabat.pdf'],
                        ],
                    ],
                    [
                        'id'    => 3,
                        'title' => 'Dokumen Perencanaan dan Kinerja',
                        'rows'  => [
                            ['key' => 'ppid_ss_renstra', 'no' => 1, 'judul' => 'Rencana Strategis (RENSTRA) PROKOPIM 2021â€“2026', 'tahun' => '2021', 'format' => 'PDF', 'file' => 'documents/ppid/renstra-2021-2026.pdf'],
                            ['key' => 'ppid_ss_renja_2025', 'no' => 2, 'judul' => 'Rencana Kerja (RENJA) PROKOPIM Tahun 2025', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/renja-2025.pdf'],
                            ['key' => 'ppid_ss_renja_2024', 'no' => 3, 'judul' => 'Rencana Kerja (RENJA) PROKOPIM Tahun 2024', 'tahun' => '2024', 'format' => 'PDF', 'file' => 'documents/ppid/renja-2024.pdf'],
                            ['key' => 'ppid_ss_pk_2025', 'no' => 4, 'judul' => 'Perjanjian Kinerja (PK) PROKOPIM Tahun 2025', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/pk-2025.pdf'],
                            ['key' => 'ppid_ss_lkjip_2024', 'no' => 5, 'judul' => 'Laporan Kinerja Instansi Pemerintah (LKjIP) Tahun 2024', 'tahun' => '2024', 'format' => 'PDF', 'file' => 'documents/ppid/lkjip-2024.pdf'],
                            ['key' => 'ppid_ss_lkjip_2023', 'no' => 6, 'judul' => 'Laporan Kinerja Instansi Pemerintah (LKjIP) Tahun 2023', 'tahun' => '2023', 'format' => 'PDF', 'file' => 'documents/ppid/lkjip-2023.pdf'],
                        ],
                    ],
                    [
                        'id'    => 4,
                        'title' => 'Dokumen Anggaran dan Keuangan',
                        'rows'  => [
                            ['key' => 'ppid_ss_dpa_2025', 'no' => 1, 'judul' => 'Dokumen Pelaksanaan Anggaran (DPA) PROKOPIM Tahun 2025', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/dpa-2025.pdf'],
                            ['key' => 'ppid_ss_dpa_2024', 'no' => 2, 'judul' => 'Dokumen Pelaksanaan Anggaran (DPA) PROKOPIM Tahun 2024', 'tahun' => '2024', 'format' => 'PDF', 'file' => 'documents/ppid/dpa-2024.pdf'],
                            ['key' => 'ppid_ss_keu_2024', 'no' => 3, 'judul' => 'Laporan Keuangan PROKOPIM Tahun 2024', 'tahun' => '2024', 'format' => 'PDF', 'file' => 'documents/ppid/keuangan-2024.pdf'],
                            ['key' => 'ppid_ss_keu_2023', 'no' => 4, 'judul' => 'Laporan Keuangan PROKOPIM Tahun 2023', 'tahun' => '2023', 'format' => 'PDF', 'file' => 'documents/ppid/keuangan-2023.pdf'],
                        ],
                    ],
                    [
                        'id'    => 5,
                        'title' => 'Peraturan, Keputusan, dan Kebijakan',
                        'rows'  => [
                            ['key' => 'ppid_ss_sk_ppid', 'no' => 1, 'judul' => 'SK Kepala PROKOPIM tentang Penunjukan PPID', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/sk-ppid.pdf'],
                            ['key' => 'ppid_ss_sk_tim', 'no' => 2, 'judul' => 'SK Tim Pertimbangan Pelayanan Informasi Publik', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/sk-tim.pdf'],
                            ['key' => 'ppid_ss_perbup', 'no' => 3, 'judul' => 'Peraturan Bupati tentang Keterbukaan Informasi Publik', 'tahun' => '2024', 'format' => 'PDF', 'file' => 'documents/ppid/perbup-kip.pdf'],
                            ['key' => 'ppid_ss_sop', 'no' => 4, 'judul' => 'SOP Layanan Informasi Publik PROKOPIM', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/sop.pdf'],
                        ],
                    ],
                    [
                        'id'    => 6,
                        'title' => 'Pengadaan Barang dan Jasa',
                        'rows'  => [
                            ['key' => 'ppid_ss_rup_2025', 'no' => 1, 'judul' => 'Rencana Umum Pengadaan (RUP) PROKOPIM Tahun 2025', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/rup-2025.pdf'],
                            ['key' => 'ppid_ss_rup_2024', 'no' => 2, 'judul' => 'Rencana Umum Pengadaan (RUP) PROKOPIM Tahun 2024', 'tahun' => '2024', 'format' => 'PDF', 'file' => 'documents/ppid/rup-2024.pdf'],
                            ['key' => 'ppid_ss_lelang_2025', 'no' => 3, 'judul' => 'Daftar Paket Pengadaan Barang/Jasa yang Dilelang Tahun 2025', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/lelang-2025.pdf'],
                        ],
                    ],
                    [
                        'id'    => 7,
                        'title' => 'Hak dan Tata Cara Memperoleh Informasi',
                        'rows'  => [
                            ['key' => 'ppid_ss_panduan', 'no' => 1, 'judul' => 'Panduan Permohonan Informasi Publik', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/panduan.pdf'],
                            ['key' => 'ppid_ss_alur_keberatan', 'no' => 2, 'judul' => 'Alur Pengajuan Keberatan atas Penolakan Informasi', 'tahun' => '2025', 'format' => 'PDF', 'file' => 'documents/ppid/alur-keberatan.pdf'],
                            ['key' => 'ppid_ss_form_permohonan', 'no' => 3, 'judul' => 'Formulir Permohonan Informasi Publik', 'tahun' => '2025', 'format' => 'DOCX', 'file' => 'documents/ppid/form-permohonan.docx'],
                            ['key' => 'ppid_ss_form_keberatan', 'no' => 4, 'judul' => 'Formulir Keberatan Informasi Publik', 'tahun' => '2025', 'format' => 'DOCX', 'file' => 'documents/ppid/form-keberatan.docx'],
                        ],
                    ],
                ];

                // Global Stats for this page
                $allKeys = collect($accordions)->flatMap(fn($a) => collect($a['rows'])->pluck('key'))->filter()->toArray();
                $statsMap = \App\Models\DocumentStat::whereIn('doc_key', $allKeys)->get()->keyBy('doc_key');
                @endphp

                <div class="space-y-3" x-data="{ open: null }">
                    @foreach($accordions as $acc)
                    <div
                        class="border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-shadow duration-300"
                        x-data="{
                            search: '',
                            perPage: 5,
                            page: 1,
                            allRows: {{ collect($acc['rows'])->map(function($r) use ($statsMap, $ppidCategory) {
                                $s = $statsMap->get($r['key']);
                                return array_merge($r, [
                                    'views' => $s ? $s->views : 0,
                                    'downloads' => $s ? $s->downloads : 0,
                                    'view_url'    => route('stats.view',     ['key' => $r['key'], 'type' => 'ppid', 'category' => $ppidCategory, 'url' => asset($r['file'])]),
                                    'download_url' => route('stats.download', ['key' => $r['key'], 'type' => 'ppid', 'category' => $ppidCategory, 'url' => asset($r['file'])])
                                ]);
                            })->values()->toJson() }},
                            get filtered() {
                                if (!this.search.trim()) return this.allRows;
                                const q = this.search.toLowerCase();
                                return this.allRows.filter(r =>
                                    r.judul.toLowerCase().includes(q) ||
                                    r.tahun.toString().includes(q) ||
                                    r.format.toLowerCase().includes(q)
                                );
                            },
                            get totalPages() { return Math.max(1, Math.ceil(this.filtered.length / this.perPage)); },
                            get paginated() {
                                const start = (this.page - 1) * this.perPage;
                                return this.filtered.slice(start, start + parseInt(this.perPage));
                            },
                            get startRow() { return this.filtered.length === 0 ? 0 : (this.page - 1) * this.perPage + 1; },
                            get endRow() { return Math.min(this.page * this.perPage, this.filtered.length); },
                            incrementView(idx) {
                                const row = this.allRows[idx];
                                window.open(row.view_url, '_blank');
                                row.views++;
                            },
                            incrementDownload(idx) {
                                const row = this.allRows[idx];
                                window.location.href = row.download_url;
                                row.downloads++;
                            },
                        }"
                        x-effect="page = 1"
                    >
                        {{-- Header / Toggle --}}
                        <button
                            type="button"
                            class="w-full flex items-center justify-between px-6 py-4 text-left group focus:outline-none"
                            @click="open === {{ $acc['id'] }} ? open = null : open = {{ $acc['id'] }}"
                        >
                            <span class="font-bold text-[15px] text-[#0f3460] group-hover:text-sky-600 transition-colors leading-snug pr-4">
                                {{ $acc['title'] }}
                            </span>
                            <span class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center border border-slate-200 bg-slate-50 group-hover:bg-sky-50 group-hover:border-sky-200 transition-all duration-300"
                                  :class="open === {{ $acc['id'] }} ? 'bg-sky-100 border-sky-300 rotate-180' : ''">
                                <svg class="w-4 h-4 text-slate-500 transition-transform duration-300" :class="open === {{ $acc['id'] }} ? 'text-sky-600' : ''"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>

                        {{-- Body --}}
                        <div x-show="open === {{ $acc['id'] }}"
                             x-cloak
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2">

                            <div class="border-t border-slate-100 px-4 pb-4 pt-3">

                                {{-- â”€â”€ Toolbar: Search + Per Page â”€â”€ --}}
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                                    {{-- Search --}}
                                    <div class="flex items-center bg-slate-50 rounded-xl border border-slate-200 px-3 py-2 gap-2 focus-within:border-sky-400 focus-within:ring-2 focus-within:ring-sky-100 transition-all flex-1 sm:max-w-[280px]">
                                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                        <input type="text" x-model.debounce.300ms="search" placeholder="Cari dokumen..."
                                               class="bg-transparent border-none outline-none text-sm text-slate-700 placeholder:text-slate-400 w-full" />
                                        <button x-show="search" @click="search=''" class="text-slate-400 hover:text-slate-600">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                    {{-- Per Page --}}
                                    <div class="flex items-center gap-2 text-sm text-slate-500">
                                        <span class="text-xs whitespace-nowrap">Tampilkan</span>
                                        <select x-model="perPage" @change="page=1"
                                                class="border border-slate-200 rounded-lg px-2 py-1.5 text-xs text-slate-700 bg-white focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none cursor-pointer">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">Semua</option>
                                        </select>
                                        <span class="text-xs whitespace-nowrap">data</span>
                                    </div>
                                </div>

                                {{-- â”€â”€ Table â”€â”€ --}}
                                <div class="overflow-x-auto rounded-xl border border-slate-100">
                                    <table class="w-full text-sm min-w-[640px]">
                                        <thead>
                                            <tr class="bg-sky-50">
                                                <th class="px-4 py-3 text-left text-xs font-bold text-sky-700 uppercase tracking-wider w-10">No</th>
                                                <th class="px-4 py-3 text-left text-xs font-bold text-sky-700 uppercase tracking-wider">Judul Dokumen / Informasi</th>
                                                <th class="px-4 py-3 text-center text-xs font-bold text-sky-700 uppercase tracking-wider w-20">Tahun</th>
                                                <th class="px-4 py-3 text-center text-xs font-bold text-sky-700 uppercase tracking-wider w-20">Format</th>
                                                <th class="px-4 py-3 text-center text-xs font-bold text-sky-700 uppercase tracking-wider w-24">
                                                    <div class="flex items-center justify-center gap-1">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                        Dilihat
                                                    </div>
                                                </th>
                                                <th class="px-4 py-3 text-center text-xs font-bold text-sky-700 uppercase tracking-wider w-28">
                                                    <div class="flex items-center justify-center gap-1">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                        Diunduh
                                                    </div>
                                                </th>
                                                <th class="px-4 py-3 text-center text-xs font-bold text-sky-700 uppercase tracking-wider w-36">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            <template x-for="(row, i) in paginated" :key="row.no">
                                                <tr class="hover:bg-blue-50/40 transition-colors">
                                                    <td class="px-4 py-3 text-slate-400 text-xs font-medium text-center" x-text="startRow + i"></td>
                                                    <td class="px-4 py-3 text-slate-700 font-medium text-[13px] leading-snug" x-text="row.judul"></td>
                                                    <td class="px-4 py-3 text-slate-500 text-xs text-center" x-text="row.tahun"></td>
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider"
                                                              :class="row.format === 'PDF' ? 'bg-red-50 text-red-600 border border-red-200' : 'bg-blue-50 text-blue-600 border border-blue-200'"
                                                              x-text="row.format"></span>
                                                    </td>
                                                    {{-- Dilihat --}}
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                            <span x-text="row.views"></span>
                                                        </span>
                                                    </td>
                                                    {{-- Diunduh --}}
                                                    <td class="px-4 py-3 text-center">
                                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-violet-600 bg-violet-50 px-2 py-0.5 rounded-full border border-violet-200">
                                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                            <span x-text="row.downloads"></span>
                                                        </span>
                                                    </td>
                                                    {{-- Aksi --}}
                                                    <td class="px-4 py-3">
                                                        <div class="flex items-center justify-center gap-2">
                                                            {{-- Lihat --}}
                                                            <button @click="incrementView(allRows.indexOf(row))"
                                                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-sky-50 hover:bg-sky-500 text-sky-600 hover:text-white border border-sky-200 hover:border-sky-500 text-xs font-semibold transition-all duration-200 active:scale-95"
                                                                    title="Lihat Dokumen">
                                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                                Lihat
                                                            </button>
                                                            {{-- Unduh --}}
                                                            <button @click="incrementDownload(allRows.indexOf(row))"
                                                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-violet-50 hover:bg-violet-500 text-violet-600 hover:text-white border border-violet-200 hover:border-violet-500 text-xs font-semibold transition-all duration-200 active:scale-95"
                                                                    title="Unduh Dokumen">
                                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                                Unduh
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                            {{-- Empty state --}}
                                            <tr x-show="filtered.length === 0">
                                                <td colspan="7" class="px-4 py-10 text-center text-slate-400">
                                                    <div class="flex flex-col items-center gap-2">
                                                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                        <span class="text-sm font-medium">Dokumen tidak ditemukan</span>
                                                        <span class="text-xs">Coba kata kunci yang berbeda</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                {{-- â”€â”€ Footer: Info + Pagination â”€â”€ --}}
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-4 pt-3 border-t border-slate-100">
                                    {{-- Row Info --}}
                                    <p class="text-xs text-slate-500">
                                        Menampilkan <span class="font-semibold text-slate-700" x-text="startRow"></span>â€“<span class="font-semibold text-slate-700" x-text="endRow"></span>
                                        dari <span class="font-semibold text-slate-700" x-text="filtered.length"></span> dokumen
                                        <template x-if="search"><span> (difilter)</span></template>
                                    </p>
                                    {{-- Pagination --}}
                                    <div class="flex items-center gap-1">
                                        <button @click="page = Math.max(1, page - 1)" :disabled="page === 1"
                                                class="w-8 h-8 rounded-lg flex items-center justify-center border text-slate-500 transition-all duration-200 disabled:opacity-40 disabled:cursor-not-allowed"
                                                :class="page === 1 ? 'border-slate-200 bg-slate-50' : 'border-slate-200 bg-white hover:bg-sky-50 hover:border-sky-300 hover:text-sky-600'">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                        </button>
                                        <template x-for="p in totalPages" :key="p">
                                            <button @click="page = p"
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center border text-xs font-semibold transition-all duration-200"
                                                    :class="page === p ? 'bg-sky-500 border-sky-500 text-white shadow-sm' : 'border-slate-200 bg-white text-slate-600 hover:bg-sky-50 hover:border-sky-300 hover:text-sky-600'"
                                                    x-text="p">
                                            </button>
                                        </template>
                                        <button @click="page = Math.min(totalPages, page + 1)" :disabled="page === totalPages"
                                                class="w-8 h-8 rounded-lg flex items-center justify-center border text-slate-500 transition-all duration-200 disabled:opacity-40 disabled:cursor-not-allowed"
                                                :class="page === totalPages ? 'border-slate-200 bg-slate-50' : 'border-slate-200 bg-white hover:bg-sky-50 hover:border-sky-300 hover:text-sky-600'">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </button>
                                    </div>
                                </div>

                            </div>{{-- /body --}}
                        </div>

                    </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</x-layouts.app>

