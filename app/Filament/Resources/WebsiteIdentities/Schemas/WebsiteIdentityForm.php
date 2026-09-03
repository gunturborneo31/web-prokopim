<?php

namespace App\Filament\Resources\WebsiteIdentities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class WebsiteIdentityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Tabs::make('WebsiteIdentityTabs')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('Identitas & Kontak')
                            ->icon('heroicon-m-identification')
                            ->schema([
                                // ── Informasi Dasar ──────────────────────────────────────────
                Section::make(__('Informasi Dasar'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Nama Website'))
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label(__('Deskripsi Website'))
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('welcome_title')
                            ->label(__('Judul Sambutan'))
                            ->placeholder(__('Contoh: Selamat Datang di Web Portal'))
                            ->columnSpanFull(),

                        Textarea::make('welcome_subtitle')
                            ->label(__('Subjudul/Tagline'))
                            ->placeholder(__('Contoh: BIRO PENGADAAN BARANG DAN JASA'))
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Logo & Ikon ───────────────────────────────────────────────
                Section::make(__('Logo & Ikon'))
                    ->schema([
                        FileUpload::make('logo')
                            ->label(__('Logo Utama (Kabupaten)'))
                            ->image()
                            ->disk('public')
                            ->directory('identity')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->helperText(__('Logo daerah/kabupaten yang tampil di kiri header.')),

                        FileUpload::make('logo_secondary')
                            ->label(__('Logo Kedua (Inspektorat)'))
                            ->image()
                            ->disk('public')
                            ->directory('identity')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->helperText(__('Logo inspektorat yang tampil di sebelah logo utama.')),

                        FileUpload::make('favicon')
                            ->label(__('Favicon'))
                            ->image()
                            ->disk('public')
                            ->directory('identity')
                            ->visibility('public')
                            ->preserveFilenames(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Kontak ────────────────────────────────────────────────────
                Section::make(__('Kontak'))
                    ->schema([
                        TextInput::make('email')
                            ->email(),

                        TextInput::make('phone')
                            ->tel(),

                        TextInput::make('header_contact_text')
                            ->label(__('Teks Kontak'))
                            ->placeholder(__('Ada Pertanyaan? Hubungi kami')),

                        TextInput::make('whatsapp')
                            ->label(__('Nomor WhatsApp'))
                            ->tel()
                            ->placeholder(__('Contoh: 081138133333')),

                        Textarea::make('address')
                            ->label(__('Alamat Kantor'))
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        Textarea::make('google_maps_embed')
                            ->label(__('Google Maps Embed (Iframe)'))
                            ->placeholder(__('Tempel kode <iframe src="..."> dari Google Maps di sini'))
                            ->rows(4)
                            ->columnSpanFull()
                            ->helperText(__('Gunakan fitur "Share > Embed a map" di Google Maps untuk mendapatkan kodenya.')),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Media Sosial ──────────────────────────────────────────────
                Section::make(__('Media Sosial (Dinamis)'))
                    ->description(__('Tambahkan link media sosial sebanyak yang Anda butuhkan.'))
                    ->schema([
                        Repeater::make('social_links')
                            ->label('')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('platform')
                                    ->label(__('Platform'))
                                    ->placeholder(__('Ketik nama platform (contoh: Threads)'))
                                    ->datalist([
                                        'Facebook',
                                        'Instagram',
                                        'Twitter / X',
                                        'YouTube',
                                        'TikTok',
                                        'LinkedIn',
                                        'WhatsApp',
                                        'Telegram',
                                    ])
                                    ->required(),
                                TextInput::make('url')
                                    ->label(__('URL / Link Profil'))
                                    ->url()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->reorderable()
                            ->collapsible()
                            ->addActionLabel(__('+ Tambah Media Sosial'))
                            ->itemLabel(fn (array $state): ?string => $state['platform'] ? ucfirst($state['platform']) : null),
                    ])
                    ->columnSpanFull(),

                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Profil & Footer')
                            ->icon('heroicon-m-users')
                            ->schema([
                                // ── Foto Pejabat ──────────────────────────────────────────────
                Section::make(__('Foto Pejabat (Tim Pimpinan)'))
                    ->schema([
                        Repeater::make('leaders')
                            ->label(false)
                            ->schema([
                                FileUpload::make('photo')
                                    ->label(__('Foto'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('identity/leaders')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                        '4:5',
                                    ])
                                    ->maxSize(2048)
                                    ->required(),

                                TextInput::make('name')
                                    ->label(__('Nama Pimpinan'))
                                    ->placeholder('Contoh: Margono, S.T., M.Si')
                                    ->required()
                                    ->columnSpanFull(),

                                TextInput::make('position')
                                    ->label(__('Jabatan'))
                                    ->placeholder('Contoh: Inspektur Kabupaten Mahakam Ulu')
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->defaultItems(1)
                            ->minItems(1)
                            ->maxItems(10)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->addActionLabel(false)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ── Link-Link Footer ──────────────────────────────────────────
                Section::make(__('Link-Link Footer'))
                    ->description(__('Kelola link yang ditampilkan di bagian footer website'))
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                // Kolom 1: Link Terkait
                                Repeater::make('footer_links_related')
                                    ->label(__('Link Terkait'))
                                    ->schema([
                                        TextInput::make('label')
                                            ->label(__('Nama Link'))
                                            ->placeholder(__('Contoh: KEMENDAGRI'))
                                            ->required(),
                                        TextInput::make('url')
                                            ->label(__('URL'))
                                            ->url()
                                            ->placeholder('https://')
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                                    ->addActionLabel(__('+ Tambah Link Terkait')),

                                // Kolom 2: Inspektorat Kota
                                Repeater::make('footer_links_city')
                                    ->label(__('Inspektorat Kota'))
                                    ->schema([
                                        TextInput::make('label')
                                            ->label(__('Nama Kota'))
                                            ->placeholder(__('Contoh: Balikpapan'))
                                            ->required(),
                                        TextInput::make('url')
                                            ->label(__('URL'))
                                            ->url()
                                            ->placeholder('https://')
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                                    ->addActionLabel(__('+ Tambah Inspektorat Kota')),

                                // Kolom 3: Inspektorat Kabupaten
                                Repeater::make('footer_links_regency')
                                    ->label(__('Inspektorat Kabupaten'))
                                    ->schema([
                                        TextInput::make('label')
                                            ->label(__('Nama Kabupaten'))
                                            ->placeholder(__('Contoh: Kutai Barat'))
                                            ->required(),
                                        TextInput::make('url')
                                            ->label(__('URL'))
                                            ->url()
                                            ->placeholder('https://')
                                            ->required(),
                                    ])
                                    ->columns(1)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                                    ->addActionLabel(__('+ Tambah Inspektorat Kab')),
                            ]),
                    ])
                    ->columnSpanFull(),

                            ]),
                        \Filament\Schemas\Components\Tabs\Tab::make('Integrasi & SEO')
                            ->icon('heroicon-m-globe-alt')
                            ->schema([
                                // ── GPR Kominfo Widget ────────────────────────────────────────
                Section::make(__('GPR Kominfo Widget'))
                    ->description(__('Konfigurasi widget berita GPR Kominfo yang tampil di halaman utama website.'))
                    ->schema([
                        Toggle::make('gpr_widget_status')
                            ->label(__('Aktifkan Widget GPR Kominfo'))
                            ->helperText(__('Aktifkan untuk menampilkan widget berita GPR di halaman utama.'))
                            ->default(false),

                        TextInput::make('gpr_widget_rss_url')
                            ->label(__('URL RSS Widget'))
                            ->url()
                            ->placeholder('https://widget.kominfo.go.id/data/latest/gpr.xml')
                            ->default('https://widget.kominfo.go.id/data/latest/gpr.xml')
                            ->helperText(__('URL sumber data RSS untuk widget GPR Kominfo.'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ── Survey Kepuasan Masyarakat ────────────────────────────────
                Section::make(__('Survey Kepuasan Masyarakat'))
                    ->description(__('Konfigurasi koneksi Survey Kepuasan Masyarakat.'))
                    ->schema([
                        TextInput::make('survey_link_url')
                            ->label(__('URL Survey Kepuasan Masyarakat'))
                            ->url()
                            ->placeholder('https://eskm-inspektorat.akkreatif.my.id/')
                            ->default('https://eskm-inspektorat.akkreatif.my.id/')
                            ->helperText(__('URL alamat website e-SKM (Survey Kepuasan Masyarakat).'))
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),

                // ── SEO & Analytics ───────────────────────────────────────────
                Section::make(__('SEO & Analytics'))
                    ->description(__('Pengaturan global untuk optimasi mesin pencari dan analitik.'))
                    ->schema([
                        TextInput::make('seo.default_meta_title')
                            ->label(__('Default Meta Title'))
                            ->placeholder(__('Biarkan kosong untuk menggunakan Nama Website'))
                            ->columnSpanFull(),
                        
                        Textarea::make('seo.default_meta_description')
                            ->label(__('Default Meta Description'))
                            ->placeholder(__('Biarkan kosong untuk menggunakan Deskripsi Website'))
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        FileUpload::make('seo.default_meta_image')
                            ->label(__('Default Share Image (Open Graph)'))
                            ->image()
                            ->disk('public')
                            ->directory('seo')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->helperText(__('Gambar yang muncul saat link website dibagikan ke media sosial. Biarkan kosong untuk menggunakan Logo Utama.'))
                            ->columnSpanFull(),
                            
                        TextInput::make('seo.google_analytics_id')
                            ->label(__('Google Analytics ID'))
                            ->placeholder(__('Contoh: G-XXXXXXXXXX'))
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }
}
