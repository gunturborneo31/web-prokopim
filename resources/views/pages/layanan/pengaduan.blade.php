<x-layouts.app>
    {{-- ===================== PAGE HERO ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-70">
                <img src="{{ asset('images/desamahakamulu.jpg') }}" alt="Pengaduan" class="w-full h-full object-cover">
            </div>
            <img src="{{ asset('images/Desain tanpa judul.svg') }}" alt="" class="absolute inset-0 w-full h-full object-cover z-0 opacity-10 mix-blend-screen" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/80 via-sky-900/60 to-sky-700/50 z-10"></div>
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1440 400" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="layPG" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#38BDF8" stop-opacity="0"/><stop offset="40%" stop-color="#38BDF8" stop-opacity="0.15"/><stop offset="100%" stop-color="#38BDF8" stop-opacity="0"/></linearGradient></defs><path d="M-50,200 C300,100 600,280 900,160 S1200,60 1500,180" fill="none" stroke="url(#layPG)" stroke-width="2"/></svg>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-sky-500"></span></div>
                    Layanan Publik
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">Layanan <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #38BDF8 0%, #0EA5E9 50%, #0284C7 100%);">Pengaduan</span></h1>
                <p class="mt-3 text-black/90 text-lg font-medium max-w-2xl leading-relaxed">Sampaikan pengaduan, saran, atau masukan Anda kepada kami. Setiap laporan akan ditindaklanjuti secara transparan dan bertanggung jawab.</p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-sky-400 transition-colors">Beranda</a><span>/</span><span class="text-sky-400">Layanan Pengaduan</span>
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
                    <div class="w-12 h-12 bg-sky-50 rounded-xl flex items-center justify-center text-sky-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-slate-800">248</p>
                        <p class="text-xs text-slate-500 font-medium">Total Pengaduan Masuk</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-6 py-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-slate-800">213</p>
                        <p class="text-xs text-slate-500 font-medium">Pengaduan Selesai</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-6 py-5 flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-slate-800">35</p>
                        <p class="text-xs text-slate-500 font-medium">Pengaduan Diproses</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MAIN CONTENT ===================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ── Form Pengaduan ── --}}
            <div class="lg:col-span-2" data-aos="fade-right">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    {{-- Form Header --}}
                    <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-sky-50 towhite">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Form Pengaduan</h2>
                                <p class="text-xs text-slate-500">Isi formulir di bawah ini dengan lengkap dan jelas</p>
                            </div>
                        </div>
                    </div>

                    {{-- Form Body --}}
                    <form class="px-8 py-7 space-y-6" x-data="pengaduanForm()" @submit.prevent="submitForm">
                        {{-- Informasi Pelapor --}}
                        <div>
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                Informasi Pelapor
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="form.nama" placeholder="Masukkan nama lengkap"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-all"
                                           :class="errors.nama ? 'border-red-400 ring-2 ring-red-100' : ''">
                                    <p x-show="errors.nama" class="text-[11px] text-red-500 mt-1 font-medium" x-text="errors.nama"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nomor HP / WA <span class="text-red-500">*</span></label>
                                    <input type="tel" x-model="form.telepon" placeholder="08xxxxxxxxxx"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-all"
                                           :class="errors.telepon ? 'border-red-400 ring-2 ring-red-100' : ''">
                                    <p x-show="errors.telepon" class="text-[11px] text-red-500 mt-1 font-medium" x-text="errors.telepon"></p>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Email <span class="text-slate-400 font-normal">(opsional)</span></label>
                                    <input type="email" x-model="form.email" placeholder="nama@email.com"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100"></div>

                        {{-- Detail Pengaduan --}}
                        <div>
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                Detail Pengaduan
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Jenis Pengaduan <span class="text-red-500">*</span></label>
                                    <select x-model="form.jenis"
                                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-all cursor-pointer"
                                            :class="errors.jenis ? 'border-red-400 ring-2 ring-red-100' : ''">
                                        <option value="">-- Pilih Jenis Pengaduan --</option>
                                        <option value="layanan">Pengaduan Layanan</option>
                                        <option value="aparatur">Pengaduan Aparatur</option>
                                        <option value="infrastruktur">Infrastruktur & Fasilitas</option>
                                        <option value="korupsi">Dugaan Korupsi</option>
                                        <option value="saran">Saran & Masukan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <p x-show="errors.jenis" class="text-[11px] text-red-500 mt-1 font-medium" x-text="errors.jenis"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Subjek Pengaduan <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="form.subjek" placeholder="Ringkasan singkat pengaduan Anda"
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-all"
                                           :class="errors.subjek ? 'border-red-400 ring-2 ring-red-100' : ''">
                                    <p x-show="errors.subjek" class="text-[11px] text-red-500 mt-1 font-medium" x-text="errors.subjek"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Isi Pengaduan <span class="text-red-500">*</span></label>
                                    <textarea x-model="form.isi" rows="5" placeholder="Uraikan pengaduan Anda secara lengkap dan detail, termasuk waktu dan tempat kejadian..."
                                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition-all resize-none"
                                              :class="errors.isi ? 'border-red-400 ring-2 ring-red-100' : ''"></textarea>
                                    <div class="flex justify-between items-center mt-1">
                                        <p x-show="errors.isi" class="text-[11px] text-red-500 font-medium" x-text="errors.isi"></p>
                                        <p class="text-[11px] text-slate-400 ml-auto" x-text="form.isi.length + ' / 1000 karakter'"></p>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Lampiran <span class="text-slate-400 font-normal">(opsional, maks. 5MB)</span></label>
                                    <label class="w-full flex flex-col items-center justify-center px-4 py-6 rounded-xl border-2 border-dashed border-slate-200 hover:border-sky-400 hover:bg-sky-50/40 transition-all cursor-pointer group">
                                        <svg class="w-8 h-8 text-slate-400 group-hover:text-sky-500 mb-2 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                        <span class="text-sm font-medium text-slate-500 group-hover:text-sky-600 transition-colors" x-text="fileName || 'Klik untuk unggah file'"></span>
                                        <span class="text-[11px] text-slate-400 mt-0.5">JPG, PNG, PDF didukung</span>
                                        <input type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" @change="handleFile($event)">
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Captcha / Konfirmasi --}}
                        <div class="bg-slate-50 rounded-2xl px-5 py-4 flex items-start gap-3">
                            <input type="checkbox" x-model="form.konfirmasi" id="konfirmasi" class="mt-0.5 w-4 h-4 accent-sky-500 cursor-pointer">
                            <label for="konfirmasi" class="text-xs text-slate-600 leading-relaxed cursor-pointer">
                                Saya menyatakan bahwa informasi yang saya sampaikan adalah <span class="font-semibold text-slate-800">benar dan dapat dipertanggungjawabkan</span>. Saya memahami bahwa laporan palsu dapat dikenakan sanksi hukum.
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-3 py-3.5 px-6 rounded-xl font-bold text-sm transition-all duration-200 active:scale-[0.98]"
                                :class="form.konfirmasi ? 'bg-sky-600 hover:bg-sky-700 text-white shadow-lg shadow-sky-200' : 'bg-slate-100 text-slate-400 cursor-not-allowed'"
                                :disabled="!form.konfirmasi || isSubmitting">
                            <template x-if="!isSubmitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                    Kirim Pengaduan
                                </span>
                            </template>
                            <template x-if="isSubmitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Mengirim...
                                </span>
                            </template>
                        </button>

                        {{-- Success Message --}}
                        <div x-show="submitted" x-cloak
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-5 flex items-start gap-4">
                            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-emerald-800 text-sm">Pengaduan Berhasil Terkirim!</h4>
                                <p class="text-emerald-700 text-xs mt-1 leading-relaxed">Nomor tiket Anda: <span class="font-bold" x-text="ticketNumber"></span>. Simpan nomor ini untuk memantau status laporan Anda.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── Sidebar ── --}}
            <div class="space-y-5" data-aos="fade-left" data-aos-delay="100">

                {{-- Panduan Pengaduan --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <div class="px-5 py-4 border-b border-slate-100 bg-sky-50/50">
                        <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-4 h-4 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Panduan Pengaduan
                        </h3>
                    </div>
                    <div class="px-5 py-4 space-y-3">
                        @foreach([
                            ['step' => '1', 'text' => 'Isi formulir pengaduan dengan lengkap dan jelas'],
                            ['step' => '2', 'text' => 'Sertakan bukti atau dokumen pendukung jika ada'],
                            ['step' => '3', 'text' => 'Simpan nomor tiket yang diberikan setelah kirim'],
                            ['step' => '4', 'text' => 'Pantau status laporan via menu Cek Status'],
                            ['step' => '5', 'text' => 'Respon akan diberikan dalam 5–7 hari kerja'],
                        ] as $item)
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-sky-100 text-sky-700 text-[11px] font-bold flex items-center justify-center shrink-0">{{ $item['step'] }}</span>
                            <p class="text-xs text-slate-600 leading-relaxed pt-0.5">{{ $item['text'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Cek Status --}}
                <div class="grid grid-cols-1 gap-3">
                    <a href="{{ route('layanan.cek-status') }}" wire:navigate
                       class="group flex items-center gap-4 px-5 py-4 bg-white rounded-2xl border border-slate-200 hover:border-sky-300 hover:shadow-md transition-all duration-300">
                        <div class="w-11 h-11 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-100 transition-colors shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-sm text-slate-800 group-hover:text-indigo-600 transition-colors">Cek Status Laporan</p>
                            <p class="text-xs text-slate-500">Lacak progres pengaduan Anda</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- Kontak Langsung --}}
                <div class="bg-gradient-to-br from-sky-600 to-sky-800 rounded-2xl p-5 text-white">
                    <h3 class="font-bold text-sm mb-1">Butuh Bantuan Langsung?</h3>
                    <p class="text-xs text-sky-200 mb-4 leading-relaxed">Hubungi kami melalui saluran resmi berikut untuk pengaduan mendesak.</p>
                    <div class="space-y-2.5">
                        <a href="tel:08114601234" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 rounded-xl px-4 py-2.5 transition-all">
                            <svg class="w-4 h-4 text-sky-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="text-xs font-medium">(0811) 4601 234</span>
                        </a>
                        <a href="mailto:info@prokopimmahulu.com" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 rounded-xl px-4 py-2.5 transition-all">
                            <svg class="w-4 h-4 text-sky-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="text-xs font-medium">info@prokopimmahulu.com</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
    function pengaduanForm() {
        return {
            form: { nama: '', telepon: '', email: '', jenis: '', subjek: '', isi: '', konfirmasi: false },
            errors: {},
            isSubmitting: false,
            submitted: false,
            ticketNumber: '',
            fileName: '',
            handleFile(e) {
                const file = e.target.files[0];
                if (file) this.fileName = file.name;
            },
            validate() {
                this.errors = {};
                if (!this.form.nama.trim()) this.errors.nama = 'Nama wajib diisi';
                if (!this.form.telepon.trim()) this.errors.telepon = 'Nomor HP wajib diisi';
                else if (!/^08\d{8,12}$/.test(this.form.telepon.trim())) this.errors.telepon = 'Format nomor tidak valid';
                if (!this.form.jenis) this.errors.jenis = 'Pilih jenis pengaduan';
                if (!this.form.subjek.trim()) this.errors.subjek = 'Subjek wajib diisi';
                if (!this.form.isi.trim()) this.errors.isi = 'Isi pengaduan wajib diisi';
                else if (this.form.isi.length < 30) this.errors.isi = 'Isi pengaduan minimal 30 karakter';
                return Object.keys(this.errors).length === 0;
            },
            submitForm() {
                if (!this.validate() || !this.form.konfirmasi) return;
                this.isSubmitting = true;
                setTimeout(() => {
                    this.ticketNumber = 'LPR-' + new Date().getFullYear() + '-' + Math.floor(10000 + Math.random() * 90000);
                    this.isSubmitting = false;
                    this.submitted = true;
                    this.form = { nama: '', telepon: '', email: '', jenis: '', subjek: '', isi: '', konfirmasi: false };
                    this.fileName = '';
                }, 1800);
            }
        }
    }
    </script>
</x-layouts.app>
