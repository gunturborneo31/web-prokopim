<x-layouts.app>
    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 z-0 opacity-70"><img src="{{ asset('images/desamahakamulu.jpg') }}" alt="Cek Status" class="w-full h-full object-cover"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/80 via-indigo-900/60 to-indigo-700/50 z-10"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-20 text-center">
            <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-white">Cek Status Laporan</h1>
            <p class="mt-6 text-indigo-200 text-lg max-w-3xl mx-auto">Lacak tindak lanjut pengaduan berdasarkan nomor tiket.</p>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-12 py-16" x-data="statusLookup()">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-8">
            <div class="flex flex-col sm:flex-row gap-4">
                <input x-model="ticket" type="text" placeholder="Contoh: LPR-2026-00001" class="flex-1 rounded-xl border border-slate-200 px-4 py-3 uppercase tracking-wider">
                <button @click="search" class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold" :disabled="loading">
                    <span x-show="!loading">Cari</span>
                    <span x-show="loading" x-cloak>Mencari...</span>
                </button>
            </div>

            <div class="mt-8" x-show="result" x-cloak>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6 space-y-4">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <div class="text-xs uppercase tracking-wider text-slate-400">Nomor Tiket</div>
                            <div class="text-xl font-black text-[#274CA5]" x-text="result.ticket"></div>
                        </div>
                        <div class="px-4 py-2 rounded-full bg-white border border-slate-200 text-sm font-bold text-slate-700" x-text="result.status_label"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div><div class="text-slate-400">Pelapor</div><div class="font-semibold text-slate-800" x-text="result.name"></div></div>
                        <div><div class="text-slate-400">Kategori</div><div class="font-semibold text-slate-800" x-text="result.category"></div></div>
                        <div><div class="text-slate-400">Tanggal Masuk</div><div class="font-semibold text-slate-800" x-text="result.submitted_at"></div></div>
                        <div><div class="text-slate-400">Subjek</div><div class="font-semibold text-slate-800" x-text="result.subject"></div></div>
                    </div>
                    <template x-if="result.public_response">
                        <div><div class="text-slate-400 text-sm">Respon Publik</div><div class="mt-1 text-slate-700" x-text="result.public_response"></div></div>
                    </template>
                    <template x-if="result.admin_note">
                        <div><div class="text-slate-400 text-sm">Catatan Admin</div><div class="mt-1 text-slate-700" x-text="result.admin_note"></div></div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        function statusLookup() {
            return {
                ticket: '',
                result: null,
                loading: false,
                async search() {
                    if (!this.ticket.trim()) return;
                    this.loading = true;
                    try {
                        const response = await fetch(`{{ route('layanan.cek-status.search') }}?ticket=${encodeURIComponent(this.ticket)}`, {
                            headers: { 'Accept': 'application/json' },
                        });
                        const payload = await response.json();
                        if (!response.ok) throw new Error(payload.message || 'Data tidak ditemukan.');
                        this.result = payload;
                    } catch (error) {
                        this.result = null;
                        alert(error.message || 'Terjadi kesalahan.');
                    } finally {
                        this.loading = false;
                    }
                },
            };
        }
    </script>
</x-layouts.app>