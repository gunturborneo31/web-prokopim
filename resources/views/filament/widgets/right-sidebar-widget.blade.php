<div x-data="{ openDetail: false }" style="display: flex; flex-direction: column; gap: 1.5rem;">
    <!-- MODERN AGENDA WIDGET -->
    @php $cal = $this->getCalendarData(); @endphp
    <div class="calendar-card widget-card" style="padding: 0; overflow: hidden; height: auto;">
        <!-- GREEN HEADER -->
        <div style="background: #1e3a8a; padding: 1rem 1.5rem; display: flex; align-items: center; gap: 0.75rem;" class="agenda-header">
            <div style="width: 4px; height: 18px; background: #2563eb; border-radius: 2px;"></div>
            <h3 style="color: white; font-size: 0.9rem; font-weight: 850; letter-spacing: 0.05em; text-transform: uppercase;">{{ __('Agenda') }}</h3>
        </div>

        <!-- CALENDAR SECTION -->
        <div class="calendar-body" style="padding: 1.5rem; padding-bottom: 2rem;">
            <!-- MONTH SELECTOR -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <button type="button" wire:click="previousMonth" class="text-sub" style="cursor: pointer; background: none; border: none;">
                    <x-heroicon-m-chevron-left style="width: 1.25rem; height: 1.25rem;"/>
                </button>
                <div style="text-align: center;">
                    <span class="text-main" style="font-size: 0.95rem; font-weight: 850; text-transform: uppercase;">{{ $cal['monthName'] }} {{ $cal['year'] }}</span>
                </div>
                <button type="button" wire:click="nextMonth" class="text-sub" style="cursor: pointer; background: none; border: none;">
                    <x-heroicon-m-chevron-right style="width: 1.25rem; height: 1.25rem;"/>
                </button>
            </div>

            <!-- DAYS OF WEEK -->
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; margin-bottom: 0.75rem;">
                @foreach([__('MIN'),__('SEN'),__('SEL'),__('RAB'),__('KAM'),__('JUM'),__('SAB')] as $day)
                    <span class="text-dim" style="font-size: 0.65rem; font-weight: 850;">{{ $day }}</span>
                @endforeach
            </div>

            <!-- DATES GRID -->
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; row-gap: 0.5rem;">
                @for($i = 0; $i < $cal['startDay']; $i++) 
                    <span></span> 
                @endfor

                @for($i = 1; $i <= $cal['daysInMonth']; $i++)
                    @php
                        $isToday = $i == $cal['today'];
                        $isSelected = $i == $this->selectedDay;
                        $hasAgenda = isset($cal['agendas'][$i]);
                    @endphp
                    <div style="position: relative; display: flex; justify-content: center; align-items: center; height: 35px;">
                        <button type="button" 
                           @if($hasAgenda)
                                wire:click="selectDay({{ $i }})" @click="openDetail = true"
                           @else
                                wire:click="selectDay({{ $i }})"
                           @endif
                           class="day-btn {{ $isSelected ? 'is-selected' : '' }} {{ $hasAgenda ? 'has-agenda' : '' }}"
                           style="width: 32px; height: 32px; font-size: 0.8rem; font-weight: 800; border-radius: 0.5rem; transition: all 0.2s; border: none; cursor: pointer;">
                            {{ $i }}
                        </button>
                        
                        @if($hasAgenda)
                            <div class="agenda-dot">
                                <span style="font-size: 5px; font-weight: 900;">•</span>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

    </div>

    <!-- MODAL POPUP DETAIL AGENDA (Strictly Centered teleported to Body) -->
    <template x-teleport="body">
        <div x-show="openDetail" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="agenda-modal-overlay"
             style="position: fixed !important; top: 0 !important; left: 0 !important; width: 100vw !important; height: 100vh !important; z-index: 999999 !important; display: flex !important; align-items: center !important; justify-content: center !important; backdrop-filter: blur(10px); padding: 2rem;">
            
            <div @click.away="openDetail = false" 
                 x-show="openDetail"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-8"
                 class="agenda-modal-content"
                 style="width: 100%; max-width: 500px; border-radius: 2.5rem; overflow: hidden; display: flex; flex-direction: column; margin: auto !important;">
                
                <!-- HEADER MODAL -->
                <div style="background: #1e3a8a; padding: 1.75rem 2rem; display: flex; align-items: center; justify-content: space-between; color: white; flex-shrink: 0;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.15); border-radius: 1.1rem; display: flex; align-items: center; justify-content: center;">
                            <x-heroicon-o-calendar style="width: 1.5rem; height: 1.5rem;"/>
                        </div>
                        <div>
                            <h3 style="font-size: 1.15rem; font-weight: 850; margin: 0; letter-spacing: -0.01em;">{{ __('Daftar Agenda') }}</h3>
                            <p style="font-size: 0.8rem; opacity: 0.85; margin: 0; font-weight: 600;">{{ $cal['selectedDateFull'] }}</p>
                        </div>
                    </div>
                    <button @click="openDetail = false" style="background: rgba(255,255,255,0.1); border: none; border-radius: 0.8rem; padding: 0.5rem; color: white; cursor: pointer; transition: all 0.2s;">
                        <x-heroicon-m-x-mark style="width: 1.35rem; height: 1.35rem;"/>
                    </button>
                </div>

                <!-- CONTENT MODAL -->
                <div style="padding: 2rem; max-height: 60vh; overflow-y: auto;" class="modal-body-content">
                    <div style="display: flex; flex-direction: column; gap: 1.75rem;">
                        @foreach($cal['selectedAgendas'] as $agenda)
                            <div style="position: relative; padding-left: 1.5rem; border-left: 4px solid #2563eb; padding-bottom: 0.5rem;">
                                <h4 class="text-main" style="font-size: 1.25rem; font-weight: 850; line-height: 1.4; margin-bottom: 1rem;">{{ $agenda->caption }}</h4>
                                
                                <div style="display: flex; flex-direction: column; gap: 0.8rem; margin-bottom: 1.25rem;">
                                    <div class="modal-detail-item">
                                        <div class="item-icon icon-clock">
                                            <x-heroicon-m-clock style="width: 1.15rem; height: 1.15rem;"/>
                                        </div>
                                        <span>{{ $agenda->schedule->timezone('Asia/Makassar')->translatedFormat('H:i') }} {{ __('WITA') }}</span>
                                    </div>
                                    <div class="modal-detail-item">
                                        <div class="item-icon icon-pin">
                                            <x-heroicon-m-map-pin style="width: 1.15rem; height: 1.15rem;"/>
                                        </div>
                                        <span>{{ $agenda->location ?? __('Lokasi Internal') }}</span>
                                    </div>
                                </div>

                                @if($agenda->description)
                                    <div class="description-box">
                                        <div style="font-size: 0.65rem; font-weight: 850; text-transform: uppercase; margin-bottom: 0.6rem; letter-spacing: 0.05em;" class="text-dim">{{ __('Catatan Kegiatan') }}</div>
                                        <p style="font-size: 0.9rem; line-height: 1.6; font-weight: 500; margin: 0;" class="text-sub">
                                            {{ $agenda->description }}
                                        </p>
                                    </div>
                                @endif
                                
                                @if(!$loop->last)
                                    <div style="margin-top: 1.5rem; height: 1px; background: rgba(148, 163, 184, 0.1); width: 100%;"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- FOOTER MODAL -->
                <div style="padding: 1.5rem 2rem; border-top: 1px solid rgba(148, 163, 184, 0.1); display: flex;" class="modal-footer">
                    <button @click="openDetail = false" style="width: 100%; background: #2563eb; color: white; padding: 1rem; border-radius: 1.25rem; font-size: 1rem; font-weight: 850; border: none; cursor: pointer; transition: all 0.2s; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.25);" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';" class="modal-close-btn">
                        {{ __('Tutup Rincian') }}
                    </button>
                </div>
            </div>
        </div>
    </template>

    <style>
        .calendar-body, .calendar-preview { background: #f8fafc; }
        .dark .calendar-body, .dark .calendar-preview { background: #0f172a; }

        .day-btn { background: transparent; color: #475569; }
        .dark .day-btn { color: #94a3b8; }
        
        .day-btn.is-selected { background: #2563eb !important; color: white !important; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3); }
        .day-btn:hover:not(.is-selected) { background: rgba(37, 99, 235, 0.1); color: #2563eb; }
        .dark .day-btn:hover:not(.is-selected) { background: rgba(37, 99, 235, 0.1); color: #3b82f6; }

        .agenda-dot { position: absolute; top: 0; right: 2px; width: 12px; height: 12px; background: #ef4444; border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; border: 2px solid #f8fafc; }
        .dark .agenda-dot { border-color: #0f172a; }

        /* Modal specific dark mode */
        .agenda-modal-overlay { background: rgba(15, 23, 42, 0.6); }
        .agenda-modal-content { background: white; box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.4); border: 1px solid #f1f5f9; }
        .dark .agenda-modal-content { background: #1e293b; border-color: #334155; box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.6); }

        .modal-body-content { background: white; }
        .dark .modal-body-content { background: #1e293b; }

        .modal-footer { background: #f8fafc; }
        .dark .modal-footer { background: #0f172a; }

        .modal-detail-item { display: flex; align-items: center; gap: 0.8rem; color: #475569; font-size: 0.9rem; font-weight: 700; }
        .dark .modal-detail-item { color: #94a3b8; }

        .item-icon { width: 32px; height: 32px; border-radius: 0.7rem; display: flex; align-items: center; justify-content: center; }
        .icon-clock { background: #eff6ff; color: #2563eb; }
        .icon-pin { background: #fff1f2; color: #e11d48; }
        .dark .icon-clock { background: rgba(37, 99, 235, 0.1); color: #60a5fa; }
        .dark .icon-pin { background: rgba(225, 29, 72, 0.1); color: #fb7185; }

        .description-box { background: #f8fafc; padding: 1.5rem; border-radius: 1.5rem; border: 1px dashed #ced4da; }
        .dark .description-box { background: #0f172a; border-color: #334155; }
        
        .dark .modal-close-btn { background: #2563eb; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.25); }
        .dark .more-agendas { color: #60a5fa !important; }
    </style>
</div>

