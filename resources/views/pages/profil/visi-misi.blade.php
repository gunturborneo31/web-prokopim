<x-layouts.app>
    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        {{-- Decorative Background --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            {{-- Background Image Layer --}}
            <div class="absolute inset-0 z-0 opacity-80">
                <img src="{{ asset('images/desamahakamulu.jpg') }}"
                     alt="Mahakam Ulu"
                     class="w-full h-full object-cover">
            </div>

            {{-- Background SVG (Abstract layer) --}}
            <img src="{{ asset('images/Desain tanpa judul.svg') }}"
                 alt="Background SVG"
                 class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen"
                 loading="eager">

            {{-- Gradient Overlay --}}
    

            {{-- River flow SVG curves --}}
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="riverGoldVisiMisi" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldVisiMisi)" stroke-width="2"/>
            </svg>
        </div>

        {{-- Hero Content --}}
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                {{-- Badge --}}
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#274CA5] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#9ae600]"></span>
                    </div>
                    Profil Instansi
                </div>

                {{-- Page Title --}}
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">
                    Visi <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">&amp;</span> Misi
                </h1>

                {{-- Subtitle with golden left-border style --}}
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">
                    Arah pembangunan dan cita-cita Kabupaten Mahakam Ulu menuju masyarakat yang sejahtera dan berkeadilan.
                </p>

                {{-- Breadcrumb --}}
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-[#274CA5]">Visi &amp; Misi</span>
                </div>
            </div>
        </div>

        {{-- Bottom wave cut --}}
        <div class="absolute bottom-0 left-0 right-0 z-20">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    {{-- ===================== PAGE CONTENT ===================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- Visi --}}
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-slate-100 hover:shadow-2xl transition-shadow duration-300"
                 data-aos="fade-right">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 mr-4 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-yellow-600">Pernyataan Visi</span>
                        <h3 class="text-2xl font-bold text-[#274CA5]">Visi</h3>
                    </div>
                </div>
                <div class="relative pl-4 border-l-4 border-[#274CA5]">
                    <p class="text-slate-600 text-lg leading-relaxed italic">
                        "Membangun Mahulu Untuk Semua : Sejahtera Berkeadilan"
                    </p>
                </div>
            </div>

            {{-- Misi --}}
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-slate-100 hover:shadow-2xl transition-shadow duration-300"
                 data-aos="fade-left" data-aos-delay="100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600 mr-4 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-sky-600">Arah Pembangunan</span>
                        <h3 class="text-2xl font-bold text-[#274CA5]">Misi</h3>
                    </div>
                </div>
                <div class="relative pl-4 border-l-4 border-sky-400 mt-4">
                    <p class="text-slate-600 text-lg leading-relaxed italic">
                        "Menciptakan tata pemerintahan yang bersih, berwibawa, transparan, dan akuntabel"
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>
