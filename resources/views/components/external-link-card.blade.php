@props(['item'])

<a href="{{ $item['link'] }}" target="_blank" class="block group bg-slate-800 rounded-xl p-6 border border-slate-700 hover:border-sky-500 hover:bg-slate-750 transition-all duration-300 relative overflow-hidden">
     <!-- Hover Glow -->
    <div class="absolute inset-0 bg-sky-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <div class="flex items-center gap-4 relative z-10">
        <div class="w-14 h-14 bg-white rounded-lg p-2 flex-shrink-0 flex items-center justify-center shadow-lg">
            <img src="{{ $item['logo'] }}" alt="{{ $item['name'] }}" class="max-w-full max-h-full object-contain">
        </div>
        <div>
            <h4 class="font-montserrat font-bold text-white text-md group-hover:text-sky-400 transition-colors line-clamp-1">{{ $item['name'] }}</h4>
            <p class="text-slate-400 text-xs mt-1 line-clamp-2">{{ $item['desc'] }}</p>
        </div>
    </div>
</a>
