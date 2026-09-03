<x-layouts.app>
    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[56px] pb-10 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-45">
                <img src="{{ asset('images/batucermin.jpg') }}" alt="Regulasi" class="w-full h-full object-cover">
            </div>
            <div
                class="absolute inset-0 z-10 bg-gradient-to-b from-[#274CA5]/55 via-[#274CA5]/35 to-[#10192D]/70 backdrop-blur-2xl">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt=""
                class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">

            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="rgUU" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0" />
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2" />
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#rgUU)"
                    stroke-width="2" />
            </svg>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="mx-auto max-w-4xl rounded-[2rem]   px-6 py-6 text-center   sm:px-10 sm:py-8" data-aos="fade-up">
                <div
                    class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border border-white/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 px-3  mr-2">
                        <span
                            class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-white opacity-75"></span>
                            <span
                            class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                        </div>Regulasi
                </div>

                <h1
                    class="font-montserrat font-black text-3xl sm:text-4xl lg:text-5xl text-white leading-tight drop-shadow-2xl">
                    Undang<span class="text-sky-200">-</span>Undang</h1>
                <!-- <p class="mx-auto max-w-2xl text-base sm:text-lg font-medium leading-relaxed text-white/85">Kumpulan Undang-Undang yang menjadi dasar hukum pelaksanaan tugas dan fungsi PROKOPIM Kabupaten Mahakam Ulu.</p> -->
                <div class="mt-5 flex items-center justify-center gap-2 text-sm text-white/70">
                    <a href="{{ route('beranda') }}"
                        class="hover:text-sky-200 transition-colors">Beranda</a><span>/</span><span>Regulasi</span><span>/</span><span
                        class="text-sky-200">Undang-Undang</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none"
                class="w-full h-12 fill-instansi-surface">
                <path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z" />
            </svg></div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @include('pages.regulasi._sidebar')
            <main class="lg:col-span-3" data-aos="fade-up">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-[#274CA5] flex items-center gap-3">
                            <span
                                class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600"><svg
                                    class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V7m0 16H9m3 0h3" />
                                </svg></span>
                            Daftar Undang-Undang
                        </h2>
                        <p class="text-slate-500 text-sm mt-1 ml-[52px]">Regulasi tingkat nasional yang menjadi dasar
                            hukum</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <div
                            class="flex items-center bg-white rounded-xl border border-slate-200 shadow-sm px-3 py-2 focus-within:border-sky-400 focus-within:ring-2 focus-within:ring-sky-100 transition-all">
                            <svg class="w-4 h-4 text-slate-400 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" placeholder="Cari regulasi..."
                                class="text-sm border-none outline-none bg-transparent w-40 placeholder:text-slate-400 text-slate-700">
                        </div>
                    </div>
                </div>
                @php
                    $regulasiCategory = 'undang-undang';
                    $regulations = [
                        ['key' => 'reg_uu_25_2004', 'no' => 'UU No. 25 Tahun 2004', 'title' => 'Sistem Perencanaan Pembangunan Nasional', 'year' => '2004', 'status' => 'Berlaku'],
                        ['key' => 'reg_uu_23_2014', 'no' => 'UU No. 23 Tahun 2014', 'title' => 'Pemerintahan Daerah', 'year' => '2014', 'status' => 'Berlaku'],
                        ['key' => 'reg_uu_17_2003', 'no' => 'UU No. 17 Tahun 2003', 'title' => 'Keuangan Negara', 'year' => '2003', 'status' => 'Berlaku'],
                        ['key' => 'reg_uu_1_2004', 'no' => 'UU No. 1 Tahun 2004', 'title' => 'Perbendaharaan Negara', 'year' => '2004', 'status' => 'Berlaku'],
                        ['key' => 'reg_uu_33_2004', 'no' => 'UU No. 33 Tahun 2004', 'title' => 'Perimbangan Keuangan antara Pemerintah Pusat dan Pemerintahan Daerah', 'year' => '2004', 'status' => 'Berlaku'],
                        ['key' => 'reg_uu_6_2014', 'no' => 'UU No. 6 Tahun 2014', 'title' => 'Desa', 'year' => '2014', 'status' => 'Berlaku'],
                ]; @endphp
                @include('pages.regulasi._regulation-list')
            </main>
        </div>
    </div>
</x-layouts.app>