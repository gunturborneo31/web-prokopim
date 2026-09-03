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
                    <linearGradient id="riverGoldStruktur" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldStruktur)" stroke-width="2"/>
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
                    Struktur <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">Organisasi</span>
                </h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">
                    Susunan organisasi dan tata kerja PROKOPIM Kabupaten Mahakam Ulu berdasarkan regulasi yang berlaku.
                </p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-[#274CA5]">Struktur Organisasi</span>
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">

        {{-- Dasar Hukum --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 mb-10" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-1 h-8 bg-gradient-to-b from-sky-400 to-blue-600 rounded-full"></div>
                <h2 class="text-xl font-bold text-slate-800">Dasar Hukum</h2>
            </div>
            <p class="text-slate-600 leading-relaxed">
                PROKOPIM Kabupaten Mahakam Ulu dibentuk berdasarkan <span class="font-semibold text-sky-700">Peraturan Daerah Kabupaten Mahakam Ulu</span> tentang Pembentukan dan Susunan Perangkat Daerah Kabupaten Mahakam Ulu.
            </p>
        </div>

        {{-- Gambar Struktur Organisasi --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-blue-900 rounded-full"></div>
                    <h2 class="text-xl font-bold text-slate-800">Bagan Struktur Organisasi</h2>
                </div>
                <button type="button" onclick="document.getElementById('imageModal').classList.remove('hidden')" class="hidden md:inline-flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-600 text-sm font-bold border border-slate-200 rounded-xl hover:bg-sky-500 hover:text-white hover:border-sky-500 transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                    Buka Ukuran Penuh
                </button>
            </div>

            {{-- Image Container --}}
            <div class="relative w-full overflow-x-auto bg-slate-50 border-2 border-dashed border-slate-200 rounded-xl p-4 md:p-8 flex items-center justify-center min-h-[400px]">
                <img src="{{ asset('images/struktur_organisasi2.webp') }}"
                     alt="Bagan Struktur Organisasi PROKOPIM Mahakam Ulu"
                     class="max-w-full h-auto object-contain rounded-lg shadow-sm"
                     loading="lazy">
                     
                {{-- Fallback text if image not found --}}
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 bg-slate-50/90 backdrop-blur-sm -z-10">
                    <svg class="w-12 h-12 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-slate-500 font-medium mb-1">Gambar Struktur Organisasi Kosong</p>
                    <p class="text-slate-400 text-sm">Ganti file gambar di <code>public/images/placeholder-struktur.png</code> atau ubah path di <code>struktur.blade.php</code></p>
                </div>
            </div>

            <p class="text-center text-slate-400 text-xs mt-6">* Klik tombol "Buka Ukuran Penuh" untuk melihat diagram lebih jelas.</p>
        </div>

    </div>

    {{-- Image Modal --}}
    <div id="imageModal" class="fixed inset-0 z-[100] hidden bg-[#274CA5]/95 backdrop-blur-sm p-4 sm:p-6 lg:p-8 flex items-center justify-center transition-all duration-300">
        {{-- Close Button --}}
        <button type="button" onclick="document.getElementById('imageModal').classList.add('hidden')" class="absolute top-4 right-4 sm:top-6 sm:right-6 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 hover:scale-110 rounded-full p-2.5 transition-all duration-300 z-[110] shadow-lg">
            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        {{-- Image Container --}}
        <div class="relative w-full h-full flex items-center justify-center" onclick="document.getElementById('imageModal').classList.add('hidden')">
            <img src="{{ asset('images/struktur_organisasi2.webp') }}" 
                 alt="Bagan Struktur Organisasi Ukuran Penuh" 
                 class="max-w-full max-h-full object-contain rounded-xl shadow-2xl cursor-zoom-out ring-1 ring-white/10"
                 onclick="event.stopPropagation()">
        </div>
    </div>
</x-layouts.app>

