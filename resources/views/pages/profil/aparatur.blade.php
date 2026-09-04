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
                    <linearGradient id="riverGoldAparatur" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#10192d" stop-opacity="0"/>
                        <stop offset="30%" stop-color="#10192d" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="#10192d" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <path d="M-50,180 C200,120 400,240 720,160 S1100,80 1500,200" fill="none" stroke="url(#riverGoldAparatur)" stroke-width="2"/>
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
                    Aparatur <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #10192d 0%, #F59E0B 50%, #D97706 100%);">Kami</span>
                </h1>
                <p class="text-black/90 text-lg font-medium max-w-2xl leading-relaxed">
                    Sumber daya manusia yang profesional dan berdedikasi dalam melayani pembangunan Kabupaten Mahakam Ulu.
                </p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-[#274CA5] transition-colors">Beranda</a>
                    <span>/</span>
                    <span class="text-[#274CA5]">Aparatur</span>
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

        {{-- Stats Row --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-14" data-aos="fade-up">
            @foreach([
                ['label' => 'Total Aparatur', 'value' => '48', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0', 'color' => 'sky'],
                ['label' => 'Pejabat Struktural', 'value' => '12', 'icon' => 'M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'yellow'],
                ['label' => 'Staf Fungsional', 'value' => '24', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'color' => 'emerald'],
                ['label' => 'Tenaga Kontrak', 'value' => '12', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'violet'],
            ] as $stat)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 flex flex-col items-center text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-{{ $stat['color'] }}-100 flex items-center justify-center text-{{ $stat['color'] }}-600 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
                <div class="text-3xl font-black text-slate-800">{{ $stat['value'] }}</div>
                <div class="text-sm text-slate-500 font-medium mt-1">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>

        {{-- ===== PEJABAT STRUKTURAL ===== --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1 h-8 bg-gradient-to-b from-blue-400 to-blue-900 rounded-full"></div>
                <h2 class="text-xl font-bold text-slate-800">Pejabat Struktural</h2>
            </div>

            @php
                $pejabatStruktural = [
                    ['nama' => 'Yohanes Andy Abeh, S.Sos., M.Si.', 'nip' => '19750315 200012 1 003', 'jabatan' => 'Kepala Badan', 'golongan' => 'IV/b', 'color' => 'sky'],
                    ['nama' => 'Drs. Markus Lenjau, M.AP.', 'nip' => '19680722 199303 1 008', 'jabatan' => 'Sekretaris', 'golongan' => 'IV/a', 'color' => 'blue'],
                    ['nama' => 'Ir. Siti Rahmawati, M.T.', 'nip' => '19800410 200502 2 004', 'jabatan' => 'Kabid Protokol', 'golongan' => 'III/d', 'color' => 'indigo'],
                    ['nama' => 'Hendra Wijaya, S.E., M.Si.', 'nip' => '19820915 200604 1 012', 'jabatan' => 'Kabid Komunikasi Pimpinan', 'golongan' => 'III/d', 'color' => 'violet'],
                    ['nama' => 'Theresia Lungo, S.T., M.T.', 'nip' => '19790205 200312 2 006', 'jabatan' => 'Kabid Dokumentasi & Pemberitaan', 'golongan' => 'III/d', 'color' => 'emerald'],
                    ['nama' => 'Dr. Robertus Imang, M.Si.', 'nip' => '19770118 200101 1 005', 'jabatan' => 'Kabid Hubungan Masyarakat & Informasi Publik', 'golongan' => 'III/d', 'color' => 'amber'],
                ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-5">
                @foreach($pejabatStruktural as $pejabat)
                <div class="relative group rounded-2xl border border-slate-100 bg-white overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    {{-- Photo Area --}}
                    <div class="relative aspect-[3/4] bg-gradient-to-b from-{{ $pejabat['color'] }}-50 to-{{ $pejabat['color'] }}-100 flex items-center justify-center overflow-hidden">
                        <svg class="w-28 h-28 text-{{ $pejabat['color'] }}-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        {{-- Golongan Badge --}}
                        <span class="absolute top-3 right-3 px-2.5 py-1 rounded-lg bg-white/90 backdrop-blur text-{{ $pejabat['color'] }}-700 text-[10px] font-black border border-{{ $pejabat['color'] }}-200 shadow-sm">
                            {{ $pejabat['golongan'] }}
                        </span>
                    </div>

                    {{-- Info --}}
                    <div class="p-5">
                        <span class="inline-flex px-3 py-1 rounded-full bg-{{ $pejabat['color'] }}-50 text-{{ $pejabat['color'] }}-600 text-[10px] font-bold uppercase tracking-wider border border-{{ $pejabat['color'] }}-100 mb-3">
                            {{ $pejabat['jabatan'] }}
                        </span>
                        <h3 class="font-bold text-slate-800 text-sm leading-snug" title="{{ $pejabat['nama'] }}">{{ $pejabat['nama'] }}</h3>
                        <p class="text-[10px] text-slate-400 font-medium mt-2">NIP: {{ $pejabat['nip'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ===== KASUBAG & STAF FUNGSIONAL ===== --}}
        @php
            $bidangData = [
                [
                    'title' => 'Sekretariat',
                    'color' => 'blue',
                    'staf' => [
                        ['nama' => 'Agustina Lenjau, S.E.', 'nip' => '19850812 200901 2 009', 'jabatan' => 'Kasubag Umum & Kepegawaian', 'golongan' => 'III/c'],
                        ['nama' => 'Petrus Keling, S.Ak.', 'nip' => '19881020 201201 1 015', 'jabatan' => 'Kasubag Keuangan & Aset', 'golongan' => 'III/c'],
                        ['nama' => 'Maria Udau', 'nip' => '19900315 201503 2 022', 'jabatan' => 'Pengelola Administrasi', 'golongan' => 'II/c'],
                        ['nama' => 'Yohanes Bato', 'nip' => '19920605 201901 1 031', 'jabatan' => 'Pengadministrasi Umum', 'golongan' => 'II/b'],
                    ],
                ],
                [
                    'title' => 'Bidang Protokol',
                    'color' => 'indigo',
                    'staf' => [
                        ['nama' => 'Andi Prasetyo, S.T.', 'nip' => '19870422 201101 1 018', 'jabatan' => 'Analis Keprotokolan', 'golongan' => 'III/c'],
                        ['nama' => 'Novita Sari, S.E.', 'nip' => '19910810 201504 2 025', 'jabatan' => 'Penyusun Acara & Tata Upacara', 'golongan' => 'III/b'],
                        ['nama' => 'Cornelius Laing, S.Si.', 'nip' => '19930115 202001 1 035', 'jabatan' => 'Pengelola Layanan Tamu Pimpinan', 'golongan' => 'III/a'],
                    ],
                ],
                [
                    'title' => 'Bidang Komunikasi Pimpinan',
                    'color' => 'violet',
                    'staf' => [
                        ['nama' => 'Fransiska Njuk, S.Sos.', 'nip' => '19860930 200903 2 011', 'jabatan' => 'Analis Komunikasi Pimpinan', 'golongan' => 'III/c'],
                        ['nama' => 'Daniel Usang, S.IP.', 'nip' => '19890718 201305 1 020', 'jabatan' => 'Pengelola Agenda & Jadwal Pimpinan', 'golongan' => 'III/b'],
                        ['nama' => 'Rosalina Belawan, S.Pd.', 'nip' => '19940225 202101 2 038', 'jabatan' => 'Pengadministrasi Persuratan Pimpinan', 'golongan' => 'III/a'],
                    ],
                ],
                [
                    'title' => 'Bidang Dokumentasi & Pemberitaan',
                    'color' => 'emerald',
                    'staf' => [
                        ['nama' => 'Stefanus Liah, S.T.', 'nip' => '19880312 201201 1 016', 'jabatan' => 'Pranata Dokumentasi', 'golongan' => 'III/c'],
                        ['nama' => 'Yuliana Apui, S.E.', 'nip' => '19910608 201504 2 026', 'jabatan' => 'Analis Pemberitaan', 'golongan' => 'III/b'],
                        ['nama' => 'Mikhael Avun, S.Hut.', 'nip' => '19930720 202001 1 036', 'jabatan' => 'Pranata Multimedia', 'golongan' => 'III/a'],
                        ['nama' => 'Bernadus Along', 'nip' => '19950415 202201 1 042', 'jabatan' => 'Pengadministrasi Teknis', 'golongan' => 'II/c'],
                    ],
                ],
                [
                    'title' => 'Bidang Hubungan Masyarakat & Informasi Publik',
                    'color' => 'amber',
                    'staf' => [
                        ['nama' => 'Melkianus Suang, S.Si., M.Si.', 'nip' => '19860115 200903 1 010', 'jabatan' => 'Analis Hubungan Masyarakat', 'golongan' => 'III/c'],
                        ['nama' => 'Christina Lawing, S.Sos.', 'nip' => '19900430 201504 2 024', 'jabatan' => 'Pengelola Layanan Informasi Publik (PPID)', 'golongan' => 'III/b'],
                        ['nama' => 'Alfonsus Baya, S.Kom.', 'nip' => '19940810 202101 1 040', 'jabatan' => 'Pengelola Sistem Informasi', 'golongan' => 'III/a'],
                    ],
                ],
            ];
        @endphp

        @foreach($bidangData as $bdx => $bidang)
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 mt-8" data-aos="fade-up" data-aos-delay="{{ ($bdx + 2) * 50 }}">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-{{ $bidang['color'] }}-400 to-{{ $bidang['color'] }}-600 rounded-full"></div>
                <h2 class="text-lg font-bold text-slate-800">{{ $bidang['title'] }}</h2>
                <span class="ml-auto px-3 py-1 rounded-full bg-{{ $bidang['color'] }}-50 text-{{ $bidang['color'] }}-600 text-xs font-bold border border-{{ $bidang['color'] }}-100">{{ count($bidang['staf']) }} orang</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($bidang['staf'] as $staf)
                <div class="rounded-2xl border border-slate-100 bg-white overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                    {{-- Photo Area --}}
                    <div class="relative aspect-square bg-gradient-to-b from-{{ $bidang['color'] }}-50 to-{{ $bidang['color'] }}-100 flex items-center justify-center">
                        <svg class="w-20 h-20 text-{{ $bidang['color'] }}-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <span class="absolute top-2 right-2 px-1.5 py-0.5 rounded-md bg-white/90 backdrop-blur text-{{ $bidang['color'] }}-600 text-[9px] font-bold border border-{{ $bidang['color'] }}-100">{{ $staf['golongan'] }}</span>
                    </div>

                    {{-- Info --}}
                    <div class="p-4">
                        <h4 class="font-bold text-slate-800 text-xs leading-snug line-clamp-2" title="{{ $staf['nama'] }}">{{ $staf['nama'] }}</h4>
                        <p class="text-{{ $bidang['color'] }}-600 text-[10px] font-semibold mt-1">{{ $staf['jabatan'] }}</p>
                        <p class="text-[9px] text-slate-400 font-medium mt-2 pt-2 border-t border-slate-100">{{ $staf['nip'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</x-layouts.app>
