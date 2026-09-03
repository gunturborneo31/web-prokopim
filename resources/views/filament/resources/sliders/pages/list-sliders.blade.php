<x-filament-panels::page>
    <style>
        /* Override Filament page layout */
        .fi-main {
            max-width: 100% !important;
        }

        .fi-page {
            max-width: 100% !important;
        }

        .fi-page-content-wrapper {
            max-width: 100% !important;
        }

        .fi-page-content {
            max-width: 100% !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        /* Grid Layout */
        .slider-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Strict 3 columns like screenshot */
            gap: 1.5rem;
            margin-top: 1rem;
        }

        @media (max-width: 1024px) {
            .slider-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .slider-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .fi-page-content {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }
        }

        /* Card Styling - Minimalist */
        .slider-card {
            background: white;
            border-radius: 4px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05); /* Very subtle shadow */
            overflow: hidden;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            border: none; /* No border like screenshot */
            position: relative;
            height: 100%;
        }
        .dark .slider-card {
            background: #111827;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }
        .slider-card.is-pinned {
            border: 2px solid #3b82f6 !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        .dark .slider-card.is-pinned {
            border-color: #3b82f6 !important;
        }

        .slider-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }
        .dark .slider-card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.5);
        }
        .slider-card:hover .action-dropdown-wrapper {
            opacity: 1;
            visibility: visible;
        }

        /* Image Area */
        .slider-image-wrapper {
            display: grid;
            grid-template-areas: "mainslot";
            background-color: #f8fafc;
            width: 100%;
            overflow: hidden;
            border-radius: 4px 4px 0 0;
            position: relative;
        }
        .dark .slider-image-wrapper {
            background-color: #1f2937;
        }

        /* Enforce 16:9 as the minimum height using a spacer */
        .slider-image-wrapper::before {
            content: "";
            display: block;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            grid-area: mainslot;
        }

        .slider-image {
            grid-area: mainslot;
            display: block;
            width: 100%;
            height: auto;
            max-width: 100%;
            align-self: center; /* Center horizontally if image is wide */
            transition: transform 0.5s ease;
            z-index: 1;
        }

        .slider-card:hover .slider-image {
            transform: scale(1.05);
        }

        /* Content Area */
        .slider-content {
            padding: 0.75rem 0.25rem; /* Tighter padding for minimalist look */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 640px) {
            .slider-content {
                padding: 1rem;
            }
        }

        .slider-title {
            font-size: 0.875rem;
            font-weight: 500; /* Normal weight like screenshot */
            color: #334155;
            margin-bottom: 0.25rem;
            line-height: 1.4;
            /* text-transform: uppercase; Removed */
            
            /* Limit to 2 lines */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .dark .slider-title {
            color: #f1f5f9;
        }

        .slider-description {
            font-size: 0.75rem;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 0.75rem;
            
            /* Limit to 3 lines */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 4.5em;
        }
        .dark .slider-description {
            color: #94a3b8;
        }

        @media (max-width: 640px) {
            .slider-title {
                font-size: 0.9375rem;
            }
        }

        .slider-meta {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 0.25rem;
            /* border-top removed */
        }
        .dark .slider-meta {
            color: #64748b;
        }

        .slider-status-badge {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            box-shadow: 0 2px 4px rgb(0 0 0 / 0.1);
            text-transform: uppercase;
        }
        
        .status-active { 
            color: white;
            background-color: #2563eb;
        }
        
        .status-inactive { 
            color: white;
            background-color: #dc2626;
        }


        /* Action Dropdown - Hover Triggered Button */
        .action-dropdown-wrapper {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            z-index: 20;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .action-dropdown-button {
            background: white;
            border-radius: 0.375rem;
            padding: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.2s;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dark .action-dropdown-button {
            background: #1f2937;
            border-color: #374151;
            color: white;
        }

        .action-dropdown-button:hover {
            background-color: #f9fafb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .dark .action-dropdown-button:hover {
            background-color: #374151;
        }

        .action-dropdown-menu {
            position: absolute;
            right: 0;
            margin-top: 0.5rem;
            width: 10rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.2), 0 8px 10px -6px rgb(0 0 0 / 0.15);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        .dark .action-dropdown-menu {
            background: #1f2937;
            border-color: #374151;
        }

        .action-dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-align: left;
            text-decoration: none;
            color: #374151;
            transition: all 0.15s;
            border: none;
            background: white;
            cursor: pointer;
            border-bottom: 1px solid #f3f4f6;
        }
        .dark .action-dropdown-item {
            background: #1f2937;
            color: #d1d5db;
            border-bottom-color: #374151;
        }

        .action-dropdown-item:last-child {
            border-bottom: none;
        }

        .action-dropdown-item svg {
            width: 1.125rem;
            height: 1.125rem;
        }

        .action-dropdown-item:hover {
            background-color: #f9fafb;
        }
        .dark .action-dropdown-item:hover {
            background-color: #374151;
        }

        .action-dropdown-item.delete {
            color: #ef4444;
        }

        .action-dropdown-item.delete:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }
        .dark .action-dropdown-item.delete:hover {
            background-color: rgba(239, 68, 68, 0.1);
        }

        /* Custom Delete Modal */
        .delete-modal-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            backdrop-filter: blur(4px);
        }

        .delete-modal {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            max-width: 28rem;
            width: 90%;
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        }
        .dark .delete-modal {
            background: #1f2937;
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.5);
        }

        .delete-modal-icon {
            width: 3rem;
            height: 3rem;
            margin: 0 auto 1.5rem;
            color: #ef4444;
        }

        .delete-modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            text-align: center;
            margin-bottom: 0.75rem;
        }
        .dark .delete-modal-title {
            color: white;
        }

        .delete-modal-message {
            font-size: 0.9375rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .dark .delete-modal-message {
            color: #94a3b8;
        }

        .delete-modal-actions {
            display: flex;
            gap: 0.75rem;
        }

        .delete-modal-btn {
            flex: 1;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .delete-modal-btn-cancel {
            background: #f3f4f6;
            color: #374151;
        }
        .dark .delete-modal-btn-cancel {
            background: #374151;
            color: #d1d5db;
        }

        .delete-modal-btn-cancel:hover {
            background: #e5e7eb;
        }
        .dark .delete-modal-btn-cancel:hover {
            background: #4b5563;
        }

        .delete-modal-btn-delete {
            background: #ef4444;
            color: white;
        }

        .delete-modal-btn-delete:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 0.5rem;
            color: #64748b;
            border: 1px solid #e0e0e0;
        }
        .dark .empty-state {
            background: #111827;
            border-color: #374151;
            color: #94a3b8;
        }

        .empty-state-icon {
            width: 4rem;
            height: 4rem;
            margin: 0 auto 1rem;
            color: #cbd5e1;
        }
        .dark .empty-state-icon {
            color: #374151;
        }

        .empty-state-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }
        .dark .empty-state-title {
            color: #f1f5f9;
        }

        .empty-state-description {
            font-size: 0.875rem;
            color: #64748b;
        }
        .dark .empty-state-description {
            color: #94a3b8;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 1.5rem;
        }

        @media (max-width: 640px) {
            .pagination-wrapper {
                margin-top: 1rem;
            }
        }
    </style>

    <div class="slider-grid">
        @forelse($sliders as $slider)
            <div class="slider-card {{ $slider->is_pinned ? 'is-pinned' : '' }}">
                
                    {{-- Gambar --}}
                    <div class="slider-image-wrapper">

                        @if($slider->file && $slider->file->path)
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($slider->file->path) }}" alt="{{ $slider->caption }}" class="slider-image">
                        @else
                            {{-- Fallback jika tidak ada gambar --}}
                            <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; color:#cbd5e1;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:3rem; height:3rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                        @endif

                    {{-- Action Dropdown (Hover Triggered) --}}
                    <div x-data="{ open: false }" class="action-dropdown-wrapper">
                        <button @click="open = !open" @click.outside="open = false" type="button" class="action-dropdown-button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 1.25rem; height: 1.25rem;">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             style="display: none;" 
                             class="action-dropdown-menu">
                            
                            {{-- Edit Action --}}
                            <a href="{{ \App\Filament\Resources\Sliders\SliderResource::getUrl('edit', ['record' => $slider->id]) }}" 
                               class="action-dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                {{ __('Ubah') }}
                            </a>

                            {{-- Pin Toggle Action --}}
                            <button wire:click="togglePin({{ $slider->id }})" 
                                    type="button"
                                    class="action-dropdown-item {{ $slider->is_pinned ? 'text-primary-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $slider->is_pinned ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1.125rem; height: 1.125rem; transform: rotate(45deg);">
                                    <path d="M19.5 13.5L16.5 10.5V4.5L15 3H9L7.5 4.5V10.5L4.5 13.5V15H11.25V21H12.75V15H19.5V13.5Z" />
                                </svg>
                                {{ $slider->is_pinned ? __('Lepas Sematan') : __('Sematkan') }}
                            </button>

                            {{-- Delete Action --}}
                            <button @click="open = false; $dispatch('open-delete-modal', { id: {{ $slider->id }}, title: '{{ addslashes($slider->caption) }}' })" 
                                    type="button"
                                    class="action-dropdown-item delete">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                {{ __('Hapus') }}
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Konten Teks --}}
                <div class="slider-content">
                    <h3 class="slider-title" title="{{ $slider->caption }}">
                        {{ $slider->caption ?? __('Tanpa Judul') }}
                    </h3>

                    @if($slider->description)
                        <p class="slider-description">
                            {{ $slider->description }}
                        </p>

                    @endif

                    <div class="slider-meta">
                        {{-- Icon Calendar --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1rem; height:1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span>
                            {{ $slider->created_at->format('d M, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="empty-state-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <p class="empty-state-title">{{ __('Belum ada slider') }}</p>
                <p class="empty-state-description">{{ __('Silakan tambahkan slider baru dengan menekan tombol "Tambah Slider"') }}</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">
        {{ $sliders->links() }}
    </div>

    {{-- Custom Delete Modal --}}
    <div x-data="{ 
            showModal: false, 
            sliderId: null, 
            sliderTitle: '' 
        }"
         @open-delete-modal.window="showModal = true; sliderId = $event.detail.id; sliderTitle = $event.detail.title"
         x-show="showModal"
         x-cloak
         style="display: none;">
        
        <div class="delete-modal-overlay" @click="showModal = false">
            <div class="delete-modal" @click.stop>
                {{-- Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="delete-modal-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>

                {{-- Title --}}
                <h3 class="delete-modal-title">{{ __('Hapus Slider?') }}</h3>

                {{-- Message --}}
                <p class="delete-modal-message">
                    {{ __('Apakah Anda yakin ingin menghapus slider') }} "<strong x-text="sliderTitle"></strong>"? {{ __('Tindakan ini tidak dapat dibatalkan.') }}
                </p>

                {{-- Actions --}}
                <div class="delete-modal-actions">
                    <button @click="showModal = false" type="button" class="delete-modal-btn delete-modal-btn-cancel">
                        {{ __('Batal') }}
                    </button>
                    <button @click="$wire.deleteSlider(sliderId); showModal = false" type="button" class="delete-modal-btn delete-modal-btn-delete">
                        {{ __('Ya, Hapus') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-filament-panels::page>