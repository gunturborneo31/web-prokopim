<x-layouts.app>
    {{-- ===================== PAGE HERO BANNER ===================== --}}
    <section class="relative pt-[56px] pb-10 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-45">
                <img src="{{ asset('images/batucermin.jpg') }}" alt="PPID" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="" class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/65 via-sky-800/45 to-sky-700/35 backdrop-blur-2xl z-10"></div>
    
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="ppPI" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#10192d" stop-opacity="0"/><stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/><stop offset="100%" stop-color="#10192d" stop-opacity="0"/></linearGradient></defs><path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#ppPI)" stroke-width="2"/></svg>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="mx-auto max-w-4xl rounded-[2rem] border border-white/10 bg-white/10 px-6 py-6 text-center shadow-2xl backdrop-blur-md sm:px-10 sm:py-8" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/10 border border-white/15 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-4">
                    <div class="relative flex h-2 w-2 mx-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-70"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-sky-300"></span></div>PPID
                </div>
                <h1 class="font-montserrat font-black text-3xl sm:text-4xl lg:text-5xl text-white leading-tight drop-shadow-2xl">Permohonan <span class="text-sky-200">Informasi</span></h1>
                <p class="mt-4 text-white/85 text-base sm:text-lg max-w-2xl leading-relaxed mx-auto">Layanan pengajuan permohonan informasi publik secara mandiri kepada PPID PROKOPIM Kabupaten Mahakam Ulu.</p>
                <div class="mt-5 flex items-center justify-center gap-2 text-sm text-white/70">
                    <a href="{{ route('beranda') }}" class="hover:text-sky-200 transition-colors">Beranda</a><span>/</span><span>PPID</span><span>/</span><span class="text-sky-200">Permohonan Informasi</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 fill-instansi-surface"><path d="M0,60 C360,0 1080,0 1440,60 L1440,60 L0,60 Z"/></svg></div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @include('pages.ppid._sidebar')
            
            <main class="lg:col-span-3" data-aos="fade-up">
                {{-- STATISTIK PERMOHONAN (Premium Redesign) --}}
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-sky-100/80 text-sky-600 shadow-inner">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>
                        <h2 class="text-2xl font-black font-montserrat tracking-tight text-slate-800">
                            Statistik <span class="text-sky-600">Layanan</span>
                        </h2>
                        <div class="h-px bg-slate-200/60 flex-1"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Card 1: Tahun Ini (Sky Blue) --}}
                        <div class="group relative bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 hover:border-sky-100 overflow-hidden hover:-translate-y-1.5 hover:shadow-[0_8px_30px_rgb(14,165,233,0.12)] transition-all duration-300">
                            <!-- Decorative blur -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-sky-400/10 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-125 duration-500 pointer-events-none"></div>
                            
                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-sky-400 to-sky-600 text-white flex items-center justify-center shadow-lg shadow-sky-500/30">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-xs font-bold tracking-wide">
                                    TAHUN INI
                                </span>
                            </div>
                            
                            <div class="relative z-10">
                                <h3 class="text-slate-500 text-sm font-medium mb-1">Total Permohonan</h3>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-4xl font-black font-montserrat tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-slate-800 to-slate-600">5</span>
                                    <span class="text-sm font-semibold text-slate-400">Berkas</span>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Card 2: Bulan Ini (Amber) --}}
                        <div class="group relative bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 hover:border-amber-100 overflow-hidden hover:-translate-y-1.5 hover:shadow-[0_8px_30px_rgb(245,158,11,0.12)] transition-all duration-300">
                            <!-- Decorative blur -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-400/10 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-125 duration-500 pointer-events-none"></div>
                            
                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 text-white flex items-center justify-center shadow-lg shadow-amber-500/30">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-xs font-bold tracking-wide">
                                    BULAN INI
                                </span>
                            </div>
                            
                            <div class="relative z-10">
                                <h3 class="text-slate-500 text-sm font-medium mb-1">Total Permohonan</h3>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-4xl font-black font-montserrat tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-slate-800 to-slate-600">5</span>
                                    <span class="text-sm font-semibold text-slate-400">Berkas</span>
                                </div>
                            </div>
                        </div>

                        {{-- Card 3: Hari Ini (Emerald) --}}
                        <div class="group relative bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 hover:border-emerald-100 overflow-hidden hover:-translate-y-1.5 hover:shadow-[0_8px_30px_rgb(16,185,129,0.12)] transition-all duration-300">
                            <!-- Decorative blur -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-400/10 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-125 duration-500 pointer-events-none"></div>
                            
                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-xs font-bold tracking-wide">
                                    HARI INI
                                </span>
                            </div>
                            
                            <div class="relative z-10">
                                <h3 class="text-slate-500 text-sm font-medium mb-1">Total Permohonan</h3>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-4xl font-black font-montserrat tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-slate-800 to-slate-600">5</span>
                                    <span class="text-sm font-semibold text-slate-400">Berkas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TABBED INTERFACE: Permohonan & Cek Status --}}
                <div x-data="{ activeTab: 'permohonan' }" class="mb-12" x-cloak>
                    
                    {{-- Tab Navigation --}}
                    <div class="flex border-b border-slate-200 mb-8 pl-4 overflow-x-auto custom-scrollbar relative">
                        {{-- Tab 1: Permohonan --}}
                        <button @click="activeTab = 'permohonan'"
                                class="px-8 py-4 text-sm font-medium transition-colors duration-200 relative whitespace-nowrap group outline-none focus-visible:bg-slate-50 border border-transparent border-b-0 rounded-t-xl z-10 -mb-px"
                                :class="activeTab === 'permohonan' ? 'text-[#1a73e8] font-bold bg-white !border-slate-200 shadow-[0_-4px_10px_rgb(0,0,0,0.02)]' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50/50'">
                            Permohonan
                            <div class="absolute bottom-[-1px] left-0 w-full h-[3px] bg-[#1a73e8] rounded-t-sm transition-opacity duration-200"
                                 :class="activeTab === 'permohonan' ? 'opacity-100' : 'opacity-0 group-hover:opacity-30'"></div>
                        </button>
                        
                        {{-- Tab 2: Cek Status --}}
                        <button @click="activeTab = 'status'"
                                class="px-8 py-4 text-sm font-medium transition-colors duration-200 relative whitespace-nowrap group outline-none focus-visible:bg-slate-50 border border-transparent border-b-0 rounded-t-xl z-10 -mb-px"
                                :class="activeTab === 'status' ? 'text-[#1a73e8] font-bold bg-white !border-slate-200 shadow-[0_-4px_10px_rgb(0,0,0,0.02)]' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-50/50'">
                            Cek Status Permohonan Informasi
                            <div class="absolute bottom-[-1px] left-0 w-full h-[3px] bg-[#1a73e8] rounded-t-sm transition-opacity duration-200"
                                 :class="activeTab === 'status' ? 'opacity-100' : 'opacity-0 group-hover:opacity-30'"></div>
                        </button>
                    </div>

                    {{-- TAB CONTENT: Permohonan Form --}}
                    <div x-show="activeTab === 'permohonan'" 
                         x-transition:enter="transition ease-[cubic-bezier(0.2,0.8,0.2,1)] duration-700" 
                         x-transition:enter-start="opacity-0 translate-y-8 scale-[0.98]" 
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         style="display: none;">
                         
                        <div class="flex flex-col mb-8">
                            <h2 class="text-2xl font-bold text-[#274CA5] flex items-center gap-3">
                                <span class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </span>
                                Formulir Permohonan Informasi
                            </h2>
                            <p class="text-slate-500 text-sm mt-1 ml-[52px]">Silakan lengkapi formulir di bawah ini untuk mengajukan permohonan informasi publik.</p>
                        </div>

                        {{-- FORM PERMOHONAN INFORMASI --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
                            <form action="#" method="POST" class="space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Jenis Pemohon --}}
                                    <div class="col-span-1 md:col-span-2 space-y-2">
                                        <label class="block text-sm font-semibold text-slate-700">Jenis Pemohon <span class="text-red-500">*</span></label>
                                        <div class="flex flex-wrap gap-4">
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" name="jenis_pemohon" value="Perorangan" class="w-4 h-4 text-sky-600 border-slate-300 focus:ring-sky-500" checked>
                                                <span class="text-slate-600 group-hover:text-[#274CA5]">Perorangan</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" name="jenis_pemohon" value="Kelompok" class="w-4 h-4 text-sky-600 border-slate-300 focus:ring-sky-500">
                                                <span class="text-slate-600 group-hover:text-[#274CA5]">Kelompok Masyarakat</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" name="jenis_pemohon" value="Badan Hukum" class="w-4 h-4 text-sky-600 border-slate-300 focus:ring-sky-500">
                                                <span class="text-slate-600 group-hover:text-[#274CA5]">Badan Hukum / Instansi</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    {{-- Nama Lengkap --}}
                                    <div class="space-y-2">
                                        <label for="nama" class="block text-sm font-semibold text-slate-700">Nama Lengkap / Instansi <span class="text-red-500">*</span></label>
                                        <input type="text" id="nama" name="nama" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-colors text-slate-700 bg-slate-50" placeholder="Masukkan nama..." required>
                                    </div>

                                    {{-- NIK / No. Identitas --}}
                                    <div class="space-y-2">
                                        <label for="nik" class="block text-sm font-semibold text-slate-700">NIK / Nomor Identitas (KTP/SIM/Paspor) <span class="text-red-500">*</span></label>
                                        <input type="text" id="nik" name="nik" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-colors text-slate-700 bg-slate-50" placeholder="Masukkan NIK 16 digit" required>
                                    </div>

                                    {{-- Email --}}
                                    <div class="space-y-2">
                                        <label for="email" class="block text-sm font-semibold text-slate-700">Email Aktif <span class="text-red-500">*</span></label>
                                        <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-colors text-slate-700 bg-slate-50" placeholder="nama@email.com" required>
                                    </div>

                                    {{-- No HP --}}
                                    <div class="space-y-2">
                                        <label for="no_hp" class="block text-sm font-semibold text-slate-700">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                                        <input type="text" id="no_hp" name="no_hp" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-colors text-slate-700 bg-slate-50" placeholder="08xx..." required>
                                    </div>

                                    {{-- Alamat --}}
                                    <div class="col-span-1 md:col-span-2 space-y-2">
                                        <label for="alamat" class="block text-sm font-semibold text-slate-700">Alamat Lengkap KTP <span class="text-red-500">*</span></label>
                                        <textarea id="alamat" name="alamat" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-colors text-slate-700 bg-slate-50 resize-none" placeholder="Tuliskan alamat lengkap..." required></textarea>
                                    </div>

                                    {{-- Rincian Informasi yang Dibutuhkan --}}
                                    <div class="col-span-1 md:col-span-2 space-y-2">
                                        <label for="rincian_informasi" class="block text-sm font-semibold text-slate-700">Rincian Informasi yang Dibutuhkan <span class="text-red-500">*</span></label>
                                        <textarea id="rincian_informasi" name="rincian_informasi" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-colors text-slate-700 bg-slate-50 resize-none" placeholder="Jelaskan secara detail informasi apa yang Anda butuhkan..." required></textarea>
                                    </div>

                                    {{-- Tujuan Penggunaan --}}
                                    <div class="col-span-1 md:col-span-2 space-y-2">
                                        <label for="tujuan" class="block text-sm font-semibold text-slate-700">Tujuan Penggunaan Informasi <span class="text-red-500">*</span></label>
                                        <input type="text" id="tujuan" name="tujuan" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-colors text-slate-700 bg-slate-50" placeholder="Contoh: Penelitian skripsi, referensi pemberitaan..." required>
                                    </div>

                                    {{-- Cara Mendapatkan Informasi --}}
                                    <div class="col-span-1 md:col-span-2 space-y-2 outline-none">
                                        <label class="block text-sm font-semibold text-slate-700 mb-3">Cara Memperoleh & Dikirimkan Informasi <span class="text-red-500">*</span></label>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="p-4 border border-slate-200 rounded-xl bg-slate-50 hover:border-sky-300 hover:bg-sky-50/50 transition-colors cursor-pointer group">
                                                <div class="flex items-start gap-3 justify-start">
                                                    <input type="radio" name="cara_mendapat" value="Hardcopy/Email" class="mt-1 w-4 h-4 text-sky-600 border-slate-300 focus:ring-sky-500 group-hover:bg-sky-100" checked>
                                                    <div>
                                                        <p class="font-medium text-slate-800 text-sm">Hardcopy / Email</p>
                                                        <p class="text-xs text-slate-500 mt-1">Dikirimkan via email atau dicetak (biaya cetak ditanggung pemohon)</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-4 border border-slate-200 rounded-xl bg-slate-50 hover:border-sky-300 hover:bg-sky-50/50 transition-colors cursor-pointer group">
                                                <div class="flex items-start gap-3 justify-start">
                                                    <input type="radio" name="cara_mendapat" value="Melihat/Membaca" class="mt-1 w-4 h-4 text-sky-600 border-slate-300 focus:ring-sky-500 group-hover:bg-sky-100">
                                                    <div>
                                                        <p class="font-medium text-slate-800 text-sm">Melihat / Mengetahui Saja</p>
                                                        <p class="text-xs text-slate-500 mt-1">Membaca dokumen langsung di layar atau di ruang PPID</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Upload KTP --}}
                                    <div class="col-span-1 md:col-span-2 space-y-2">
                                        <label for="foto_ktp" class="block text-sm font-semibold text-slate-700">Upload Foto KTP Pemohon <span class="text-red-500">*</span></label>
                                        <input type="file" id="foto_ktp" name="foto_ktp" accept="image/*,.pdf" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 focus:outline-none transition-colors" required>
                                        <p class="text-xs text-slate-500 mt-1 flex items-center gap-1"><svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Format JPG/PNG/PDF maksimal 2MB.</p>
                                    </div>
                                </div>

                                {{-- Agreement --}}
                                <div class="mt-8 pt-6 border-t border-slate-200">
                                    <label class="flex items-start gap-3 cursor-pointer group">
                                        <input type="checkbox" required class="mt-1 w-5 h-5 text-sky-600 rounded border-slate-300 focus:ring-sky-500">
                                        <span class="text-sm text-slate-600 leading-relaxed group-hover:text-[#274CA5]">
                                            Saya menyatakan bahwa data yang saya isikan adalah benar dan dapat dipertanggungjawabkan, serta saya setuju untuk mematuhi ketentuan perundang-undangan keterbukaan informasi publik yang berlaku.
                                        </span>
                                    </label>
                                </div>

                                {{-- Submit --}}
                                <div class="mt-6 flex justify-end">
                                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3.5 bg-sky-600 text-white font-bold rounded-xl hover:bg-sky-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 focus:ring-4 focus:ring-sky-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                        Kirim Permohonan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    {{-- TAB CONTENT: Cek Status --}}
                    <div x-show="activeTab === 'status'" 
                         x-transition:enter="transition ease-[cubic-bezier(0.2,0.8,0.2,1)] duration-700" 
                         x-transition:enter-start="opacity-0 translate-y-8 scale-[0.98]" 
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         style="display: none;">
                         
                        <div class="flex flex-col lg:flex-row overflow-hidden bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100/60 transition-transform hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] duration-500">
                            {{-- Sisi Kiri: Info Banner --}}
                            <div class="relative p-8 lg:p-10 lg:w-[45%] bg-gradient-to-br from-[#0f172a] to-[#1e293b] text-white overflow-hidden flex flex-col justify-center">
                                {{-- Ambient Glows --}}
                                <div class="absolute top-0 right-0 w-64 h-64 bg-sky-500/20 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
                                <div class="absolute bottom-0 left-0 w-48 h-48 bg-amber-500/20 rounded-full blur-2xl -ml-10 -mb-10 pointer-events-none"></div>
                                
                                <div class="relative z-10">
                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border borderwhite/20 w-fit mb-5 backdrop-blur-sm">
                                        <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                                        <span class="text-[10px] font-bold tracking-widest text-sky-100 uppercase">Pelacakan Tiket</span>
                                    </div>
                                    
                                    <h2 class="text-3xl font-black font-montserrat tracking-tight mb-4 leading-tight">
                                        Cek Status <br/>
                                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-300 to-sky-100">Permohonan</span>
                                    </h2>
                                    
                                    <p class="text-slate-300 leading-relaxed text-sm max-w-[280px]">
                                        Masukkan nomor registrasi tiket Anda untuk mengetahui tahapan dan status terkini dari permohonan informasi secara real-time.
                                    </p>
                                </div>
                            </div>
                            
                            {{-- Sisi Kanan: Form --}}
                            <div class="p-8 lg:p-10 lg:w-[55%] flex items-center justify-center bg-white relative">
                                {{-- Mobile Divider (Gradient Line) --}}
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-sky-500 to-amber-400 lg:hidden pointer-events-none"></div>
                                
                                <div class="w-full max-w-sm">
                                    <form action="#" method="GET" class="space-y-5">
                                        <div class="space-y-2">
                                            <label for="ticket" class="block text-sm font-bold text-slate-700 uppercase tracking-wide">Nomor Registrasi <span class="text-red-500">*</span></label>
                                            <div class="relative group">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-sky-500 text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                    </svg>
                                                </div>
                                                <input type="text" id="ticket" name="ticket" placeholder="Contoh: PPID-2026-001" class="block w-full pl-11 pr-4 py-4 uppercase bg-slate-50 border border-slate-200 rounded-xl text-slate-800 font-bold placeholder:text-slate-400 placeholder:font-normal placeholder:normal-case focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 transition-all duration-300" required>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-500 hover:to-sky-600 text-white font-black rounded-xl shadow-lg shadow-sky-500/20 hover:shadow-xl hover:shadow-sky-500/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 group tracking-wide">
                                            <span>LACAK PERMOHONAN</span>
                                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </button>
                                        
                                        <div class="pt-3 flex items-start gap-2.5 text-slate-500 bg-amber-50 rounded-lg p-3 border border-amber-100/50">
                                            <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <p class="text-[11px] leading-relaxed text-amber-800/80 font-medium">Nomor tiket pelacakan dikirimkan secara otomatis ke email Anda saat permohonan berhasil disubmit.</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </main>
        </div>
    </div>
</x-layouts.app>

