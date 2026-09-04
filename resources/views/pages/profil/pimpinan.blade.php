<x-layouts.app>
    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-80">
                <img src="{{ asset('images/desamahakamulu.jpg') }}"
                     alt="Mahakam Ulu" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="Background SVG"
                 class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
    
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="riverGoldPimpinan" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                    </linearGradient>
                </defs> 
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldPimpinan)" stroke-width="2"/>
            </svg>
        </div>

        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-left" data-aos="fade-up">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/5 border border-[#2E52A8] text-[#2E52A8] text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl my-2">
                    <div class="relative flex h-2 w-2 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#274CA5] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#2E52A8]"></span>
                    </div>
                    Profil Instansi
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">
                    Profil <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #10192d 50%, #10192d 100%);">Pimpinan</span>
                </h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">
                    Mengenal lebih dekat pimpinan Protokol dan Komunikasi Pimpinan  Kabupaten Mahakam Ulu.
                </p>
                <div class="mt-8 flex items-left justify-left gap-2 text-sm text-[#2E52A8]">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a>
                    <span>/</span>
                    <span>Profil</span>
                    <span>/</span>
                    <span class="text-[#274CA5] font-black">Pimpinan</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 z-20">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    {{-- ===================== PROFIL PIMPINAN ===================== --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-12 py-16">

        {{-- Kepala Badan Card --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden mb-12" data-aos="fade-up">
            <div class="grid grid-cols-1 lg:grid-cols-5">

                {{-- Photo Side (Full) --}}
                <div class="lg:col-span-2 relative bg-gradient-to-br from-[#274CA5] via-slate-800 to-sky-900 min-h-[480px] lg:min-h-0 overflow-hidden">
                    {{-- Full Photo --}}
                    <img src="{{ asset('images/Gemini_Generated_Image_6n66ll6n66ll6n66.png') }}"
                         alt="Yohanes Andy Abeh, S.Sos., M.Si."
                         class="absolute inset-0 w-full h-full object-cover object-top">

                    {{-- Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#274CA5] via-[#274CA5]/30 to-transparent"></div>



                    {{-- Bottom Info --}}
                    <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-8 z-10">
                        {{-- Badge --}}
                        <div class="mb-3">
                            <span class="inline-flex px-4 py-1.5 rounded-full bg-white text-black text-[10px] font-black uppercase tracking-widest shadow-lg">
                                Kepala Badan
                            </span>
                        </div>

                        {{-- Name --}}
                        <h2 class="font-montserrat font-black text-2xl lg:text-3xl text-white leading-tight drop-shadow-lg">
                            Yohanes Andy Abeh
                        </h2>
                        <p class="text-white text-sm font-bold mt-1">S.Sos., M.Si.</p>

                        {{-- Eselon badge --}}
                        <div class="mt-3 inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white border border-white backdrop-blur-sm">
                            <svg class="w-3.5 h-3.5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                            </svg>
                            <span class="text-black text-[11px] font-semibold">Pejabat Eselon II</span>
                        </div>
                    </div>
                </div>

                {{-- Info Side --}}
                <div class="lg:col-span-3 p-8 lg:p-10">
                    {{-- Title Bar --}}
                    <div class="flex items-start gap-4 mb-8">
                        <div class="w-1.5 h-12 bg-gradient-to-b from-blue-400 to-blue-900 rounded-full shrink-0 mt-1"></div>
                        <div>
                            <h3 class="font-montserrat font-bold text-xl text-slate-800 leading-snug">
                                Kepala Protokol dan Komunikasi Pimpinan 
                            </h3>
                            <p class="text-slate-500 text-sm mt-1">Kabupaten Mahakam Ulu, Kalimantan Timur</p>
                        </div>
                    </div>

                    {{-- Info Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
                        @foreach([
                            ['label' => 'Pendidikan Terakhir', 'value' => 'Magister Sains (M.Si.)', 'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
                            ['label' => 'Gelar Sarjana', 'value' => 'Sarjana Sosial (S.Sos.)', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                            ['label' => 'Jabatan Sebelumnya', 'value' => 'Kepala BPKAD Kab. Mahakam Ulu', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                            ['label' => 'Lokasi Kantor', 'value' => 'Ujoh Bilang, Kab. Mahakam Ulu', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                        ] as $info)
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-sky-50/50 hover:border-sky-100 transition-colors group">
                            <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center shrink-0 text-slate-500 group-hover:text-sky-600 group-hover:border-sky-200 transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $info['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">{{ $info['label'] }}</span>
                                <span class="text-sm text-slate-700 font-bold mt-0.5 block">{{ $info['value'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Bio / Quote --}}
                    <div class="p-6 rounded-2xl bg-gradient-to-br from-sky-50 to-blue-50 border border-sky-100">
                        <div class="flex items-start gap-3">
                            <svg class="w-8 h-8 text-sky-300 shrink-0 mt-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.789 5.983 11h4v10H0z"/>
                            </svg>
                            <div>
                                <p class="text-slate-600 text-sm leading-relaxed italic">
                                    Sebagai Kepala PROKOPIM Kabupaten Mahakam Ulu, kami berkomitmen memberikan pelayanan keprotokolan dan komunikasi pimpinan yang profesional, responsif, dan transparan. Melalui sinergi dengan seluruh OPD dan media, kita wujudkan Mahakam Ulu yang lebih maju dan sejahtera.
                                </p>
                                <p class="text-sky-600 font-bold text-xs mt-3">— Yohanes Andy Abeh, S.Sos., M.Si.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Riwayat Jabatan Timeline --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 lg:p-10 mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-8 bg-gradient-to-b from-blue-400 to-blue-900 rounded-full"></div>
                <h2 class="font-montserrat font-bold text-xl text-slate-800">Riwayat Jabatan</h2>
            </div>

            <div class="relative">
                {{-- Timeline Line --}}
                <div class="absolute left-6 top-0 bottom-0 w-px bg-gradient-to-b from-sky-400 via-blue-300 to-slate-200"></div>

                <div class="space-y-8">
                    @foreach([
                        ['period' => '2024 — Sekarang', 'title' => 'Kepala PROKOPIM', 'org' => 'Kabupaten Mahakam Ulu', 'active' => true],
                        ['period' => '2021 — 2024', 'title' => 'Kepala BPKAD', 'org' => 'Kabupaten Mahakam Ulu', 'active' => false],
                        ['period' => '2018 — 2021', 'title' => 'Kepala Dinas PUPR', 'org' => 'Kabupaten Mahakam Ulu', 'active' => false],
                    ] as $career)
                    <div class="relative flex gap-6 pl-2">
                        {{-- Timeline Dot --}}
                        <div class="relative z-10 w-10 h-10 rounded-full {{ $career['active'] ? 'bg-sky-500 shadow-lg shadow-sky-500/30' : 'bg-white border-2 border-slate-200' }} flex items-center justify-center shrink-0">
                            @if($career['active'])
                                <span class="w-3 h-3 rounded-full bg-white"></span>
                            @else
                                <span class="w-3 h-3 rounded-full bg-slate-300"></span>
                            @endif
                        </div>

                        <div class="flex-1 pb-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $career['active'] ? 'bg-sky-100 text-sky-700 border border-sky-200' : 'bg-slate-100 text-slate-500 border border-slate-200' }} mb-2">
                                {{ $career['period'] }}
                            </span>
                            <h3 class="font-bold text-lg text-slate-800 mt-1">{{ $career['title'] }}</h3>
                            <p class="text-slate-500 text-sm mt-0.5">{{ $career['org'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Tugas & Fungsi Pimpinan --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 lg:p-10" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-8 bg-gradient-to-b from-blue-400 to-blue-900 rounded-full"></div>
                <h2 class="font-montserrat font-bold text-xl text-slate-800">Tugas & Fungsi Kepala Badan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach([
                    ['title' => 'Keprotokolan Pimpinan', 'desc' => 'Memimpin dan mengoordinasikan penyelenggaraan acara resmi serta tata protokol kegiatan pimpinan daerah.'],
                    ['title' => 'Koordinasi Antar OPD', 'desc' => 'Mengoordinasikan seluruh Organisasi Perangkat Daerah dalam penyelenggaraan agenda dan komunikasi kebijakan pimpinan.'],
                    ['title' => 'Komunikasi & Kehumasan', 'desc' => 'Memimpin pengelolaan komunikasi publik, kehumasan, dan hubungan media untuk mendukung kebijakan daerah.'],
                    ['title' => 'Monitoring & Evaluasi', 'desc' => 'Melaksanakan pemantauan dan evaluasi pelaksanaan agenda serta pemberitaan kegiatan pimpinan daerah.'],
                    ['title' => 'Pengelolaan Informasi Publik', 'desc' => 'Mengelola sistem informasi publik dan dokumentasi kegiatan Pemerintah Kabupaten Mahakam Ulu.'],
                    ['title' => 'Layanan Informasi Publik (PPID)', 'desc' => 'Memimpin pelayanan informasi publik dan keterbukaan informasi bagi masyarakat Kabupaten Mahakam Ulu.'],
                ] as $idx => $task)
                <div class="flex items-start gap-4 p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-sky-50/50 hover:border-sky-200 transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center shrink-0 text-sky-600 font-black text-sm group-hover:bg-sky-100 group-hover:border-sky-300 transition-colors">
                        {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm group-hover:text-sky-700 transition-colors">{{ $task['title'] }}</h4>
                        <p class="text-slate-500 text-xs leading-relaxed mt-1">{{ $task['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
