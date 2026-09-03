<x-layouts.app>
    <x-slot name="metaDescription">
        Whistleblowing System (WBS) - Sistem Pelaporan Pelanggaran PROKOPIM Kabupaten Mahakam Ulu. Laporkan indikasi tindak pidana korupsi atau pelanggaran lainnya secara rahasia dan aman.
    </x-slot>

    {{-- ===================== PAGE HERO ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-70">
                <img src="{{ asset('images/desamahakamulu.jpg') }}" alt="WBS" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="" class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/90 via-red-900/70 to-red-700/60 z-10"></div>
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="wbsPG" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#EF4444" stop-opacity="0"/><stop offset="40%" stop-color="#EF4444" stop-opacity="0.15"/><stop offset="100%" stop-color="#EF4444" stop-opacity="0"/></linearGradient></defs><path d="M-50,200 C300,100 600,280 900,160 S1200,60 1500,180" fill="none" stroke="url(#wbsPG)" stroke-width="2"/></svg>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span></div>
                    Whistleblowing System
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">Layanan <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #FCA5A5 0%, #EF4444 50%, #B91C1C 100%);">WBS</span></h1>
                <p class="mt-6 text-red-100 text-lg font-medium max-w-2xl mx-auto leading-relaxed">Sistem pelaporan pelanggaran yang terjadi di lingkungan PROKOPIM. Identitas Anda akan kami <span class="text-white font-bold bg-red-500/30 px-2 py-0.5 rounded">rahasiakan</span>.</p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-red-400 transition-colors">Beranda</a><span>/</span><span class="text-red-400">WBS</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-16 fill-instansi-surface"><path d="M0,20 C360,0 1080,0 1440,20 L1440,60 L0,60 Z"/></svg></div>
    </section>

    {{-- ===================== STAT CARDS ===================== --}}
    <div class="bg-instansi-surface relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-4 pb-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" data-aos="fade-up">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-6 py-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-slate-800">Aman</p>
                        <p class="text-xs text-slate-500 font-medium">Sistem Enkripsi Ketat</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-6 py-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-slate-800">Rahasia</p>
                        <p class="text-xs text-slate-500 font-medium">Identitas Dilindungi</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-6 py-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-slate-800">Cepat</p>
                        <p class="text-xs text-slate-500 font-medium">Tindak Lanjut Segera</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MAIN CONTENT ===================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- â”€â”€ Form WBS â”€â”€ --}}
            <div class="lg:col-span-2" data-aos="fade-right">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    {{-- Form Header --}}
                    <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-red-50 towhite">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Form Laporan WBS</h2>
                                <p class="text-xs text-red-500 font-medium">Data Anda aman dan dijamin kerahasiaannya</p>
                            </div>
                        </div>
                    </div>

                    {{-- Form Body --}}
                    <form class="px-8 py-7 space-y-6" x-data="wbsForm()" @submit.prevent="submitForm">
                        
                        {{-- Opsi Anonim --}}
                        <div class="bg-red-50/50 border border-red-100 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Identitas Pelapor</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Anda bisa memilih untuk merahasiakan identitas (anonim).</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="form.anonim" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:borderwhite after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                                <span class="ml-3 text-sm font-semibold text-slate-700" x-text="form.anonim ? 'Sembunyikan Identitas' : 'Tampilkan Identitas'"></span>
                            </label>
                        </div>

                        {{-- Informasi Pelapor (Sembunyi jika anonim) --}}
                        <div x-show="!form.anonim" x-transition.opacity>
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                Informasi Anda
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nama Lengkap</label>
                                    <input type="text" x-model="form.nama" placeholder="Masukkan nama (opsional)"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-100 transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nomor HP / WA</label>
                                    <input type="tel" x-model="form.telepon" placeholder="Nomor kontak (opsional)"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-100 transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100" x-show="!form.anonim"></div>

                        {{-- Detail Laporan --}}
                        <div>
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                Detail Pelanggaran
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Jenis Indikasi Pelanggaran <span class="text-red-500">*</span></label>
                                    <select x-model="form.jenis"
                                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-100 transition-all cursor-pointer"
                                            :class="errors.jenis ? 'border-red-400 ring-2 ring-red-100' : ''">
                                        <option value="">-- Pilih Jenis Pelanggaran --</option>
                                        <option value="korupsi">Tindak Pidana Korupsi</option>
                                        <option value="gratifikasi">Pungutan Liar / Gratifikasi</option>
                                        <option value="benturan">Benturan Kepentingan</option>
                                        <option value="suap">Penyuapan / Pemerasan</option>
                                        <option value="disiplin">Pelanggaran Disiplin Pegawai</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <p x-show="errors.jenis" class="text-[11px] text-red-500 mt-1 font-medium" x-text="errors.jenis"></p>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nama Pihak Yang Dilaporkan <span class="text-red-500">*</span></label>
                                        <input type="text" x-model="form.terlapor" placeholder="Siapa yang terlibat?"
                                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-100 transition-all"
                                               :class="errors.terlapor ? 'border-red-400 ring-2 ring-red-100' : ''">
                                        <p x-show="errors.terlapor" class="text-[11px] text-red-500 mt-1 font-medium" x-text="errors.terlapor"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Perkiraan Waktu Kejadian</label>
                                        <input type="date" x-model="form.waktu"
                                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-100 transition-all cursor-pointer">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Uraian / Kronologi Kejadian <span class="text-red-500">*</span></label>
                                    <textarea x-model="form.isi" rows="6" placeholder="Jelaskan dengan menjawab unsur: What (Apa), Where (Dimana), When (Kapan), Who (Siapa), Why (Mengapa), dan How (Bagaimana)..."
                                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-100 transition-all resize-none"
                                              :class="errors.isi ? 'border-red-400 ring-2 ring-red-100' : ''"></textarea>
                                    <div class="flex justify-between items-center mt-1">
                                        <p x-show="errors.isi" class="text-[11px] text-red-500 font-medium" x-text="errors.isi"></p>
                                        <p class="text-[11px] text-slate-400 ml-auto" x-text="form.isi.length + ' / 2000 karakter'"></p>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Bukti Lampiran <span class="text-slate-400 font-normal">(Dokumen, Foto, Video | maks. 10MB)</span></label>
                                    <label class="w-full flex flex-col items-center justify-center px-4 py-6 rounded-xl border-2 border-dashed border-slate-200 hover:border-red-400 hover:bg-red-50/40 transition-all cursor-pointer group">
                                        <svg class="w-8 h-8 text-slate-400 group-hover:text-red-500 mb-2 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                        <span class="text-sm font-medium text-slate-500 group-hover:text-red-600 transition-colors" x-text="fileName || 'Klik untuk unggah file bukti'"></span>
                                        <span class="text-[11px] text-slate-400 mt-0.5" x-show="!fileName">Sangat disarankan melampirkan bukti agar laporan mudah ditindaklanjuti.</span>
                                        <input type="file" class="hidden" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.mp4" @change="handleFile($event)">
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Konfirmasi --}}
                        <div class="bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 flex items-start gap-3">
                            <input type="checkbox" x-model="form.konfirmasi" id="konfirmasi" class="mt-0.5 w-4 h-4 accent-red-500 cursor-pointer">
                            <label for="konfirmasi" class="text-xs text-slate-600 leading-relaxed cursor-pointer">
                                Saya menyatakan bahwa laporan ini dibuat dengan <span class="font-semibold text-red-800">itikad baik, bukan fitnah/pengaduan palsu</span>, dan berdasarkan fakta yang saya ketahui.
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-3 py-3.5 px-6 rounded-xl font-bold text-sm transition-all duration-200 active:scale-[0.98]"
                                :class="form.konfirmasi ? 'bg-red-600 hover:bg-red-700 text-white shadow-lg shadow-red-200' : 'bg-slate-100 text-slate-400 cursor-not-allowed'"
                                :disabled="!form.konfirmasi || isSubmitting">
                            <template x-if="!isSubmitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                    Kirim Laporan WBS
                                </span>
                            </template>
                            <template x-if="isSubmitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Mengenkripsi data & mengirim...
                                </span>
                            </template>
                        </button>

                        {{-- Success Message --}}
                        <div x-show="submitted" x-cloak
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-5 flex flex-col gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-emerald-800 text-sm">Laporan WBS Terkirim!</h4>
                                    <p class="text-emerald-700 text-xs mt-0.5">Keamanan Anda terjamin.</p>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded-xl border border-emerald-100 mt-2">
                                <p class="text-xs text-slate-500 mb-1">Tiket Laporan Anda:</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-lg font-black tracking-widest text-slate-800" x-text="ticketNumber"></span>
                                    <button type="button" @click="navigator.clipboard.writeText(ticketNumber); alert('Nomor tiket disalin!')" class="text-sky-500 hover:text-sky-700" title="Salin">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>
                                </div>
                                <p class="text-[11px] text-red-500 font-medium mt-2 leading-tight">Harap CATAT dan SIMPAN kode ini. Kami tidak dapat mengirimkan kembali melalui email atau SMS demi menjaga kerahasiaan pelapor.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- â”€â”€ Sidebar â”€â”€ --}}
            <div class="space-y-5" data-aos="fade-left" data-aos-delay="100">

                {{-- Kebijakan WBS --}}
                <div class="bg-white rounded-2xl border border-red-200 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-red-100 bg-red-50/80">
                        <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Kerahasiaan Dijamin
                        </h3>
                    </div>
                    <div class="px-5 py-4">
                        <p class="text-xs text-slate-600 leading-relaxed text-justify">
                            PROKOPIM Kabupaten Mahakam Ulu akan <strong>merahasiakan identitas pelapor</strong> sesuai kebijakan dan peraturan peundang-undangan yang berlaku. <br><br>
                            Fokus kami adalah pada <span class="bg-slate-100 px-1 py-0.5 rounded text-slate-800 font-medium">materi informasi</span> yang Anda laporkan. Laporan yang masuk akan ditelaah oleh Tim Inspektorat Wilayah atau pejabat berwenang khusus, dan tidak melibatkan pihak yang dilaporkan dalam proses investigasi.
                        </p>
                    </div>
                </div>

                {{-- Kriteria Laporan --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
                        <h3 class="text-sm font-bold text-slate-800">Unsur Pengaduan 5W+1H</h3>
                    </div>
                    <div class="px-5 py-4 space-y-3">
                        <p class="text-[11px] text-slate-500 leading-relaxed mb-1">Pengaduan Anda akan mudah ditindaklanjuti apabila memenuhi unsur berikut:</p>
                        @foreach([
                            ['txt' => 'What', 'desc' => 'Perbuatan indikasi penyimpangan apa yang terjadi'],
                            ['txt' => 'Where', 'desc' => 'Dimana lokasi tempat terjadinya (Unit Kerja)'],
                            ['txt' => 'When', 'desc' => 'Kapan perbuatan waktu kejadian tersebut terjadi'],
                            ['txt' => 'Who', 'desc' => 'Siapa saja pihak yang terkait atau terlibat'],
                            ['txt' => 'Why', 'desc' => 'Mengapa perbuatan penyimpangan tersebut dilakukan'],
                            ['txt' => 'How', 'desc' => 'Bagaimana cara perbuatan tersebut dilakukan'],
                        ] as $item)
                        <div class="flex items-start gap-2">
                            <span class="w-[45px] text-[10px] font-bold text-sky-600 pt-0.5 shrink-0">{{ $item['txt'] }}</span>
                            <span class="text-[11px] text-slate-600">:</span>
                            <p class="text-[11px] text-slate-600 leading-relaxed pt-0.5 flex-1">{{ $item['desc'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
    function wbsForm() {
        return {
            form: { anonim: true, nama: '', telepon: '', jenis: '', terlapor: '', waktu: '', isi: '', konfirmasi: false },
            errors: {},
            isSubmitting: false,
            submitted: false,
            ticketNumber: '',
            fileName: '',
            handleFile(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 10 * 1024 * 1024) {
                        alert('Ukuran file maksimal 10MB.');
                        e.target.value = '';
                        return;
                    }
                    this.fileName = file.name;
                }
            },
            validate() {
                this.errors = {};
                if (!this.form.jenis) this.errors.jenis = 'Pilih jenis indikasi pelanggaran';
                if (!this.form.terlapor.trim()) this.errors.terlapor = 'Nama terlapor wajib diuraikan';
                if (!this.form.isi.trim()) this.errors.isi = 'Uraian kejadian wajib diisi minimum 30 karakter';
                else if (this.form.isi.length < 30) this.errors.isi = 'Isi laporan terlalu singkat. Jelaskan kronologi kejadian secara memadai.';
                return Object.keys(this.errors).length === 0;
            },
            submitForm() {
                if (!this.validate() || !this.form.konfirmasi) return;
                this.isSubmitting = true;
                setTimeout(() => {
                    this.ticketNumber = 'WBS-' + Math.random().toString(36).substr(2, 8).toUpperCase();
                    this.isSubmitting = false;
                    this.submitted = true;
                    // Reset fields except anonim
                    this.form = { anonim: this.form.anonim, nama: '', telepon: '', jenis: '', terlapor: '', waktu: '', isi: '', konfirmasi: false };
                    this.fileName = '';
                }, 2000);
            }
        }
    }
    </script>
</x-layouts.app>

