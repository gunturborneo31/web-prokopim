<x-layouts.app>
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-80"><img src="{{ asset('images/batucermin.jpg') }}" alt="Regulasi" class="w-full h-full object-cover"></div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="" class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
    
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="rgLL" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#10192d" stop-opacity="0"/><stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/><stop offset="100%" stop-color="#10192d" stop-opacity="0"/></linearGradient></defs><path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#rgLL)" stroke-width="2"/></svg>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border border-white/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3"><div class="relative flex h-2 w-2 px-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#274CA5] opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-[#9ae600]"></span></div>Regulasi</div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">Lain<span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">-</span>lain</h1>
                <p class="text-black/90 text-lg font-medium max-w-2xl leading-relaxed">Regulasi dan dokumen hukum lainnya yang mendukung pelaksanaan tugas PROKOPIM.</p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50"><a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a><span>/</span><span>Regulasi</span><span>/</span><span class="text-[#274CA5]">Lain-lain</span></div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface"><path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/></svg></div>
    </section>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @include('pages.regulasi._sidebar')
            <main class="lg:col-span-3" data-aos="fade-up">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-[#274CA5] flex items-center gap-3"><span class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" /></svg></span>Daftar Regulasi Lain-lain</h2>
                        <p class="text-slate-500 text-sm mt-1 ml-[52px]">Dokumen hukum pendukung lainnya</p>
                    </div>
                    <div class="mt-4 sm:mt-0"><div class="flex items-center bg-white rounded-xl border border-slate-200 shadow-sm px-3 py-2 focus-within:border-sky-400 focus-within:ring-2 focus-within:ring-sky-100 transition-all"><svg class="w-4 h-4 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg><input type="text" placeholder="Cari regulasi..." class="text-sm border-none outline-none bg-transparent w-40 placeholder:text-slate-400 text-slate-700"></div></div>
                </div>
                @php
                $regulasiCategory = 'lain-lain';
                $regulations = [
                    ['key' => 'reg_ll_se050_2023', 'no' => 'SE Mendagri No. 050/3708/SJ', 'title' => 'Pedoman Penyusunan RKPD Tahun 2024', 'year' => '2023', 'status' => 'Berlaku'],
                    ['key' => 'reg_ll_inpres_2017', 'no' => 'Instruksi Presiden No. 1 Tahun 2017', 'title' => 'Gerakan Masyarakat Hidup Sehat', 'year' => '2017', 'status' => 'Berlaku'],
                    ['key' => 'reg_ll_se120_2022', 'no' => 'SE Mendagri No. 120/253/SJ', 'title' => 'Penyelenggaraan Musrenbang RKPD', 'year' => '2022', 'status' => 'Berlaku'],
                ]; @endphp
                @include('pages.regulasi._regulation-list')
            </main>
        </div>
    </div>
</x-layouts.app>

