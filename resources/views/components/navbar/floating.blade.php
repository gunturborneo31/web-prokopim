@php
    $isPpidMode = request()->is('ppid*');
@endphp

<div x-data="{
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.pageYOffset > 20;
            });
            this.scrolled = window.pageYOffset > 20;    
        }
    }" 
    class="fixed top-0 inset-x-0 z-50 transition-all duration-500 ease-out pointer-events-none flex justify-center pt-0 px-0">

    {{-- Main Navbar Container --}}
    <nav class="relative flex items-center justify-between transition-all duration-500 ease-out pointer-events-auto w-full"
         :class="scrolled 
             ? 'max-w-[1920px] bg-[#274CA5]/92 md:bg-[#274CA5]/92 backdrop-blur-xl border-b border-[#274CA5]/10 shadow-[0_8px_30px_rgb(0,0,0,0.45)] rounded-none h-[68px] px-2 sm:px-6 lg:px-10' 
             : 'max-w-[1920px] bg-[#274CA5]/95 md:bg-[#274CA5]/95 backdrop-blur-md border-b border-[#274CA5]/10 shadow-lg rounded-none h-[72px] px-2 sm:px-8 lg:px-12'">

        {{-- ═══ Logo Area ═══ --}}
        <a href="{{ $isPpidMode ? route('ppid.index') : route('beranda') }}" wire:navigate class="flex items-center justify-center gap-2 shrink-0 mr-1 sm:mr-4 z-50 group">

              <div class="relative flex items-center justify-center transition-all duration-500 shrink-0"
                  :class="scrolled ? 'gap-1.5 md:gap-1 ml-0' : 'gap-2 md:gap-1 ml-0'">
                 <div class="flex items-center justify-center rounded-full "
                     :class="scrolled ? 'w-10 h-10 md:w-12 md:h-12' : 'w-10 h-10 md:w-12 md:h-12'">
                    <img src="{{ asset('images/Mahakam_Ulu.webp') }}"
                        alt="Logo Pemkab Mahulu"
                        class="w-[82%] h-[82%] object-contain group-hover:scale-105 transition-transform duration-500" />
                 </div>

                 <!-- <div class="flex items-center justify-center rounded-full "
                     :class="scrolled ? 'w-10 h-10 md:w-12 md:h-12' : 'w-10 h-10 md:w-12 md:h-12'">
                    <img src="{{ asset('images/logo_prokopim.png') }}"
                        alt="Logo Prokopim"
                        class="w-[82%] h-[82%] object-contain group-hover:scale-105 transition-transform duration-500"
                        style="filter: drop-shadow(0 0 1px rgba(15, 23, 42, 1)) drop-shadow(0 0 2px rgba(255, 255, 255, 1));" />
                 </div> -->
              </div>
            
              <div class="flex flex-col justify-center transition-all duration-500 overflow-hidden"
                  :class="scrolled ? 'w-0 opacity-0 hidden' : 'hidden lg:flex w-auto opacity-100'">
                <h1 class="font-montserrat font-black text-white leading-[1.2] tracking-wider text-[13px] lg:text-[13px] drop-shadow-md whitespace-nowrap">Protokol dan Komunikasi Pimpinan</h1>
                <p class="font-bold text-white tracking-[0.2em] uppercase leading-none mt-1.5 text-[9px] lg:text-[10px] drop-shadow whitespace-nowrap">KAB. MAHAKAM ULU</p>
            </div>

              <div class="flex lg:hidden flex-col justify-center transition-all duration-500"
                 :class="scrolled ? 'w-0 opacity-0 pointer-events-none overflow-hidden' : 'w-auto opacity-100'">
                <h1 class="font-montserrat font-bold text-white leading-[1.2] tracking-wide text-[13px] drop-shadow-md whitespace-nowrap">Protokol dan Komunikasi Pimpinan</h1>
                <p class="font-bold text-white tracking-wider uppercase leading-none mt-1 text-[9px] drop-shadow whitespace-nowrap">KAB. MAHAKAM ULU</p>
            </div>
        </a>

        {{-- ═══ CENTER: Brand Tagline (Menu moved to floating bottom bar) ═══ --}}
        <div class="flex-1 flex justify-center items-center h-full relative">
            <div class="flex flex-col items-left justify-left transition-all duration-300 relative w-full">
                <div class="flex flex-col items-left justify-left transition-all duration-300"
                     :class="scrolled ? 'opacity-100 scale-100' : 'opacity-0 pointer-events-none scale-95'">
                    <p class="font-montserrat font-bold text-white text-left text-[13px] sm:text-[13px] tracking-wider whitespace-nowrap leading-[1.3] drop-shadow">
                        Protokol dan Komunikasi Pimpinan
                    </p>
                    <p class="font-bold text-white text-left text-[10px] sm:text-[10px] tracking-widest uppercase leading-none mt-1 whitespace-nowrap drop-shadow">
                        KAB. MAHAKAM ULU
                    </p>
                </div>
            </div>
        </div>

        {{-- ═══ Right: Desktop = "Akses PPID" text, Mobile = ikon PPID ═══ --}}
        <div class="flex items-center gap-2 shrink-0 ml-1 sm:ml-2 z-50">

            {{-- Desktop --}}
            <a href="{{ $isPpidMode ? route('beranda') : route('ppid.index') }}" wire:navigate
               class="hidden lg:inline-flex items-center justify-center transition-all duration-300 shadow-lg hover:shadow-xl group whitespace-nowrap"
               :class="scrolled
                   ? 'h-11 px-4 rounded-full bg-gradient-to-r from-white to-white text-white font-bold text-xs hover:scale-105 border border-white'
                   : 'h-11 px-4 rounded-full bg-gradient-to-r from-white to-white font-bold text-sm text-white border border-white hover:bg-white shadow-[0_0_15px_rgba(234,179,8,0.3)]'">
                @if ($isPpidMode)
                    <span class="group-hover:tracking-wide transition-all duration-300">Web Utama</span>
                @else
                    <span class="inline-flex h-8 items-center justify-center rounded-full bg-white px-2">
                        <img src="/images/logo_ppid.png" alt="PPID Logo" class="h-6 w-auto"
                             />
                    </span>
                @endif
            </a>

            <a href="{{ route('egov') }}" wire:navigate
               class="hidden lg:inline-flex items-center justify-center transition-all duration-300 shadow-lg hover:shadow-xl group whitespace-nowrap"
               :class="scrolled
                   ? 'h-11 px-5 rounded-full bg-white text-black/80 font-bold text-xs hover:scale-105 border border-blue-400/30'
                   : 'h-11 px-6 rounded-full bg-white font-bold text-sm text-black/80 border border-blue-400/30 hover:brightness-110 shadow-[0_0_15px_rgba(37,99,235,0.3)]'">
                <span class="group-hover:tracking-wide transition-all duration-300">e-Gov</span>
            </a>

            {{-- Mobile: pill dengan ikon + label --}}
            <a href="{{ $isPpidMode ? route('beranda') : route('ppid.index') }}" wire:navigate
               class="lg:hidden flex items-center gap-1.5 transition-all duration-300 active:scale-95"
               :class="scrolled
                   ? 'px-2.5 py-1.5 rounded-full bg-gradient-to-r fromwhite towhite text-white border border-blue-300/50 shadow-md'
                   : 'px-2.5 py-1.5 rounded-full bg-gradient-to-r fromwhite to-whtie text-white border border-blue-300/50 shadow-[0_0_12px_rgba(234,179,8,0.35)]'">
                {{-- Ikon dokumen informasi --}}
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                @if ($isPpidMode)
                    <span class="font-black text-[10px] tracking-widest leading-none">WEB</span>
                @else
                    <span class="inline-flex items-center justify-center rounded-full bg-white px-1.5 py-1 border border-slate-200 shadow-sm">
                        <img src="/images/logo_ppid.png" alt="PPID Logo" class="h-4 w-auto"
                            style="filter: drop-shadow(0 0 1px rgba(15, 23, 42, 0.55));" />
                    </span>
                @endif
            </a>

        </div>
    </nav>
</div>
