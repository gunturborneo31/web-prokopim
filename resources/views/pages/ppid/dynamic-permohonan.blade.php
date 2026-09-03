<x-layouts.app>
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 z-0 opacity-80"><img src="{{ asset('images/batucermin.jpg') }}" alt="Permohonan Informasi" class="w-full h-full object-cover"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-20 text-center">
            <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-white">Permohonan Informasi</h1>
            <p class="mt-6 text-sky-200 text-lg max-w-3xl mx-auto">Ajukan permohonan informasi publik dan lacak statusnya langsung dari backend PPID.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16 space-y-10" x-data="ppidRequestPage()">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['year'] }}</div><div class="text-sm text-slate-500 mt-2">Tahun Ini</div></div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['month'] }}</div><div class="text-sm text-slate-500 mt-2">Bulan Ini</div></div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center"><div class="text-4xl font-black text-[#274CA5]">{{ $stats['today'] }}</div><div class="text-sm text-slate-500 mt-2">Hari Ini</div></div>
        </div>

        <div class="flex gap-3">
            <button class="px-5 py-3 rounded-xl font-bold" :class="tab === 'form' ? 'bg-sky-600 text-white' : 'bg-white border border-slate-200 text-slate-700'" @click="tab = 'form'">Permohonan</button>
            <button class="px-5 py-3 rounded-xl font-bold" :class="tab === 'status' ? 'bg-sky-600 text-white' : 'bg-white border border-slate-200 text-slate-700'" @click="tab = 'status'">Cek Status</button>
        </div>

        <section x-show="tab === 'form'" x-cloak class="bg-white rounded-3xl border border-slate-100 shadow-xl p-8">
            <form class="space-y-5" @submit.prevent="submitRequest">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <input x-model="form.nama_lengkap" type="text" placeholder="Nama lengkap" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                    <input x-model="form.nik" type="text" placeholder="NIK / Identitas" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                    <textarea x-model="form.alamat" rows="3" placeholder="Alamat" class="w-full rounded-xl border border-slate-200 px-4 py-3 md:col-span-2" required></textarea>
                    <input x-model="form.pekerjaan" type="text" placeholder="Pekerjaan" class="w-full rounded-xl border border-slate-200 px-4 py-3">
                    <input x-model="form.no_telepon" type="text" placeholder="No Telepon" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                    <input x-model="form.email" type="email" placeholder="Email" class="w-full rounded-xl border border-slate-200 px-4 py-3 md:col-span-2" required>
                    <textarea x-model="form.rincian_informasi" rows="4" placeholder="Rincian informasi yang dibutuhkan" class="w-full rounded-xl border border-slate-200 px-4 py-3 md:col-span-2" required></textarea>
                    <input x-model="form.tujuan_penggunaan" type="text" placeholder="Tujuan penggunaan informasi" class="w-full rounded-xl border border-slate-200 px-4 py-3 md:col-span-2" required>
                    <select x-model="form.cara_mendapatkan" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                        <option value="">Cara mendapatkan informasi</option>
                        <option value="Hardcopy/Email">Hardcopy / Email</option>
                        <option value="Melihat/Membaca">Melihat / Membaca</option>
                    </select>
                    <select x-model="form.cara_memperoleh" class="w-full rounded-xl border border-slate-200 px-4 py-3" required>
                        <option value="">Cara memperoleh informasi</option>
                        <option value="Mengambil Langsung">Mengambil langsung</option>
                        <option value="Dikirim via Email">Dikirim via email</option>
                    </select>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <p class="text-sm text-slate-500" x-show="requestTicket">Nomor permohonan: <span class="font-bold text-sky-700" x-text="requestTicket"></span></p>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-sky-600 text-white font-bold" :disabled="loadingRequest">
                        <span x-show="!loadingRequest">Kirim Permohonan</span>
                        <span x-show="loadingRequest" x-cloak>Mengirim...</span>
                    </button>
                </div>
            </form>
        </section>

        <section x-show="tab === 'status'" x-cloak class="bg-white rounded-3xl border border-slate-100 shadow-xl p-8">
            <div class="flex flex-col sm:flex-row gap-4">
                <input x-model="statusTicket" type="text" placeholder="Contoh: PPID-2026-00001" class="flex-1 rounded-xl border border-slate-200 px-4 py-3 uppercase tracking-wider">
                <button @click="lookupRequest" class="px-6 py-3 rounded-xl bg-sky-600 text-white font-bold" :disabled="loadingStatus">
                    <span x-show="!loadingStatus">Cari Status</span>
                    <span x-show="loadingStatus" x-cloak>Mencari...</span>
                </button>
            </div>
            <div class="mt-8" x-show="statusResult" x-cloak>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6 space-y-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <div class="text-xs uppercase tracking-wider text-slate-400">Nomor Permohonan</div>
                            <div class="text-xl font-black text-[#274CA5]" x-text="statusResult.ticket"></div>
                        </div>
                        <div class="px-4 py-2 rounded-full bg-white border border-slate-200 text-sm font-bold text-slate-700" x-text="statusResult.status"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div><div class="text-slate-400">Nama</div><div class="font-semibold text-slate-800" x-text="statusResult.name"></div></div>
                        <div><div class="text-slate-400">Email</div><div class="font-semibold text-slate-800" x-text="statusResult.email"></div></div>
                        <div><div class="text-slate-400">Tanggal Masuk</div><div class="font-semibold text-slate-800" x-text="statusResult.submitted_at"></div></div>
                    </div>
                    <template x-if="statusResult.response"><div><div class="text-slate-400 text-sm">Respon Admin</div><div class="mt-1 text-slate-700" x-text="statusResult.response"></div></div></template>
                    <template x-if="statusResult.note"><div><div class="text-slate-400 text-sm">Catatan</div><div class="mt-1 text-slate-700" x-text="statusResult.note"></div></div></template>
                </div>
            </div>
        </section>
    </div>

    <script>
        function ppidRequestPage() {
            return {
                tab: 'form',
                loadingRequest: false,
                loadingStatus: false,
                requestTicket: '',
                statusTicket: '',
                statusResult: null,
                form: {
                    nama_lengkap: '', nik: '', alamat: '', pekerjaan: '', email: '', no_telepon: '',
                    rincian_informasi: '', tujuan_penggunaan: '', cara_mendapatkan: '', cara_memperoleh: ''
                },
                async submitRequest() {
                    this.loadingRequest = true;
                    try {
                        const response = await fetch('{{ route('ppid.permohonan.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(this.form),
                        });
                        const payload = await response.json();
                        if (!response.ok) throw new Error(payload.message || 'Gagal mengirim permohonan.');
                        this.requestTicket = payload.ticket;
                        this.form = { nama_lengkap: '', nik: '', alamat: '', pekerjaan: '', email: '', no_telepon: '', rincian_informasi: '', tujuan_penggunaan: '', cara_mendapatkan: '', cara_memperoleh: '' };
                    } catch (error) {
                        alert(error.message || 'Terjadi kesalahan.');
                    } finally {
                        this.loadingRequest = false;
                    }
                },
                async lookupRequest() {
                    if (!this.statusTicket.trim()) return;
                    this.loadingStatus = true;
                    try {
                        const response = await fetch(`{{ route('ppid.permohonan.status') }}?ticket=${encodeURIComponent(this.statusTicket)}`, {
                            headers: { 'Accept': 'application/json' },
                        });
                        const payload = await response.json();
                        if (!response.ok) throw new Error(payload.message || 'Data permohonan tidak ditemukan.');
                        this.statusResult = payload;
                    } catch (error) {
                        this.statusResult = null;
                        alert(error.message || 'Terjadi kesalahan.');
                    } finally {
                        this.loadingStatus = false;
                    }
                },
            };
        }
    </script>
</x-layouts.app>