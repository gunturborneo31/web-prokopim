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
                    <linearGradient id="riverGoldTujuan" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldTujuan)" stroke-width="2"/>
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
                    Tujuan <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">&amp; Sasaran</span>
                </h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">
                    Target dan indikator capaian pembangunan yang ingin diwujudkan oleh PROKOPIM Kabupaten Mahakam Ulu.
                </p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-[#274CA5]">Tujuan &amp; Sasaran</span>
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

        {{-- Tujuan --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8" data-aos="fade-up">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 rounded-2xl bg-sky-100 flex items-center justify-center text-sky-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-sky-600">Arah Kebijakan</span>
                    <h2 class="text-2xl font-bold text-slate-800">Tujuan Strategis</h2>
                </div>
            </div>
            <div class="text-center mt-6 mb-4">
                <p class="text-slate-700 text-lg leading-relaxed font-medium">
                    Meningkatkan Kualitas Perencanaan, Penelitian dan Pengendalian Pembangunan yang akuntabel
                </p>
            </div>
        </div>

        {{-- Sasaran --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center text-yellow-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-yellow-600">Indikator Kinerja</span>
                    <h2 class="text-2xl font-bold text-slate-800">Sasaran Pembangunan</h2>
                </div>
            </div>
            <div class="text-center mt-6 mb-4">
                <p class="text-slate-700 text-lg leading-relaxed font-medium">
                    Meningkatkan Keselarasan Perencanaan Pembangunan. Meningkatnya kualitas perencanaan pada (Bidang Perekonomian dan SDA, Bidang PPM dan Bidang Infrastruktur & Kewilayahan). Meningkatkan Peran Kelitbangan Dalam Pembangunan
                </p>
            </div>
        </div>

    </div>
</x-layouts.app>

