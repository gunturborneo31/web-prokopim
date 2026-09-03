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
                    <linearGradient id="riverGoldTupoksi" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldTupoksi)" stroke-width="2"/>
            </svg>
        </div>

        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#274CA5] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#9ae600]"></span>
                    </div>
                    Profil Instansi
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">
                    Tugas Pokok <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">&amp; Fungsi</span>
                </h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">
                    Peran dan kewenangan PROKOPIM dalam mendukung perencanaan dan pembangunan daerah Kabupaten Mahakam Ulu.
                </p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-[#274CA5]">Tupoksi</span>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 z-20">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    {{-- ===================== PAGE CONTENT ===================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16 space-y-10">

        {{-- Tugas Pokok --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" data-aos="fade-up">
            <div class="h-2 bg-gradient-to-r from-sky-400 to-blue-600"></div>
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-sky-100 flex items-center justify-center text-sky-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-sky-600">Mandat Utama</span>
                        <h2 class="text-2xl font-bold text-slate-800">Tugas Pokok</h2>
                    </div>
                </div>
                <div class="bg-sky-50 rounded-xl p-6 border border-sky-100">
                    <p class="text-slate-700 leading-relaxed text-lg">
                        PROKOPIM mempunyai tugas membantu Bupati dalam <span class="font-semibold text-sky-700">melaksanakan fungsi penunjang urusan pemerintahan</span> yang menjadi kewenangan Daerah di bidang perencanaan pembangunan, penelitian dan pengembangan.
                    </p>
                </div>
            </div>
        </div>

        {{-- Fungsi --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="h-2 bg-gradient-to-r from-[#274CA5] to-amber-500"></div>
            <div class="p-8">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center text-yellow-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-yellow-600">Kewenangan</span>
                        <h2 class="text-2xl font-bold text-slate-800">Fungsi</h2>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach([
                        ['icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'fungsi' => 'Penyusunan kebijakan teknis di bidang perencanaan pembangunan dan penelitian & pengembangan daerah.', 'color' => 'sky'],
                        ['icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z', 'fungsi' => 'Pelaksanaan koordinasi penyusunan RPJPD, RPJMD, Renstra OPD, dan RKPD.', 'color' => 'blue'],
                        ['icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'fungsi' => 'Pemantauan, evaluasi dan pelaporan atas pelaksanaan perencanaan pembangunan daerah.', 'color' => 'violet'],
                        ['icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z', 'fungsi' => 'Pelaksanaan penelitian, pengkajian dan pengembangan serta inovasi daerah.', 'color' => 'emerald'],
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0', 'fungsi' => 'Pelaksanaan administrasi PROKOPIM sesuai dengan lingkup tugasnya.', 'color' => 'amber'],
                        ['icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z', 'fungsi' => 'Pelaksanaan fungsi lain yang diberikan oleh Bupati sesuai dengan tugas dan fungsinya.', 'color' => 'rose'],
                    ] as $item)
                    <div class="flex gap-4 p-5 rounded-xl border border-slate-100 hover:border-{{ $item['color'] }}-300 hover:bg-{{ $item['color'] }}-50/50 transition-all duration-300 group">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-{{ $item['color'] }}-100 flex items-center justify-center text-{{ $item['color'] }}-600 group-hover:bg-{{ $item['color'] }}-500 group-hover:text-white transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                            </svg>
                        </div>
                        <p class="text-slate-600 leading-relaxed text-sm">{{ $item['fungsi'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-layouts.app>

