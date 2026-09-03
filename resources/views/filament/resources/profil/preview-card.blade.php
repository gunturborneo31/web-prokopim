<x-filament-panels::page>
    @php
        $record = $this->getRecord();
    @endphp

    @if($record)
        {{-- Preview Card menggunakan Filament native styling --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            {{-- Header --}}
            <div class="fi-section-header flex items-center gap-x-3 overflow-hidden px-6 py-4">
                <div class="grid flex-1 gap-y-1">
                    <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        {{ $record->title }}
                    </h3>
                    
                    @if($record->status)
                        <span class="fi-badge flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 fi-color-success fi-badge-color-success bg-success-50 text-success-600 ring-success-600/10 dark:bg-success-400/10 dark:text-success-400 dark:ring-success-400/30" style="width: fit-content;">
                            <svg class="fi-badge-icon h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                            </svg>
                            <span class="fi-badge-label">Aktif</span>
                        </span>
                    @else
                        <span class="fi-badge flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 fi-color-gray fi-badge-color-gray bg-gray-50 text-gray-600 ring-gray-600/10 dark:bg-gray-400/10 dark:text-gray-400 dark:ring-gray-400/20" style="width: fit-content;">
                            <svg class="fi-badge-icon h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                            </svg>
                            <span class="fi-badge-label">Nonaktif</span>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Content --}}
            <div class="fi-section-content-ctn border-t border-gray-200 dark:borderwhite/10">
                <div class="fi-section-content p-6">
                    <dl class="divide-y divide-gray-100 dark:dividewhite/5">
                        {{-- Subjudul --}}
                        @if($record->content)
                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-950 dark:text-white">
                                    Subjudul Halaman
                                </dt>
                                <dd class="text-sm text-gray-500 dark:text-gray-400 sm:col-span-2">
                                    {{ $record->content }}
                                </dd>
                            </div>
                        @endif

                        {{-- Gambar --}}
                        @php
                            $imagePath = $record->tags['image'] ?? null;
                        @endphp
                        
                        @if($imagePath)
                            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-950 dark:text-white">
                                    Gambar Profil
                                </dt>
                                <dd class="text-sm text-gray-500 dark:text-gray-400 sm:col-span-2">
                                    <div class="rounded-lg overflow-hidden border border-gray-200 dark:borderwhite/10" style="max-width: 400px;">
                                        <img src="{{ Storage::url($imagePath) }}" 
                                             alt="{{ $record->tags['alt_text'] ?? 'Profil BPBJ' }}"
                                             class="w-full h-auto">
                                    </div>
                                    @if(!empty($record->tags['alt_text']))
                                        <p class="mt-2 text-xs text-gray-400 dark:text-gray-500">
                                            Alt text: {{ $record->tags['alt_text'] }}
                                        </p>
                                    @endif
                                </dd>
                            </div>
                        @endif

                        {{-- Meta Info --}}
                        <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-950 dark:text-white">
                                Terakhir Diubah
                            </dt>
                            <dd class="text-sm text-gray-500 dark:text-gray-400 sm:col-span-2">
                                {{ $record->updated_at->timezone('Asia/Makassar')->format('d M Y, H:i') }} WITA
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    @else
        {{-- Empty State --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-content p-12">
                <div class="text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-gray-950 dark:text-white">
                        Belum Ada Profil
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Klik tombol "Buat Profil" di atas untuk membuat profil BPBJ Prov. Kaltim.
                    </p>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>
