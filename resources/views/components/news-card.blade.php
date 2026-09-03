@props(['item'])

<div {{ $attributes->merge(['class' => 'group relative h-[400px] rounded-3xl overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500']) }}>
    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-[#274CA5]/90 via-[#274CA5]/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
    
    <div class="absolute bottom-0 left-0 p-6 md:p-8 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
        <span class="inline-block px-3 py-1 mb-3 text-xs font-bold tracking-wider text-white uppercase bg-sky-600 rounded-full shadow-lg shadow-sky-500/40">
            {{ $item['category'] }}
        </span>
        
        <h3 class="font-montserrat font-bold text-xl md:text-2xl text-white mb-2 leading-tight group-hover:text-sky-200 transition-colors">
            {{ $item['title'] }}
        </h3>
        
        <div class="flex items-center text-slate-300 text-sm space-x-4 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
            <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                {{ $item['date'] }}
            </span>
            <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                {{ $item['views'] }}
            </span>
        </div>

         <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white group-hover:bg-sky-600 transition-colors">
             <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
         </div>
    </div>
</div>
