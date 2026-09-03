<x-layouts.app>
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-80">
                <img src="{{ asset('images/desamahakamulu.jpg') }}" alt="Dokumen" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="" class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
    
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="dgRK" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#10192d" stop-opacity="0"/><stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/><stop offset="100%" stop-color="#10192d" stop-opacity="0"/></linearGradient></defs><path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#dgRK)" stroke-width="2"/></svg>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#274CA5] opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-[#9ae600]"></span></div>Dokumen
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl"><span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">RK</span>PD</h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">Rencana Kerja Pemerintah Daerah (RKPD) Kabupaten Mahakam Ulu — dokumen perencanaan pembangunan daerah tahunan.</p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a><span>/</span><span>Dokumen</span><span>/</span><span class="text-[#274CA5]">RKPD</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface"><path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/></svg></div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @include('pages.dokumen._sidebar')
            <main class="lg:col-span-3" data-aos="fade-up">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-[#274CA5] flex items-center gap-3">
                            <span class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg></span>
                            Dokumen RKPD
                        </h2>
                        <p class="text-slate-500 text-sm mt-1 ml-[52px]">Rencana Kerja Pemerintah Daerah</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div class="flex items-center bg-white rounded-xl border border-slate-200 shadow-sm px-3 py-2 focus-within:border-sky-400 focus-within:ring-2 focus-within:ring-sky-100 transition-all">
                            <svg class="w-4 h-4 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            <input type="text" placeholder="Cari dokumen..." class="text-sm border-none outline-none bg-transparent w-40 placeholder:text-slate-400 text-slate-700">
                        </div>
                    </div>
                </div>
                @php
                $dokumenCategory = 'rkpd';
                $documents = [
                    ['key' => 'dok_rkpd_2026', 'no' => 'RKPD 2026', 'title' => 'Rencana Kerja Pemerintah Daerah Kabupaten Mahakam Ulu Tahun 2026', 'year' => '2025', 'type' => 'PDF', 'status' => 'Berlaku'],
                    ['key' => 'dok_rkpd_2025', 'no' => 'RKPD 2025', 'title' => 'Rencana Kerja Pemerintah Daerah Kabupaten Mahakam Ulu Tahun 2025', 'year' => '2024', 'type' => 'PDF', 'status' => 'Berlaku'],
                    ['key' => 'dok_rkpd_2024', 'no' => 'RKPD 2024', 'title' => 'Rencana Kerja Pemerintah Daerah Kabupaten Mahakam Ulu Tahun 2024', 'year' => '2023', 'type' => 'PDF', 'status' => 'Berlaku'],
                    ['key' => 'dok_rkpd_perubahan_2025', 'no' => 'Perubahan RKPD 2025', 'title' => 'Perubahan Rencana Kerja Pemerintah Daerah Kabupaten Mahakam Ulu Tahun 2025', 'year' => '2025', 'type' => 'PDF', 'status' => 'Berlaku'],
                ]; @endphp
                @include('pages.dokumen._document-list')
            </main>
        </div>
    </div>
</x-layouts.app>
