<div style="background: white; border-radius: 1rem; padding: 1.5rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px rgba(0,0,0,0.05); height: 100%;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
        <h3 style="font-size: 1.125rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 0.5rem;">
            <x-heroicon-m-fire style="width: 1.25rem; height: 1.25rem; color: #f97316;"/>
            Berita Terpopuler (Favorit)
        </h3>
        <span style="font-size: 0.75rem; color: #6b7280; font-weight: 500;">Berdasarkan Jumlah Baca</span>
    </div>

    <div style="display: flex; flex-direction: column; gap: 1rem;">
        @foreach($this->getFavoritePosts() as $post)
            <div style="display: flex; gap: 1rem; padding: 0.75rem; border-radius: 0.75rem; border: 1px solid #f9fafb; transition: all 0.2s; cursor: pointer;"
                 onmouseover="this.style.backgroundColor='#fff7ed'; this.style.borderColor='#fed7aa';"
                 onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#f9fafb';">
                
                @if($post->file && ($post->file->storage_path || $post->file->path))
                    <div style="width: 4rem; height: 4rem; flex-shrink: 0; border-radius: 0.5rem; overflow: hidden; background: #f3f4f6;">
                        <img src="{{ Storage::url($post->file->storage_path ?? $post->file->path) }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=News&color=7F9CF5&background=EBF4FF'">
                    </div>
                @else
                    <div style="width: 4rem; height: 4rem; flex-shrink: 0; border-radius: 0.5rem; background: #eff6ff; display: flex; align-items: center; justify-content: center; color: #3b82f6;">
                        <x-heroicon-o-newspaper style="width: 1.5rem; height: 1.5rem;"/>
                    </div>
                @endif

                <div style="flex: 1; min-width: 0;">
                    <h4 style="font-size: 0.875rem; font-weight: 600; color: #111827; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $post->title }}">
                        {{ $post->title }}
                    </h4>
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-top: 0.25rem;">
                         <span style="font-size: 0.75rem; color: #6b7280; display: flex; align-items: center; gap: 0.25rem;">
                            <x-heroicon-m-user style="width: 0.875rem; height: 0.875rem;"/>
                            {{ $post->user?->name ?? 'Admin' }}
                        </span>
                        <span style="font-size: 0.75rem; color: #6b7280; display: flex; align-items: center; gap: 0.25rem;">
                            <x-heroicon-m-calendar style="width: 0.875rem; height: 0.875rem;"/>
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>

                <div style="text-align: right; flex-shrink: 0;">
                    <div style="display: flex; align-items: center; justify-content: flex-end; color: #ea580c; font-weight: 700; font-size: 1rem;">
                        {{ number_format($post->read) }}
                    </div>
                    <div style="font-size: 0.625rem; color: #9ca3af; text-transform: uppercase; font-weight: 600;">Pembaca</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
