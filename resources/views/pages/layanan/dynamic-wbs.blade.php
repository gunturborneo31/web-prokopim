<x-layouts.app>
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 z-0 opacity-70"><img src="{{ asset('images/desamahakamulu.jpg') }}" alt="WBS" class="w-full h-full object-cover"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/90 via-red-900/70 to-red-700/60 z-10"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-20 text-center">
            <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-white">Whistleblowing System</h1>
            <p class="mt-6 text-red-100 text-lg max-w-3xl mx-auto">Laporkan dugaan pelanggaran secara rahasia melalui backend pengaduan.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16 space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['total'] }}</div><div class="text-sm text-slate-500 mt-2">Laporan WBS</div></div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['selesai'] }}</div><div class="text-sm text-slate-500 mt-2">Selesai</div></div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['diproses'] }}</div><div class="text-sm text-slate-500 mt-2">Diproses</div></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <section class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-xl p-8" x-data="wbsForm()">
                <h2 class="text-2xl font-bold text-[#274CA5] mb-6">Form Laporan WBS</h2>
                <form class="space-y-5" @submit.prevent="submit">
                    <label class="flex items-center gap-3 text-sm text-slate-600"><input x-model="form.anonim" type="checkbox"> Kirim sebagai anonim</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5" x-show="!form.anonim" x-cloak>
                        <input x-model="form.nama" type="text" placeholder="Nama lengkap" class="w-full rounded-xl border border-slate-200 px-4 py-3">
                        <input x-model="form.telepon" type="text" placeholder="Nomor HP" class="w-full rounded-xl border border-slate-200 px-4 py-3">
                    </div>
                    <select x-model="form.jenis" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                        <option value="">Pilih jenis pelanggaran</option>
                        <option value="korupsi">Korupsi</option>
                        <option value="gratifikasi">Gratifikasi</option>
                        <option value="disiplin">Pelanggaran Disiplin</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                    <input x-model="form.terlapor" type="text" placeholder="Pihak yang dilaporkan" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                    <input x-model="form.waktu" type="date" class="w-full rounded-xl border border-slate-200 px-4 py-3">
                    <textarea x-model="form.isi" rows="6" placeholder="Uraian kronologi kejadian" class="w-full rounded-xl border border-slate-200 px-4 py-3" required></textarea>
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm text-slate-500" x-show="ticket">Nomor tiket: <span class="font-bold text-red-700" x-text="ticket"></span></p>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-red-600 text-white font-bold" :disabled="loading">
                            <span x-show="!loading">Kirim Laporan</span>
                            <span x-show="loading" x-cloak>Mengirim...</span>
                        </button>
                    </div>
                </form>
            </section>

            <aside class="bg-white rounded-3xl border border-slate-100 shadow-xl p-6">
                <h3 class="font-bold text-[#274CA5] mb-4">Kerahasiaan</h3>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $about?->description ?: 'Identitas pelapor dijaga kerahasiaannya dan laporan diproses oleh admin berwenang.' }}</p>
            </aside>
        </div>
    </div>

    <script>
        function wbsForm() {
            return {
                form: { anonim: true, nama: '', telepon: '', jenis: '', terlapor: '', waktu: '', isi: '' },
                loading: false,
                ticket: '',
                async submit() {
                    this.loading = true;
                    try {
                        const response = await fetch('{{ route('layanan.wbs.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(this.form),
                        });
                        const payload = await response.json();
                        if (!response.ok) throw new Error(payload.message || 'Gagal mengirim laporan.');
                        this.ticket = payload.ticket;
                        this.form = { anonim: true, nama: '', telepon: '', jenis: '', terlapor: '', waktu: '', isi: '' };
                    } catch (error) {
                        alert(error.message || 'Terjadi kesalahan.');
                    } finally {
                        this.loading = false;
                    }
                },
            };
        }
    </script>
</x-layouts.app>