<x-layouts.app>
    @php
        $subtitle = $profilePage?->meta_desc ?? 'Rekam prestasi dan penghargaan PROKOPIM Kabupaten Mahakam Ulu.';
    @endphp

    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 z-0 opacity-80"><img src="{{ asset('images/desamahakamulu.jpg') }}" alt="Penghargaan" class="w-full h-full object-cover"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-20 text-center">
            <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-white">Penghargaan</h1>
            <p class="mt-6 text-sky-200 text-lg max-w-3xl mx-auto">{{ $subtitle }}</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($awards as $award)
                <article class="bg-white rounded-3xl border border-slate-100 shadow-lg p-6 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between mb-5">
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold uppercase">{{ $award->year ?: '-' }}</span>
                        <span class="px-3 py-1 rounded-full {{ $award->status ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }} text-xs font-bold uppercase">{{ $award->status ? 'Aktif' : 'Arsip' }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-[#274CA5] leading-snug">{{ $award->title }}</h2>
                    <p class="text-sm text-slate-500 mt-2">{{ $award->institution ?: 'Instansi pemberi belum diisi' }}</p>
                    <div class="mt-5 flex items-center gap-3 text-sm text-slate-500">
                        <span>{{ number_format($award->views ?? 0) }} dilihat</span>
                    </div>
                    @if($award->file)
                        <div class="mt-6 flex gap-3">
                            <a href="{{ asset('storage/' . ltrim($award->file, '/')) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-sky-50 text-sky-700 font-semibold">Lihat</a>
                            <a href="{{ asset('storage/' . ltrim($award->file, '/')) }}" download class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-100 text-slate-700 font-semibold">Unduh</a>
                        </div>
                    @endif
                </article>
            @empty
                <div class="col-span-full bg-white rounded-3xl border border-slate-100 shadow-xl p-10 text-center text-slate-500">Data penghargaan belum tersedia.</div>
            @endforelse
        </div>
    </div>
</x-layouts.app>