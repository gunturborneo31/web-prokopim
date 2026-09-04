@php
    $site = $site ?? \App\Models\WebsiteIdentity::query()->latest('id')->first();
    $brandTitle = $site?->welcome_title ?: 'PROKOPIM';
    $brandName = $site?->name ?: 'MAHAKAM ULU';
    $contactAddress = $site?->address ?: 'Komplek Perkantoran Semi Permanen Ujoh Bilang';
    $contactPhone = $site?->phone ?: '0853-4559-2345';
    $contactEmail = $site?->email ?: 'info@prokopimmahulu.com';
    $instagramUrl = $site?->instagram ?: 'https://www.instagram.com/prokopimmahulu/';
    $instagramLabel = ltrim(parse_url($instagramUrl, PHP_URL_PATH) ?? '@prokopimmahulu', '/');
    $youtubeUrl = $site?->youtube ?: 'https://www.youtube.com/@PROKOPIM.mahulu';
    $youtubeLabel = 'PROKOPIM Kab MAHULU';
@endphp

<footer class="bg-instansi-primary text-white relative overflow-hidden">
    <!-- Decorative subtle border top -->
    <div class="absolute top-0 left-0 w-full h-1 bg-white"></div>

    <div class="max-w-[1440px] w-full mx-auto px-6 sm:px-8 lg:px-12 xl:px-16 py-16 relative z-10">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-12 lg:gap-8">
            
            <!-- Column 1: Info & Contact -->
            <div class="flex flex-col space-y-6 lg:max-w-[320px] xl:max-w-[380px]">
                <!-- Logo -->
                <div class="flex items-center space-x-4 mb-2">
                    <img src="{{ asset('images/Mahakam_Ulu.webp') }}" 
                         class="logo-sharp h-14 w-auto drop-shadow-lg" alt="Logo Pemkab Mahakam Ulu" 
                         onerror="this.style.display='none'">
                    <div>
                        <h3 class="font-extrabold text-xl leading-tight text-white tracking-wide">{{ strtoupper($brandTitle) }}</h3>
                        <p class="text-[13px] font-medium text-white tracking-widest uppercase">{{ strtoupper($brandName) }}</p>
                    </div>
                </div>

                <!-- Contact List -->
                <ul class="space-y-4 text-sm text-slate-300 max-w-xs">
                    <li class="flex items-start space-x-3 group">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center flex-shrink-0 group-hover:bg-white/20 transition-colors border border-white/5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <span class="pt-1.5 leading-snug">{{ $contactAddress }}</span>
                    </li>
                    <li class="flex items-center space-x-3 group">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center flex-shrink-0 group-hover:bg-white/20 transition-colors border border-white/5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        <span class="font-medium tracking-wide">{{ $contactPhone }}</span>
                    </li>
                    <li class="flex items-center space-x-3 group">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center flex-shrink-0 group-hover:bg-white/20 transition-colors border border-white/5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <span>{{ $contactEmail }}</span>
                    </li>
                    <li class="flex items-center space-x-3 group">
                        <a href="{{ $instagramUrl }}" target="_blank" class="flex items-center space-x-3 group w-full">
                            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center flex-shrink-0 group-hover:bg-white/20 group-hover:border-white/30 transition-all duration-300 border border-white/5">
                                <svg class="w-4 h-4 text-white group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.315 2zm-1.2 1.95c-2.048 0-2.29.009-3.033.043-.738.034-1.14.152-1.405.255-.35.136-.6.298-.865.563-.265.265-.427.515-.563.865-.103.265-.221.667-.255 1.405-.034.743-.043.985-.043 3.033 0 2.048.009 2.29.043 3.033.034.738.152 1.14.255 1.405.136.35.298.6.563.865.265.265.515.427.865.563.265.103.667.221 1.405.255.743.034.985.043 3.033.043 2.048 0 2.29-.009 3.033-.043.738-.034 1.14-.152 1.405-.255.35-.136.6-.298.865-.563.265-.265.427-.515.563-.865.103-.265.221-.667.255-1.405.034-.743.043-.985.043-3.033 0-2.048-.009-2.29-.043-3.033-.034-.738-.152-1.14-.255-1.405-.136-.35-.298-.6-.563-.865-.265-.265-.515-.427-.865-.563-.103-.265-.221-.667-.255-1.405-.034-.743-.043-.985-.043-3.033zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.95a3.185 3.185 0 100 6.37 3.185 3.185 0 000-6.37zM15.353 7.828a1.296 1.296 0 100-2.592 1.296 1.296 0 000 2.592z" clip-rule="evenodd" /></svg>
                            </div>
                            <span class="group-hover:text-white transition-colors">{{ $instagramLabel }}</span>
                        </a>
                    </li>
                    <li class="flex items-center space-x-3 group">
                        <a href="{{ $youtubeUrl }}" target="_blank" class="flex items-center space-x-3 group w-full">
                            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center flex-shrink-0 group-hover:bg-white/20 group-hover:border-white/30 transition-all duration-300 border border-white/5">
                                <svg class="w-4 h-4 text-white group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </div>
                            <span class="group-hover:text-white transition-colors">{{ $youtubeLabel }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 2: Link Terkait -->
            <div class="lg:w-auto">
                <h4 class="font-bold text-white mb-6 uppercase tracking-wider text-sm flex items-center">
                    <span class="w-2 h-2 rounded-full bg-white mr-3"></span>
                    Link Terkait
                </h4>
                <ul class="space-y-3 text-[13px] text-slate-300 font-medium tracking-wide">
                    @php
                        $linkTerkait = [
                            ['label' => 'KEMENTERIAN PRESIDEN', 'url' => 'https://www.setneg.go.id/'],
                            ['label' => 'KEMENDAGRI RI', 'url' => 'https://pelita.kemendagri.go.id/'],
                            ['label' => 'KEMENKEU RI', 'url' => 'https://www.kemenkeu.go.id/'],
                            ['label' => 'BAPPENAS RI', 'url' => 'https://www.bappenas.go.id/'],
                            ['label' => 'PROKOPIM KALTIM', 'url' => 'https://bappeda.kaltimprov.go.id/beranda'],
                            ['label' => 'BPS PUSAT', 'url' => 'https://www.bps.go.id/id'],
                            ['label' => 'BPS KALTIM', 'url' => 'https://kaltim.bps.go.id/id'],
                        ];
                    @endphp
                    @foreach($linkTerkait as $link)
                    <li>
                        <a href="{{ $link['url'] }}" target="_blank" class="hover:text-white flex items-center group transition-all duration-300 hover:translate-x-1">
                            <span class="text-white/30 mr-2 group-hover:text-white transition-colors">-</span> {{ $link['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 3: PROKOPIM Kota & Kabupaten -->
            <div class="lg:w-auto">
                <h4 class="font-bold text-white mb-6 uppercase tracking-wider text-sm flex items-center">
                    <span class="w-2 h-2 rounded-full bg-white mr-3"></span>
                    PROKOPIM Kota
                </h4>
                <ul class="space-y-2 text-[13px] text-slate-300 font-medium tracking-wide mb-8">
                    @php
                        $prokopimKota = [
                            ['label' => 'Balikpapan', 'url' => 'https://bappeda.balikpapan.go.id/'],
                            ['label' => 'Bontang', 'url' => 'https://www.instagram.com/ppidbapperidabontang/'],
                            ['label' => 'Samarinda', 'url' => 'https://bapperida.samarindakota.go.id/web'],
                        ];
                    @endphp
                    @foreach($prokopimKota as $kota)
                    <li>
                        <a href="{{ $kota['url'] }}" target="_blank" class="hover:text-white flex items-center group transition-all duration-300 hover:translate-x-1">
                            <span class="text-white/30 mr-2 group-hover:text-white transition-colors">-</span> {{ $kota['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                <h4 class="font-bold text-white mb-6 uppercase tracking-wider text-sm flex items-center">
                    <span class="w-2 h-2 rounded-full bg-white mr-3"></span>
                    PROKOPIM Kabupaten
                </h4>
                <div class="grid grid-cols-1 gap-2 text-[13px] text-slate-300 font-medium tracking-wide">
                    @php
                        $prokopimKab = [
                            ['label' => 'Kutai Barat', 'url' => 'http://bappedalitbang.kutaibaratkab.go.id/'],
                            ['label' => 'Kutai Kartanegara', 'url' => 'https://www.instagram.com/bappeda.kutaikartanegara/'],
                            ['label' => 'Kutai Timur', 'url' => 'https://www.instagram.com/bappeda.kutim/'],
                            ['label' => 'Berau', 'url' => 'http://baplitbang.beraukab.go.id/'],
                            ['label' => 'Penajam Paser Utara', 'url' => 'https://bappeda.penajamkab.go.id/'],
                            ['label' => 'Paser', 'url' => 'https://bappedalitbang.paserkab.go.id/'],
                        ];
                    @endphp
                    @foreach($prokopimKab as $kab)
                        <a href="{{ $kab['url'] }}" target="_blank" class="hover:text-white flex items-center group transition-all duration-300 hover:translate-x-1">
                            <span class="text-white/30 mr-2 group-hover:text-white transition-colors">-</span> {{ $kab['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Column 4: Statistik Pengunjung -->
            <div class="lg:max-w-[300px] xl:max-w-[320px] w-full">
                <h4 class="font-bold text-white mb-6 uppercase tracking-wider text-sm flex items-center">
                    <span class="w-2 h-2 rounded-full bg-white mr-3"></span>
                    Statistik Pengunjung
                </h4>
                <div class="bg-white/5 rounded-2xl p-6 border border-white/5 backdrop-blur-sm shadow-xl">
                    <ul class="space-y-3 text-[13px]">
                        @php
                            $stats = [
                                'Hari Ini' => '23',
                                'Kemarin' => '119',
                                'Bulan Ini' => '366407',
                                'Tahun Ini' => '367012',
                                'Total' => '367012'
                            ];
                        @endphp
                        @foreach($stats as $label => $value)
                        <li class="flex justify-between items-center pb-2 {{ !$loop->last ? 'border-b border-white/10' : '' }}">
                            <span class="text-slate-300">{{ $label }}</span>
                            <span class="flex items-center space-x-4">
                                <span class="text-white/30">:</span>
                                <span class="font-bold text-white w-16 text-right">{{ $value }}</span>
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Bottom Bar (Developer Info) -->
    <div class="bg-instansi-primary border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-5 flex items-center justify-center">
            <p class="text-[13px] text-slate-500 tracking-wider">
                <span class="text-white/60">About Developer</span> - <span class="text-white font-medium hover:text-white cursor-pointer transition-colors">AK Kreatif</span>
            </p>
        </div>
    </div>
</footer>
