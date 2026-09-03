<x-layouts.app>
    @php
        $subtitle = $profilePage?->content['subtitle'] ?? 'Data aparatur PROKOPIM Kabupaten Mahakam Ulu.';
        $photoFor = fn ($item) => $item->photo ? asset('storage/' . ltrim($item->photo, '/')) : asset('images/desamahakamulu.jpg');
    @endphp

    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 z-0 opacity-80"><img src="{{ asset('images/desamahakamulu.jpg') }}" alt="Aparatur" class="w-full h-full object-cover"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-20 text-center">
            <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-white">Aparatur Kami</h1>
            <p class="mt-6 text-sky-200 text-lg max-w-3xl mx-auto">{{ $subtitle }}</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center">
                <div class="text-4xl font-black text-[#274CA5]">{{ $aparaturs->count() }}</div>
                <div class="text-sm text-slate-500 mt-2">Total Aparatur Aktif</div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center">
                <div class="text-4xl font-black text-[#274CA5]">{{ $aparaturs->pluck('position')->filter()->unique()->count() }}</div>
                <div class="text-sm text-slate-500 mt-2">Variasi Jabatan</div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 text-center">
                <div class="text-4xl font-black text-[#274CA5]">{{ $aparaturs->pluck('grade')->filter()->unique()->count() }}</div>
                <div class="text-sm text-slate-500 mt-2">Kelompok Golongan</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($aparaturs as $aparatur)
                <article class="bg-white rounded-3xl border border-slate-100 shadow-lg overflow-hidden hover:-translate-y-1 transition-all duration-300">
                    <div class="aspect-[4/3] bg-slate-100">
                        <img src="{{ $photoFor($aparatur) }}" alt="{{ $aparatur->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h2 class="text-lg font-bold text-[#274CA5]">{{ $aparatur->name }}</h2>
                        <p class="text-sky-700 font-semibold mt-1">{{ $aparatur->position }}</p>
                        <div class="grid grid-cols-2 gap-3 mt-5 text-sm">
                            <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                                <div class="text-xs text-slate-400 uppercase tracking-wider">Pangkat</div>
                                <div class="font-bold text-slate-700 mt-1">{{ $aparatur->rank ?: '-' }}</div>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3 border border-slate-100">
                                <div class="text-xs text-slate-400 uppercase tracking-wider">Golongan</div>
                                <div class="font-bold text-slate-700 mt-1">{{ $aparatur->grade ?: '-' }}</div>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full bg-white rounded-3xl border border-slate-100 shadow-xl p-10 text-center text-slate-500">Data aparatur belum tersedia.</div>
            @endforelse
        </div>
    </div>
</x-layouts.app>