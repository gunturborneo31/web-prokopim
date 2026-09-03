@php
    // In Filament v4 Layout components, use $getRecord() to get the model
    $record = $getRecord();

    $type = strtolower($record->type ?? '');
    $isImage = in_array($type, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
    
    $clickAction = '';
    if ($record->is_folder) {
        $folderUrl = \App\Filament\Resources\FileSharings\FileSharingResource::getUrl('index', ['folder_id' => $record->id]);
        $clickAction = 'onclick="window.location.href=\'' . $folderUrl . '\'"';
    } elseif ($isImage) {
        $clickAction = 'wire:click.stop="mountTableAction(\'preview\', \'' . $record->id . '\')"';
    } elseif ($record->file_path) {
        $fileUrl = \Illuminate\Support\Facades\Storage::url($record->file_path);
        $clickAction = 'onclick="window.open(\'' . $fileUrl . '\', \'_blank\')"';
    }

    $iconColor = $record->status == 2 ? '#16a34a' : '#f97316'; // green or orange
@endphp

<div 
    {!! $clickAction !!}
    style="display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; width: 100%; height: 100%; position: relative; transition: all 0.2s ease; padding: 12px;"
>
    {{-- Favorite Star (Top Left) --}}
    <div 
        wire:click.stop="mountTableAction('toggleFavorite', '{{ $record->id }}')"
        @click.stop
        style="position: absolute; top: 10px; left: 10px; z-index: 40; padding: 6px; border-radius: 50%; background: rgba(255,255,255,0.8); backdrop-filter: blur(4px); box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
        onmouseover="this.style.background='white'; this.style.transform='scale(1.1)';"
        onmouseout="this.style.background='rgba(255,255,255,0.8)'; this.style.transform='scale(1)';"
    >
        @if($record->is_favorite)
             <svg style="width: 16px; height: 16px; color: #eab308; fill: currentColor;" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
        @else
            <svg style="width: 16px; height: 16px; color: #94a3b8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
        @endif
    </div>

    {{-- Actions Menu (Top Right) --}}
    <div 
        x-data="{ open: false }"
        @click.stop
        @click.away="open = false"
        style="position: absolute; top: 10px; right: 10px; z-index: 40;"
    >
        <button 
            @click="open = !open"
            type="button"
            style="background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 6px; cursor: pointer; border: none; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
            onmouseover="this.style.background='white'; this.style.transform='scale(1.05)';"
            onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.transform='scale(1)';"
        >
            <svg style="width: 18px; height: 18px; color: #64748b;" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
            </svg>
        </button>

        <div 
            x-show="open"
            x-transition
            style="position: absolute; top: 100%; right: 0; margin-top: 4px; background: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); min-width: 180px; overflow: hidden; border: 1px solid #e2e8f0;"
        >
            @if(!$record->is_folder && $record->file_path)
            <button 
                @click="window.location.href = '{{ route('file-sharing.download', $record->share_code) }}'; open = false"
                type="button"
                style="width: 100%; text-align: left; padding: 10px 14px; border: none; background: white; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: background 0.15s; font-size: 14px; color: #334155;"
                onmouseover="this.style.background='#f8fafc'"
                onmouseout="this.style.background='white'"
            >
                <svg style="width: 16px; height: 16px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                </svg>
                <span>{{ __('Download') }}</span>
            </button>
            @endif

            <button 
                wire:click.stop="mountTableAction('rename', '{{ $record->id }}')"
                @click="open = false"
                type="button"
                style="width: 100%; text-align: left; padding: 10px 14px; border: none; background: white; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: background 0.15s; font-size: 14px; color: #334155;"
                onmouseover="this.style.background='#f8fafc'"
                onmouseout="this.style.background='white'"
            >
                <svg style="width: 16px; height: 16px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                </svg>
                <span>{{ __('Ganti Nama') }}</span>
            </button>

            <button 
                wire:click.stop="mountTableAction('share', '{{ $record->id }}')"
                @click="open = false"
                type="button"
                style="width: 100%; text-align: left; padding: 10px 14px; border: none; background: white; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: background 0.15s; font-size: 14px; color: #334155;"
                onmouseover="this.style.background='#f8fafc'"
                onmouseout="this.style.background='white'"
            >
                <svg style="width: 16px; height: 16px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"/>
                </svg>
                <span>{{ __('Bagikan') }}</span>
            </button>

            <button 
                wire:click.stop="mountTableAction('move', '{{ $record->id }}')"
                @click="open = false"
                type="button"
                style="width: 100%; text-align: left; padding: 10px 14px; border: none; background: white; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: background 0.15s; font-size: 14px; color: #334155;"
                onmouseover="this.style.background='#f8fafc'"
                onmouseout="this.style.background='white'"
            >
                <svg style="width: 16px; height: 16px; color: #64748b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                </svg>
                <span>{{ __('Pindahkan') }}</span>
            </button>

            @if(!$record->deleted_at)
            <div style="height: 1px; background: #e2e8f0; margin: 4px 0;"></div>
            <button 
                wire:click.stop="mountTableAction('delete', '{{ $record->id }}')"
                @click="open = false"
                type="button"
                style="width: 100%; text-align: left; padding: 10px 14px; border: none; background: white; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: background 0.15s; font-size: 14px; color: #dc2626;"
                onmouseover="this.style.background='#fef2f2'"
                onmouseout="this.style.background='white'"
            >
                <svg style="width: 16px; height: 16px; color: #dc2626;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>
                <span>{{ __('Hapus') }}</span>
            </button>
            @else
            <button 
                wire:click.stop="mountTableAction('restore', '{{ $record->id }}')"
                @click="open = false"
                type="button"
                style="width: 100%; text-align: left; padding: 10px 14px; border: none; background: white; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: background 0.15s; font-size: 14px; color: #f59e0b;"
                onmouseover="this.style.background='#fffbeb'"
                onmouseout="this.style.background='white'"
            >
                <svg style="width: 16px; height: 16px; color: #f59e0b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                </svg>
                <span>{{ __('Pulihkan') }}</span>
            </button>
            <button 
                wire:click.stop="mountTableAction('forceDelete', '{{ $record->id }}')"
                @click="open = false"
                type="button"
                style="width: 100%; text-align: left; padding: 10px 14px; border: none; background: white; cursor: pointer; display: flex; align-items: center; gap: 10px; transition: background 0.15s; font-size: 14px; color: #dc2626;"
                onmouseover="this.style.background='#fef2f2'"
                onmouseout="this.style.background='white'"
            >
                <svg style="width: 16px; height: 16px; color: #dc2626;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>
                <span>{{ __('Hapus Permanen') }}</span>
            </button>
            @endif
        </div>
    </div>

    {{-- Icon Area (Folder or File Preview) --}}
    <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100px; position: relative; background: #f8fafc; border-radius: 10px; border: 1px solid #f1f5f9; overflow: hidden; margin-bottom: 12px; flex-shrink: 0;">
        @if($record->is_folder)
            <div style="position: relative; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                {{-- OUTLINE FOLDER --}}
                <svg style="width: 50px; height: 50px; color: {{ $iconColor }}; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                {{-- LOCK OVERLAY (BOTTOM RIGHT) --}}
                <div style="position: absolute; bottom: 22%; right: 26%; background: #ffffff; border-radius: 6px; padding: 2px; display: flex; box-shadow: 0 1px 2px rgba(0,0,0,0.1); transform: translate(50%, 50%);">
                     <svg style="width: 14px; height: 14px; color: {{ $iconColor }}; stroke: currentColor; fill: none; flex-shrink: 0;" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
            </div>
        @else
            @if($isImage && $record->file_path)
                <img 
                    src="{{ \Illuminate\Support\Facades\Storage::url($record->file_path) }}" 
                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" 
                    alt="{{ $record->title }}"
                >
            @else
                <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; color: #94a3b8; background: #f1f5f9;">
                    <x-filament::icon 
                        icon="{{ \App\Filament\Resources\FileSharings\FileSharingResource::getFileIcon($type) }}" 
                        style="width: 40px; height: 40px;"
                    />
                </div>
            @endif
        @endif
    </div>

    {{-- Title --}}
    <h3 style="font-weight: 700; color: #1e293b; font-size: 13px; width: 100%; text-align: center; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; word-break: break-all; line-height: 1.4; margin: 0; padding: 0 4px;" title="{{ $record->title }}">
        {{ $record->title }}
    </h3>
</div>

