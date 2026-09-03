<x-layouts.app>
    <section class="relative pt-[56px] pb-10 overflow-hidden bg-[#274CA5]">
        <div class="absolute inset-0 z-0 opacity-45">
            <img src="{{ asset('images/desamahakamulu.jpg') }}" alt="PPID" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#274CA5]/65 via-sky-800/45 to-sky-700/35 backdrop-blur-2xl z-10"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-20 text-center">
            <div class="mx-auto max-w-4xl rounded-[2rem] border border-white/10 bg-white/10 px-6 py-6 sm:px-10 sm:py-8 text-center shadow-2xl backdrop-blur-md">
                <div class="inline-flex items-center pr-4 py-2 rounded-full bg-white/10 border border-white/15 text-white text-[10px] font-bold tracking-[0.2em] uppercase backdrop-blur-sm shadow-xl mb-4">
                    PPID
                </div>
                <h1 class="font-montserrat font-black text-3xl sm:text-4xl lg:text-5xl text-white leading-tight drop-shadow-2xl">Jenis Informasi PPID</h1>
                <p class="mt-4 text-white/85 text-base sm:text-lg max-w-3xl mx-auto leading-relaxed">Akses empat jenis informasi PPID: serta merta, setiap saat, berkala, dan dikecualikan beserta kategori isiannya.</p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @include('pages.ppid._sidebar')

            <main class="lg:col-span-3" x-data="{ activeTab: '{{ $defaultTypeSlug ?? 'serta-merta' }}' }">
                <div class="bg-white border border-slate-100 rounded-3xl shadow-sm p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($types as $type)
                            <button
                                type="button"
                                class="text-left rounded-2xl border p-4 transition-all duration-200"
                                :class="activeTab === '{{ $type['slug'] }}' ? 'border-sky-400 bg-sky-50 shadow-sm' : 'border-slate-200 bg-white hover:border-sky-200 hover:bg-sky-50/40'"
                                @click="activeTab = '{{ $type['slug'] }}'"
                            >
                                <p class="text-sm font-bold" :class="activeTab === '{{ $type['slug'] }}' ? 'text-sky-700' : 'text-slate-800'">{{ $type['title'] }}</p>
                                <p class="mt-1 text-xs text-slate-500 leading-relaxed">{{ $type['description'] }}</p>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 space-y-6">
                    @foreach($types as $type)
                        <section x-show="activeTab === '{{ $type['slug'] }}'" x-cloak class="space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <h2 class="text-2xl font-bold text-[#274CA5]">{{ $type['title'] }}</h2>
                                <a href="{{ route('ppid.' . $type['slug']) }}" class="inline-flex items-center text-sm font-semibold text-sky-600 hover:text-sky-700">
                                    Buka halaman khusus
                                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </a>
                            </div>

                            @if(! $type['exists'])
                                <div class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                                    Data untuk jenis informasi ini belum tersedia di database PPID.
                                </div>
                            @elseif($type['categories']->isEmpty())
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                                    Belum ada kategori isian untuk jenis informasi ini.
                                </div>
                            @else
                                @foreach($type['categories'] as $categoryIndex => $category)
                                    <article class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden" x-data="{ open: {{ $categoryIndex === 0 ? 'true' : 'false' }} }">
                                        <button type="button" class="w-full px-5 py-4 flex items-center justify-between text-left bg-slate-50/70" @click="open = !open">
                                            <span class="font-semibold text-slate-800">{{ $category['title'] }}</span>
                                            <span class="text-slate-400" x-text="open ? '-' : '+'"></span>
                                        </button>

                                        <div x-show="open" x-cloak class="p-4 sm:p-5">
                                            @if($category['rows']->isEmpty())
                                                <p class="text-sm text-slate-500">Belum ada data pada kategori ini.</p>
                                            @else
                                                <div class="overflow-x-auto rounded-xl border border-slate-100">
                                                    <table class="w-full min-w-[720px] text-sm">
                                                        <thead class="bg-sky-50">
                                                            <tr>
                                                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-sky-700 w-14">No</th>
                                                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider text-sky-700">Judul Informasi</th>
                                                                <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider text-sky-700 w-24">Tahun</th>
                                                                <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider text-sky-700 w-24">Format</th>
                                                                <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider text-sky-700 w-48">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-slate-100">
                                                            @foreach($category['rows'] as $row)
                                                                @php
                                                                    $hasFile = filled($row['file'] ?? null);
                                                                    $viewUrl = $hasFile
                                                                        ? route('stats.view', ['key' => $row['key'], 'type' => 'ppid', 'category' => $category['categorySlug'] ?? $type['slug'], 'url' => $row['file']])
                                                                        : null;
                                                                    $downloadUrl = $hasFile
                                                                        ? route('stats.download', ['key' => $row['key'], 'type' => 'ppid', 'category' => $category['categorySlug'] ?? $type['slug'], 'url' => $row['file']])
                                                                        : null;
                                                                @endphp
                                                                <tr class="hover:bg-slate-50/70 transition-colors">
                                                                    <td class="px-4 py-3 text-xs text-slate-500 font-medium">{{ $row['no'] }}</td>
                                                                    <td class="px-4 py-3 text-slate-700 font-medium">{{ $row['title'] }}</td>
                                                                    <td class="px-4 py-3 text-center text-slate-500">{{ $row['year'] }}</td>
                                                                    <td class="px-4 py-3 text-center">
                                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold">{{ $row['type'] }}</span>
                                                                    </td>
                                                                    <td class="px-4 py-3">
                                                                        <div class="flex items-center justify-center gap-2">
                                                                            @if($hasFile)
                                                                                <a href="{{ $viewUrl }}" target="_blank" rel="noopener noreferrer"
                                                                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-sky-50 text-sky-600 border border-sky-200 hover:bg-sky-100 text-xs font-semibold">
                                                                                    Lihat
                                                                                </a>
                                                                                <a href="{{ $downloadUrl }}"
                                                                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100 text-xs font-semibold">
                                                                                    Unduh
                                                                                </a>
                                                                            @else
                                                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 text-slate-400 text-xs font-semibold">File belum tersedia</span>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            @endif
                        </section>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</x-layouts.app>
