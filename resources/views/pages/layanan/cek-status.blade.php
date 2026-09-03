<x-layouts.app>
    {{-- ===================== PAGE HERO ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-70">
                <img src="{{ asset('images/desamahakamulu.jpg') }}" alt="Cek Status" class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/80 via-indigo-900/60 to-indigo-700/50 z-10"></div>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span></div>
                    Layanan Publik
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">Cek Status <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #818CF8 0%, #6366F1 50%, #4F46E5 100%);">Laporan</span></h1>
                <p class="mt-6 text-indigo-200 text-lg font-medium max-w-2xl mx-auto leading-relaxed">Lacak perkembangan tindak lanjut pengaduan Anda secara real-time menggunakan nomor tiket laporan.</p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-indigo-400 transition-colors">Beranda</a><span>/</span>
                    <a href="{{ route('layanan.pengaduan') }}" class="hover:text-indigo-400 transition-colors">Layanan Pengaduan</a><span>/</span>
                    <span class="text-indigo-400">Cek Status</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-16 fill-instansi-surface"><path d="M0,20 C360,0 1080,0 1440,20 L1440,60 L0,60 Z"/></svg></div>
    </section>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-12 py-14" x-data="cekStatus()">
        {{-- Search Box --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden mb-8" data-aos="fade-up">
            <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-indigo-50 towhite">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Lacak Status Pengaduan</h2>
                        <p class="text-xs text-slate-500">Masukkan nomor tiket yang Anda terima saat submit pengaduan</p>
                    </div>
                </div>
            </div>
            <div class="px-8 py-6">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <input type="text" x-model="nomorTiket" @keydown.enter="cariLaporan"
                               placeholder="Contoh: LPR-2025-12345"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all uppercase tracking-wider">
                    </div>
                    <button @click="cariLaporan"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-sm transition-all active:scale-95 shadow-lg shadow-indigo-200 flex items-center gap-2 justify-center">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari
                    </button>
                </div>
                <p x-show="errorMsg" class="text-xs text-red-500 mt-2 font-medium" x-text="errorMsg"></p>
            </div>
        </div>

        {{-- Result --}}
        <div x-show="result" x-cloak data-aos="fade-up"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-6"
             x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                {{-- Status Header --}}
                <div class="px-8 py-6 border-b border-slate-100"
                     :class="result && result.status === 'selesai' ? 'bg-emerald-50' : result && result.status === 'proses' ? 'bg-sky-50' : 'bg-amber-50'">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <p class="text-xs text-slate-500 font-medium mb-1">Nomor Tiket</p>
                            <p class="font-black text-xl text-slate-800 tracking-wider" x-text="result && result.tiket"></p>
                        </div>
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold"
                              :class="result && result.status === 'selesai' ? 'bg-emerald-100 text-emerald-700' : result && result.status === 'proses' ? 'bg-sky-100 text-sky-700' : 'bg-amber-100 text-amber-700'">
                            <span class="w-2 h-2 rounded-full animate-pulse"
                                  :class="result && result.status === 'selesai' ? 'bg-emerald-500' : result && result.status === 'proses' ? 'bg-sky-500' : 'bg-amber-500'"></span>
                            <span x-text="result && result.statusLabel"></span>
                        </span>
                    </div>
                </div>

                {{-- Detail --}}
                <div class="px-8 py-6 grid grid-cols-1 sm:grid-cols-2 gap-5 border-b border-slate-100">
                    <div>
                        <p class="text-xs text-slate-400 font-medium mb-1">Nama Pelapor</p>
                        <p class="text-sm font-semibold text-slate-700" x-text="result && result.nama"></p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium mb-1">Jenis Pengaduan</p>
                        <p class="text-sm font-semibold text-slate-700" x-text="result && result.jenis"></p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium mb-1">Tanggal Masuk</p>
                        <p class="text-sm font-semibold text-slate-700" x-text="result && result.tanggalMasuk"></p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium mb-1">Target Selesai</p>
                        <p class="text-sm font-semibold text-slate-700" x-text="result && result.targetSelesai"></p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-xs text-slate-400 font-medium mb-1">Subjek</p>
                        <p class="text-sm font-semibold text-slate-700" x-text="result && result.subjek"></p>
                    </div>
                </div>

                {{-- Progress Timeline --}}
                <div class="px-8 py-6">
                    <h3 class="text-sm font-bold text-slate-700 mb-5">Riwayat Tindak Lanjut</h3>
                    <div class="relative">
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-slate-100"></div>
                        <template x-for="(log, i) in (result && result.logs || [])" :key="i">
                            <div class="relative flex gap-4 pb-6 last:pb-0">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 z-10 relative"
                                     :class="log.done ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400'">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="flex-1 pt-0.5">
                                    <p class="text-sm font-bold text-slate-800" x-text="log.label"></p>
                                    <p class="text-xs text-slate-500 mt-0.5" x-text="log.waktu"></p>
                                    <p class="text-xs text-slate-600 mt-1 leading-relaxed" x-show="log.keterangan" x-text="log.keterangan"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        {{-- Empty state --}}
        <div x-show="!result && searched" x-cloak class="bg-white rounded-3xl border border-slate-200 py-16 text-center shadow-sm" data-aos="fade-up">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <h3 class="text-lg font-bold text-slate-700 mb-2">Nomor Tiket Tidak Ditemukan</h3>
            <p class="text-sm text-slate-500 max-w-sm mx-auto">Pastikan nomor tiket yang Anda masukkan benar, atau hubungi kami jika membutuhkan bantuan.</p>
        </div>
    </div>

    <script>
    function cekStatus() {
        return {
            nomorTiket: '',
            result: null,
            searched: false,
            errorMsg: '',
            demoData: {
                'LPR-2025-12345': {
                    tiket: 'LPR-2025-12345', nama: 'Ahmad Wahyudi', jenis: 'Pengaduan Layanan',
                    subjek: 'Lambatnya respon pelayanan di loket administrasi',
                    tanggalMasuk: '10 Februari 2025', targetSelesai: '17 Februari 2025',
                    status: 'selesai', statusLabel: 'Selesai',
                    logs: [
                        { label: 'Pengaduan Diterima', waktu: '10 Feb 2025, 09:15', keterangan: 'Laporan Anda telah diterima dan dicatat dalam sistem.', done: true },
                        { label: 'Verifikasi Laporan', waktu: '10 Feb 2025, 14:30', keterangan: 'Laporan sedang diverifikasi oleh Tim PPID.', done: true },
                        { label: 'Disposisi ke Unit Terkait', waktu: '11 Feb 2025, 08:00', keterangan: 'Laporan diteruskan ke Bagian Pelayanan Publik.', done: true },
                        { label: 'Proses Tindak Lanjut', waktu: '13 Feb 2025, 10:00', keterangan: 'Unit terkait sedang memproses dan menyiapkan jawaban.', done: true },
                        { label: 'Pengaduan Diselesaikan', waktu: '15 Feb 2025, 16:00', keterangan: 'Pengaduan telah ditindaklanjuti. Terima kasih atas laporan Anda.', done: true },
                    ]
                },
                'LPR-2025-99876': {
                    tiket: 'LPR-2025-99876', nama: 'Siti Rahayu', jenis: 'Infrastruktur & Fasilitas',
                    subjek: 'Jalan rusak di Kecamatan Long Bagun',
                    tanggalMasuk: '25 Februari 2025', targetSelesai: '04 Maret 2025',
                    status: 'proses', statusLabel: 'Sedang Diproses',
                    logs: [
                        { label: 'Pengaduan Diterima', waktu: '25 Feb 2025, 11:00', keterangan: 'Laporan Anda telah diterima dan dicatat dalam sistem.', done: true },
                        { label: 'Verifikasi Laporan', waktu: '25 Feb 2025, 15:00', keterangan: 'Laporan telah diverifikasi.', done: true },
                        { label: 'Disposisi ke Unit Terkait', waktu: '26 Feb 2025, 09:00', keterangan: 'Diteruskan ke Dinas PUPR Kab. Mahakam Ulu.', done: true },
                        { label: 'Proses Tindak Lanjut', waktu: '27 Feb 2025, 08:00', keterangan: 'Tinjauan lapangan sedang dijadwalkan.', done: false },
                        { label: 'Pengaduan Diselesaikan', waktu: '-', keterangan: '', done: false },
                    ]
                }
            },
            cariLaporan() {
                this.errorMsg = '';
                const tiket = this.nomorTiket.trim().toUpperCase();
                if (!tiket) { this.errorMsg = 'Masukkan nomor tiket terlebih dahulu'; return; }
                if (!/^LPR-\d{4}-\d+$/i.test(tiket)) { this.errorMsg = 'Format nomor tiket tidak valid. Contoh: LPR-2025-12345'; return; }
                this.searched = true;
                this.result = this.demoData[tiket] || null;
            }
        }
    }
    </script>
</x-layouts.app>
