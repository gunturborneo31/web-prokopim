@props(['title', 'icon', 'link'])

<a href="{{ $link }}" {{ $attributes->merge(['class' => 'group relative bg-white/5 backdrop-blur-sm rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 border border-white/10 shadow-lg hover:shadow-sky-900/20 hover:-translate-y-1 overflow-hidden']) }}>
    <!-- Background Gradient Blob -->
    <div class="absolute -right-10 -top-10 w-32 h-32 bg-sky-600/20 rounded-full blur-3xl group-hover:bg-sky-500/30 transition-colors duration-500"></div>

    <div class="relative z-10">
        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-sky-600 to-sky-700 flex items-center justify-center text-white mb-6 shadow-lg shadow-sky-900/30 group-hover:scale-110 transition-transform duration-300 border border-white/10">
            {{ $slot }}
        </div>
        
        <h3 class="font-montserrat font-bold text-xl text-white mb-3 group-hover:text-sky-400 transition-colors">{{ $title }}</h3>
        <p class="text-slate-400 text-sm leading-relaxed mb-6">Nikmati kemudahan akses layanan publik secara digital, transparan, dan akuntabel.</p>
        
        <div class="flex items-center text-sky-400 font-semibold text-sm group-hover:gap-2 transition-all">
            <span>Akses Layanan</span>
            <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
        </div>
    </div>
</a>
