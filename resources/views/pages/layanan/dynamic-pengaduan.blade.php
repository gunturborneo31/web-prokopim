<x-layouts.app>
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 z-0 opacity-70"><img src="{{ asset('images/desamahakamulu.jpg') }}" alt="Pengaduan" class="w-full h-full object-cover"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/80 via-sky-900/60 to-sky-700/50 z-10"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-20 text-center">
            <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-white">Layanan Pengaduan</h1>
            <p class="mt-6 text-sky-200 text-lg max-w-3xl mx-auto">Sampaikan pengaduan, saran, dan masukan Anda secara langsung ke sistem backend.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16 space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['total'] }}</div><div class="text-sm text-slate-500 mt-2">Total Pengaduan</div></div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['selesai'] }}</div><div class="text-sm text-slate-500 mt-2">Selesai</div></div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['diproses'] }}</div><div class="text-sm text-slate-500 mt-2">Sedang Diproses</div></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <section class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-xl p-8" x-data="complaintForm()">
                <h2 class="text-2xl font-bold text-[#274CA5] mb-6">Form Pengaduan</h2>
                <form class="space-y-5" @submit.prevent="submit">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <input x-model="form.nama" type="text" placeholder="Nama lengkap" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                        <input x-model="form.telepon" type="text" placeholder="Nomor HP / WhatsApp" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                        <input x-model="form.email" type="email" placeholder="Email" class="w-full rounded-xl border border-slate-200 px-4 py-3 md:col-span-2">
                        <select x-model="form.jenis" class="w-full rounded-xl border border-slate-200 px-4 py-3 md:col-span-2" required>
                            <option value="">Pilih jenis pengaduan</option>
                            <option value="layanan">Pengaduan Layanan</option>
                            <option value="aparatur">Pengaduan Aparatur</option>
                            <option value="infrastruktur">Infrastruktur & Fasilitas</option>
                            <option value="saran">Saran & Masukan</option>
                        </select>
                        <input x-model="form.subjek" type="text" placeholder="Subjek pengaduan" class="w-full rounded-xl border border-slate-200 px-4 py-3 md:col-span-2" required>
                        <textarea x-model="form.isi" rows="6" placeholder="Uraikan pengaduan Anda" class="w-full rounded-xl border border-slate-200 px-4 py-3 md:col-span-2" required></textarea>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm text-slate-500" x-show="ticket">Nomor tiket: <span class="font-bold text-sky-700" x-text="ticket"></span></p>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-sky-600 text-white font-bold" :disabled="loading">
                            <span x-show="!loading">Kirim Pengaduan</span>
                            <span x-show="loading" x-cloak>Mengirim...</span>
                        </button>
                    </div>
                </form>
            </section>

            <aside class="space-y-5">
                <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-6">
                    <h3 class="font-bold text-[#274CA5] mb-4">Panduan Singkat</h3>
                    <ol class="space-y-3 text-sm text-slate-600 list-decimal pl-5">
                        <li>Isi data pelapor dengan benar.</li>
                        <li>Jelaskan kronologi pengaduan secara jelas.</li>
                        <li>Simpan nomor tiket untuk pelacakan status.</li>
                    </ol>
                </div>
                <div class="bg-[#274CA5] rounded-3xl p-6 text-white">
                    <h3 class="font-bold mb-3">Kontak Resmi</h3>
                    <p class="text-sm text-slate-300">{{ $site?->email ?: 'Email belum diatur' }}</p>
                    <p class="text-sm text-slate-300 mt-2">{{ $site?->phone ?: 'Telepon belum diatur' }}</p>
                </div>
            </aside>
        </div>
    </div>

    <script>
        function complaintForm() {
            return {
                form: { nama: '', telepon: '', email: '', jenis: '', subjek: '', isi: '' },
                loading: false,
                ticket: '',
                async submit() {
                    this.loading = true;
                    try {
                        const response = await fetch('{{ route('layanan.pengaduan.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(this.form),
                        });
                        const payload = await response.json();
                        if (!response.ok) throw new Error(payload.message || 'Gagal mengirim pengaduan.');
                        this.ticket = payload.ticket;
                        this.form = { nama: '', telepon: '', email: '', jenis: '', subjek: '', isi: '' };
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