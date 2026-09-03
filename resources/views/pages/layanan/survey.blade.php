<x-layouts.app>
    {{-- ===================== PAGE HERO ===================== --}}
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-70">
                <img src="{{ asset('images/batucermin.jpg') }}" alt="Survey" class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/80 via-amber-900/50 to-amber-700/40 z-10"></div>
        </div>
        <div class="container px-4 sm:px-6 lg:px-12 relative z-20">
            <div class="max-w-4xl text-center" data-aos="fade-up">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/5 border borderwhite/10 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-3">
                    <div class="relative flex h-2 w-2 mx-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span></div>
                    Layanan Publik
                </div>
                <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#10192D] leading-tight drop-shadow-2xl">Survey <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #FCD34D 0%, #F59E0B 50%, #D97706 100%);">Kepuasan</span></h1>
                <p class="mt-6 text-amber-200 text-lg font-medium max-w-2xl mx-auto leading-relaxed">Bantu kami meningkatkan kualitas layanan dengan mengisi Indeks Kepuasan Masyarakat (IKM). Penilaian Anda sangat berarti bagi kami.</p>
                <div class="mt-8 flex items-center justify-center gap-2 text-sm text-white/50">
                    <a href="{{ route('beranda') }}" class="hover:text-amber-400 transition-colors">Beranda</a><span>/</span><span class="text-amber-400">Survey Kepuasan</span>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 z-20"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-16 fill-instansi-surface"><path d="M0,20 C360,0 1080,0 1440,20 L1440,60 L0,60 Z"/></svg></div>
    </section>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-12 py-14" x-data="surveyForm()">

        {{-- Progress Bar --}}
        <div class="mb-8" data-aos="fade-up">
            <div class="flex items-center justify-between text-xs font-semibold text-slate-500 mb-2">
                <span>Langkah <span class="text-amber-600" x-text="step"></span> dari 3</span>
                <span x-text="Math.round((step/3)*100) + '%'"></span>
            </div>
            <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-amber-400 to-amber-600 rounded-full transition-all duration-500"
                     :style="'width: ' + Math.round((step/3)*100) + '%'"></div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden" data-aos="fade-up">

            {{-- STEP 1: Identitas --}}
            <div x-show="step === 1">
                <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-amber-50 towhite">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-800">Identitas Responden</h2>
                            <p class="text-xs text-slate-500">Informasi ini bersifat opsional dan terjaga kerahasiaannya</p>
                        </div>
                    </div>
                </div>
                <div class="px-8 py-7 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nama</label>
                            <input type="text" x-model="survey.nama" placeholder="Nama Anda (opsional)"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1.5">Jenis Kelamin</label>
                            <select x-model="survey.jenisKelamin" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all cursor-pointer">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1.5">Pendidikan Terakhir</label>
                            <select x-model="survey.pendidikan" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all cursor-pointer">
                                <option value="">-- Pilih --</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA/SMK</option>
                                <option value="D3">D3/D4</option>
                                <option value="S1">S1</option>
                                <option value="S2+">S2/S3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-1.5">Pekerjaan</label>
                            <select x-model="survey.pekerjaan" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all cursor-pointer">
                                <option value="">-- Pilih --</option>
                                <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                                <option value="Swasta">Pegawai Swasta</option>
                                <option value="Wirausaha">Wirausaha</option>
                                <option value="Pelajar">Pelajar/Mahasiswa</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="px-8 pb-7 flex justify-end">
                    <button @click="step = 2" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold text-sm transition-all active:scale-95 flex items-center gap-2">
                        Selanjutnya <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            {{-- STEP 2: Penilaian --}}
            <div x-show="step === 2">
                <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-amber-50 towhite">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-800">Penilaian Layanan</h2>
                            <p class="text-xs text-slate-500">Berikan penilaian 1 (Sangat Buruk) sampai 4 (Sangat Baik)</p>
                        </div>
                    </div>
                </div>
                <div class="px-8 py-7 space-y-6">
                    @php
                    $pertanyaan = [
                        ['key' => 'persyaratan', 'label' => 'Kemudahan Persyaratan Pelayanan'],
                        ['key' => 'prosedur', 'label' => 'Kemudahan Prosedur Pelayanan'],
                        ['key' => 'waktu', 'label' => 'Kecepatan Waktu Pelayanan'],
                        ['key' => 'biaya', 'label' => 'Kewajaran Biaya Pelayanan'],
                        ['key' => 'produk', 'label' => 'Kesesuaian Produk/Hasil Pelayanan'],
                        ['key' => 'kompetensi', 'label' => 'Kompetensi Petugas Pelayanan'],
                        ['key' => 'perilaku', 'label' => 'Perilaku Petugas Pelayanan'],
                        ['key' => 'sarana', 'label' => 'Kualitas Sarana dan Prasarana'],
                        ['key' => 'penanganan', 'label' => 'Penanganan Pengaduan dan Saran'],
                    ];
                    @endphp
                    @foreach($pertanyaan as $p)
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <p class="text-sm font-semibold text-slate-700 flex-1">{{ $p['label'] }}</p>
                        <div class="flex gap-2">
                            @foreach([1 => ['label' => '1', 'sub' => 'Sangat Buruk'], 2 => ['label' => '2', 'sub' => 'Buruk'], 3 => ['label' => '3', 'sub' => 'Baik'], 4 => ['label' => '4', 'sub' => 'Sangat Baik']] as $val => $opt)
                            <button type="button" @click="survey.nilai['{{ $p['key'] }}'] = {{ $val }}"
                                    :class="survey.nilai['{{ $p['key'] }}'] === {{ $val }} ? 'bg-amber-500 text-white border-amber-500 shadow-md' : 'bg-white text-slate-500 border-slate-200 hover:border-amber-300'"
                                    class="w-10 h-10 rounded-xl border text-sm font-bold transition-all active:scale-95"
                                    :title="'{{ $opt['sub'] }}'">{{ $opt['label'] }}</button>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="px-8 pb-7 flex justify-between gap-3">
                    <button @click="step = 1" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Kembali
                    </button>
                    <button @click="step = 3" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold text-sm transition-all active:scale-95 flex items-center gap-2">
                        Selanjutnya <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            {{-- STEP 3: Saran & Submit --}}
            <div x-show="step === 3">
                <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-amber-50 towhite">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-800">Saran dan Masukan</h2>
                            <p class="text-xs text-slate-500">Pendapat Anda sangat membantu peningkatan layanan kami</p>
                        </div>
                    </div>
                </div>
                <div class="px-8 py-7 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Saran / Masukan</label>
                        <textarea x-model="survey.saran" rows="4" placeholder="Tuliskan saran atau masukan Anda untuk perbaikan layanan kami..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100 transition-all resize-none"></textarea>
                    </div>
                    {{-- Rata-rata Nilai --}}
                    <div class="bg-amber-50 rounded-2xl px-5 py-4 flex items-center justify-between">
                        <p class="text-sm font-bold text-slate-700">Nilai IKM Anda</p>
                        <div class="text-right">
                            <p class="text-3xl font-black text-amber-600" x-text="rataRata.toFixed(2)"></p>
                            <p class="text-xs text-slate-500" x-text="kategoriNilai"></p>
                        </div>
                    </div>
                </div>
                <div class="px-8 pb-7 flex flex-col sm:flex-row justify-between gap-3">
                    <button @click="step = 2" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold text-sm transition-all flex items-center gap-2 justify-center">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Kembali
                    </button>
                    <button @click="submitSurvey" :disabled="isSubmitting"
                            class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold text-sm transition-all active:scale-95 flex items-center gap-2 justify-center shadow-lg shadow-amber-200">
                        <template x-if="!isSubmitting">
                            <span class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Kirim Survey</span>
                        </template>
                        <template x-if="isSubmitting">
                            <span class="flex items-center gap-2"><svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mengirim...</span>
                        </template>
                    </button>
                </div>
            </div>

            {{-- SUCCESS --}}
            <div x-show="submitted" x-cloak class="px-8 py-16 text-center">
                <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 mx-auto mb-5">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2">Terima Kasih!</h3>
                <p class="text-slate-500 text-sm max-w-sm mx-auto leading-relaxed">Survey kepuasan Anda telah berhasil dikirim. Penilaian Anda sangat berarti bagi peningkatan kualitas layanan kami.</p>
                <a href="{{ route('beranda') }}" wire:navigate class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold text-sm transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
    function surveyForm() {
        return {
            step: 1, isSubmitting: false, submitted: false,
            survey: {
                nama: '', jenisKelamin: '', pendidikan: '', pekerjaan: '', saran: '',
                nilai: { persyaratan: 0, prosedur: 0, waktu: 0, biaya: 0, produk: 0, kompetensi: 0, perilaku: 0, sarana: 0, penanganan: 0 }
            },
            get rataRata() {
                const vals = Object.values(this.survey.nilai).filter(v => v > 0);
                if (!vals.length) return 0;
                return vals.reduce((a, b) => a + b, 0) / vals.length;
            },
            get kategoriNilai() {
                const r = this.rataRata;
                if (r === 0) return 'Belum dinilai';
                if (r >= 3.5324) return 'Sangat Baik (A)';
                if (r >= 2.5) return 'Baik (B)';
                if (r >= 1.5) return 'Kurang Baik (C)';
                return 'Tidak Baik (D)';
            },
            submitSurvey() {
                this.isSubmitting = true;
                setTimeout(() => { this.isSubmitting = false; this.submitted = true; }, 1500);
            }
        }
    }
    </script>
</x-layouts.app>
