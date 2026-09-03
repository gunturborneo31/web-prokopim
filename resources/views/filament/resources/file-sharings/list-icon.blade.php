@if($record)
    <div class="flex items-center justify-center py-2">
        @if ($record->is_folder)
            {{-- Folder Icon --}}
            <x-heroicon-o-folder class="w-10 h-10 text-orange-500" />
        @else
            @php
                $extension = strtolower(pathinfo($record->file_path ?? '', PATHINFO_EXTENSION) ?: ($record->type ?? ''));
                $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                $isPdf = $extension === 'pdf';
                $isDoc = in_array($extension, ['doc', 'docx']);
                $isXls = in_array($extension, ['xls', 'xlsx']);
            @endphp
            
            @if ($isImage && $record->file_path)
                {{-- Image Preview --}}
                <img src="{{ \Illuminate\Support\Facades\Storage::url($record->file_path) }}"
                    class="w-10 h-10 object-cover rounded" 
                    alt="{{ $record->title }}">
            @else
                {{-- File Icon based on type --}}
                @if($isPdf)
                    <x-heroicon-o-document-text class="w-10 h-10 text-red-500" />
                @elseif($isDoc)
                    <x-heroicon-o-document-text class="w-10 h-10 text-blue-500" />
                @elseif($isXls)
                    <x-heroicon-o-document-text class="w-10 h-10 text-green-500" />
                @else
                    <x-heroicon-o-document class="w-10 h-10 text-gray-400" />
                @endif
            @endif
        @endif
    </div>
@endif
