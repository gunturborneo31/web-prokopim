<x-layouts.app>
    @php
        $subtitle = $profilePage?->content['subtitle'] ?? 'Mengenal pimpinan PROKOPIM Kabupaten Mahakam Ulu secara lebih dekat.';
        $resolveLeaderPhoto = function (?string $path): string {
            $path = trim((string) $path);

            if ($path === '') {
                return asset('images/desamahakamulu.jpg');
            }

            if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }

            return asset('storage/' . ltrim($path, '/'));
        };
    @endphp

    <section class="relative pt-[100px] pb-20 overflow-hidden bg-[#2E52A8]">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 z-0 opacity-80">
                <img src="{{ asset('images/desamahakamulu.jpg') }}" alt="Pimpinan" class="w-full h-full object-cover">
            </div>
    
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-20 text-center">
            <h1 class="font-montserrat font-black text-4xl sm:text-5xl lg:text-6xl text-[#2E52A8]">Profil Pimpinan</h1>
            <p class="mt-6 text-sky-200 text-lg max-w-3xl mx-auto">{{ $subtitle }}</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16 space-y-10">
        @forelse($leaders as $leader)
            <section class="bg-white rounded-3xl border border-[#2E52A8] shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-5">
                    <div class="lg:col-span-2 bg-slate-100 min-h-[380px]">
                        <img src="{{ $resolveLeaderPhoto($leader->photo) }}" alt="{{ $leader->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="lg:col-span-3 p-8 lg:p-10">
                        <div class="inline-flex px-4 py-1.5 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold uppercase tracking-wider mb-4">{{ $leader->label ?: 'Pimpinan' }}</div>
                        <h2 class="text-3xl font-black text-[#2E52A8]">{{ $leader->name }}</h2>
                        <p class="text-sky-700 font-semibold mt-2">{{ $leader->position }}</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                            <div class="rounded-2xl bg-slate-50 p-4 border border-[#2E52A8]">
                                <p class="text-xs uppercase tracking-wider text-slate-400">NIP</p>
                                <p class="text-sm font-bold text-slate-700 mt-1">{{ $leader->nip ?: '-' }}</p>
                            </div>
                            <div class="rounded-2xl bg-slate-50 p-4 border border-[#2E52A8]">
                                <p class="text-xs uppercase tracking-wider text-slate-400">Pendidikan</p>
                                <p class="text-sm font-bold text-slate-700 mt-1">{{ $leader->pendidikan ?: '-' }}</p>
                            </div>
                            <div class="rounded-2xl bg-slate-50 p-4 border border-[#2E52A8]">
                                <p class="text-xs uppercase tracking-wider text-slate-400">Pangkat</p>
                                <p class="text-sm font-bold text-slate-700 mt-1">{{ $leader->pangkat ?: '-' }}</p>
                            </div>
                            <div class="rounded-2xl bg-slate-50 p-4 border border-[#2E52A8]">
                                <p class="text-xs uppercase tracking-wider text-slate-400">Golongan</p>
                                <p class="text-sm font-bold text-slate-700 mt-1">{{ $leader->golongan ?: '-' }}</p>
                            </div>
                        </div>
                        @if($leader->quote)
                            <blockquote class="mt-8 rounded-2xl border border-sky-100 bg-sky-50 p-6 text-slate-600 italic">{{ $leader->quote }}</blockquote>
                        @endif
                    </div>
                </div>
            </section>

            @if($leader->histories->isNotEmpty())
                <section class="bg-white rounded-3xl border border-[#2E52A8] shadow-xl p-8 lg:p-10">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1.5 h-8 bg-gradient-to-b from-sky-400 to-sky-700 rounded-full"></div>
                        <h3 class="text-2xl font-bold text-[#2E52A8]">Riwayat Jabatan</h3>
                    </div>
                    <div class="space-y-6">
                        @foreach($leader->histories as $history)
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-full {{ $history->is_current ? 'bg-sky-500' : 'bg-slate-200' }} mt-1 shrink-0"></div>
                                <div class="flex-1 border-b border-[#2E52A8] pb-6 last:border-b-0">
                                    <div class="text-xs uppercase tracking-wider text-slate-400">{{ $history->year_start }} - {{ $history->year_end ?: 'Sekarang' }}</div>
                                    <h4 class="text-lg font-bold text-slate-800 mt-1">{{ $history->position }}</h4>
                                    <p class="text-sm text-slate-500 mt-1">{{ $history->institution }}</p>
                                    @if($history->description)
                                        <p class="text-sm text-slate-600 mt-3">{{ $history->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @empty
            <div class="bg-white rounded-3xl border border-[#2E52A8] shadow-xl p-10 text-center text-slate-500">Data pimpinan belum tersedia.</div>
        @endforelse
    </div>
</x-layouts.app>