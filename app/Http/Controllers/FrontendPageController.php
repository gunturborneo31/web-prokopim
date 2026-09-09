<?php

namespace App\Http\Controllers;

use App\Models\Aparatur;
use App\Models\Award;
use App\Models\DocumentStat;
use App\Models\DynamicPage;
use App\Models\LeaderProfile;
use App\Models\Pengaduan;
use App\Models\Ppid;
use App\Models\PpidRequest;
use App\Models\WebsiteIdentity;
use App\Models\WbsAbout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class FrontendPageController extends Controller
{
    public function showDynamicPage(?string $slug = null)
    {
        $page = null;

        if ($slug) {
            $page = DynamicPage::query()
                ->with('menu.parent.parent')
                ->where('published', true)
                ->where('slug', $slug)
                ->first();
        }

        if (! $page && ! $slug) {
            $page = DynamicPage::query()
                ->with('menu.parent.parent')
                ->where('published', true)
                ->whereHas('menu', fn ($query) => $query->where('link', '/halaman'))
                ->first();
        }

        abort_if(! $page, 404);

        return match ($page->template) {
            'aparatur' => view('pages.profil.dynamic-aparatur', [
                'profilePage' => $page,
                'aparaturs' => Aparatur::query()->where('status', true)->orderBy('order')->get(),
            ]),

            'profil_pimpinan' => view('pages.profil.dynamic-pimpinan', [
                'profilePage' => $page,
                'leaders' => $this->resolveLeaders($page),
            ]),

            'dokumen_grid', 'dokumen_list' => $this->renderDynamicLibraryPage($page),

            default => view('pages.profil.dynamic-content', [
                'profilePage' => $page,
                'site' => WebsiteIdentity::query()->latest('id')->first(),
            ]),
        };
    }

    public function showProfilePage(string $slug)
    {
        $profilePage = $this->findDynamicPage($slug, 'profil', ['penjelasan_1', 'penjelasan_2', 'gambar_1', 'blank_editor', 'tabel']);

        if (! $profilePage) {
            $legacyView = $this->legacyView('pages.profil.' . $slug, [
                'site' => WebsiteIdentity::query()->latest('id')->first(),
            ]);

            if ($legacyView) {
                return $legacyView;
            }
        }

        abort_if(! $profilePage, 404);

        return view('pages.profil.dynamic-content', [
            'profilePage' => $profilePage,
            'site' => WebsiteIdentity::query()->latest('id')->first(),
        ]);
    }

    public function showLeaderProfile()
    {
        $profilePage = $this->findDynamicPage('pimpinan', 'profil', ['profil_pimpinan']);
        $leaders = $this->resolveLeaders($profilePage);

        if (! $profilePage && $leaders->isEmpty()) {
            $legacyView = $this->legacyView('pages.profil.pimpinan');

            if ($legacyView) {
                return $legacyView;
            }
        }

        return view('pages.profil.dynamic-pimpinan', [
            'profilePage' => $profilePage,
            'leaders' => $leaders,
        ]);
    }

    private function resolveLeaders(?DynamicPage $page): Collection
    {
        $contentLeaders = collect(data_get($page?->content, 'leaders', []))
            ->filter(fn ($leader) => is_array($leader))
            ->filter(fn (array $leader) => filled(data_get($leader, 'name')) || filled(data_get($leader, 'position')))
            ->values()
            ->map(function (array $leader) {
                $histories = collect(data_get($leader, 'histories', []))
                    ->filter(fn ($history) => is_array($history))
                    ->map(fn (array $history) => (object) [
                        'year_start' => data_get($history, 'year_start'),
                        'year_end' => data_get($history, 'year_end'),
                        'position' => data_get($history, 'position'),
                        'institution' => data_get($history, 'institution'),
                        'description' => data_get($history, 'description'),
                        'is_current' => (bool) data_get($history, 'is_current'),
                    ])
                    ->values();

                return (object) [
                    'label' => data_get($leader, 'label'),
                    'name' => data_get($leader, 'name'),
                    'position' => data_get($leader, 'position'),
                    'nip' => data_get($leader, 'nip'),
                    'pangkat' => data_get($leader, 'pangkat'),
                    'golongan' => data_get($leader, 'golongan'),
                    'pendidikan' => data_get($leader, 'pendidikan'),
                    'photo' => data_get($leader, 'photo'),
                    'quote' => data_get($leader, 'quote'),
                    'histories' => $histories,
                ];
            });

        if ($contentLeaders->isNotEmpty()) {
            return $contentLeaders;
        }

        return LeaderProfile::query()
            ->where('status', true)
            ->with('histories')
            ->orderBy('order')
            ->get();
    }

    public function showAparatur()
    {
        $profilePage = $this->findDynamicPage('aparatur', 'profil', ['aparatur']);
        $aparaturs = Aparatur::query()
            ->where('status', true)
            ->orderBy('order')
            ->get();

        if (! $profilePage && $aparaturs->isEmpty()) {
            $legacyView = $this->legacyView('pages.profil.aparatur');

            if ($legacyView) {
                return $legacyView;
            }
        }

        return view('pages.profil.dynamic-aparatur', [
            'profilePage' => $profilePage,
            'aparaturs' => $aparaturs,
        ]);
    }

    public function showAwards()
    {
        $profilePage = $this->findDynamicPage('penghargaan', 'profil');
        $awards = Award::query()
            ->where('status', true)
            ->orderByDesc('year')
            ->orderBy('order')
            ->get();

        if (! $profilePage && $awards->isEmpty()) {
            $legacyView = $this->legacyView('pages.profil.penghargaan');

            if ($legacyView) {
                return $legacyView;
            }
        }

        return view('pages.profil.dynamic-penghargaan', [
            'profilePage' => $profilePage,
            'awards' => $awards,
        ]);
    }

    public function showLibraryPage(string $section, string $slug)
    {
        $page = $this->findPpidPage($section, $slug);

        if (! $page) {
            $legacyView = $this->legacyView('pages.' . $section . '.' . $slug);

            if ($legacyView) {
                return $legacyView;
            }
        }

        abort_if(! $page, 404);

        $statsMap = $this->loadStatsMap($page);
        $items = $page->items;
        $groupedChildren = $page->children->filter(fn (Ppid $child) => $child->items->isNotEmpty());

        return view('pages.library.dynamic-index', [
            'section' => $section,
            'slug' => $slug,
            'page' => $page,
            'statsMap' => $statsMap,
            'documents' => $section === 'dokumen' ? $this->mapLibraryItems($items, $statsMap, 'Berlaku') : [],
            'regulations' => $section === 'regulasi' ? $this->mapLibraryItems($items, $statsMap, 'Berlaku') : [],
            'informasi' => $section === 'ppid' && $groupedChildren->isEmpty() ? $this->mapLibraryItems($items, $statsMap, 'Tersedia') : [],
            'accordions' => $section === 'ppid'
                ? $groupedChildren->map(function (Ppid $child) use ($statsMap) {
                    return [
                        'title' => $child->name,
                        'rows' => $this->mapLibraryItems($child->items, $statsMap, 'Tersedia')->values()->all(),
                    ];
                })->values()
                : collect(),
        ]);
    }

    public function showComplaintPage()
    {
        return view('pages.layanan.dynamic-pengaduan', [
            'stats' => [
                'total' => Pengaduan::query()->count(),
                'selesai' => Pengaduan::query()->where('status', 'selesai')->count(),
                'diproses' => Pengaduan::query()->where('status', 'diproses')->count(),
            ],
            'site' => WebsiteIdentity::query()->latest('id')->first(),
        ]);
    }

    public function storeComplaint(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'jenis' => ['required', 'string', 'max:100'],
            'subjek' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string', 'min:30'],
        ]);

        $complaint = Pengaduan::create([
            'kode_laporan' => 'LPR-' . now()->format('Y') . '-' . str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT),
            'kategori' => $data['jenis'],
            'nama_lengkap' => $data['nama'],
            'email' => $data['email'] ?? null,
            'telepon' => $data['telepon'],
            'judul_laporan' => $data['subjek'],
            'kronologis' => $data['isi'],
            'status' => 'baru',
        ]);

        return response()->json([
            'message' => 'Pengaduan berhasil dikirim.',
            'ticket' => $complaint->kode_laporan,
        ]);
    }

    public function showComplaintStatusPage()
    {
        return view('pages.layanan.dynamic-cek-status');
    }

    public function lookupComplaintStatus(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ticket' => ['required', 'string'],
        ]);

        $complaint = Pengaduan::query()
            ->where('kode_laporan', strtoupper(trim($validated['ticket'])))
            ->first();

        if (! $complaint) {
            return response()->json(['message' => 'Nomor tiket tidak ditemukan.'], 404);
        }

        return response()->json([
            'ticket' => $complaint->kode_laporan,
            'name' => $complaint->is_anonymous ? 'Anonim' : ($complaint->nama_lengkap ?: '-'),
            'category' => Str::headline($complaint->kategori),
            'subject' => $complaint->judul_laporan,
            'submitted_at' => optional($complaint->created_at)->translatedFormat('d F Y H:i'),
            'status' => $complaint->status,
            'status_label' => $complaint->status_label,
            'public_response' => $complaint->respon_publik,
            'admin_note' => $complaint->catatan_admin,
        ]);
    }

    public function showWbsPage()
    {
        return view('pages.layanan.dynamic-wbs', [
            'about' => WbsAbout::query()->where('is_active', true)->latest('id')->first(),
            'stats' => [
                'total' => Pengaduan::query()->where('kategori', 'wbs')->count(),
                'selesai' => Pengaduan::query()->where('kategori', 'wbs')->where('status', 'selesai')->count(),
                'diproses' => Pengaduan::query()->where('kategori', 'wbs')->where('status', 'diproses')->count(),
            ],
        ]);
    }

    public function storeWbs(Request $request): JsonResponse
    {
        $data = $request->validate([
            'anonim' => ['nullable', 'boolean'],
            'nama' => ['nullable', 'string', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'jenis' => ['required', 'string', 'max:100'],
            'terlapor' => ['required', 'string', 'max:255'],
            'waktu' => ['nullable', 'date'],
            'isi' => ['required', 'string', 'min:30'],
        ]);

        $complaint = Pengaduan::create([
            'kode_laporan' => 'WBS-' . strtoupper(Str::random(8)),
            'kategori' => 'wbs',
            'nama_lengkap' => ! empty($data['anonim']) ? 'Anonim' : ($data['nama'] ?: 'Anonim'),
            'telepon' => ! empty($data['anonim']) ? null : ($data['telepon'] ?? null),
            'judul_laporan' => $data['terlapor'],
            'kronologis' => $data['isi'],
            'tanggal_kejadian' => $data['waktu'] ?? null,
            'is_anonymous' => ! empty($data['anonim']),
            'status' => 'baru',
        ]);

        return response()->json([
            'message' => 'Laporan WBS berhasil dikirim.',
            'ticket' => $complaint->kode_laporan,
        ]);
    }

    public function showPpidRequestPage()
    {
        return view('pages.ppid.dynamic-permohonan', [
            'stats' => [
                'year' => PpidRequest::query()->whereYear('created_at', now()->year)->count(),
                'month' => PpidRequest::query()->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count(),
                'today' => PpidRequest::query()->whereDate('created_at', now())->count(),
            ],
        ]);
    }

    public function showPpidHub()
    {
        return view('pages.ppid.index', [
            'site' => WebsiteIdentity::query()->latest('id')->first(),
        ]);
    }

    public function showPpidInformationTypes()
    {
        $types = collect([
            [
                'slug' => 'serta-merta',
                'title' => 'Informasi Serta Merta',
                'description' => 'Informasi yang wajib diumumkan tanpa penundaan ketika berdampak pada hajat hidup orang banyak.',
            ],
            [
                'slug' => 'setiap-saat',
                'title' => 'Informasi Setiap Saat',
                'description' => 'Informasi yang harus tersedia setiap saat dan dapat diberikan kepada pemohon informasi publik.',
            ],
            [
                'slug' => 'berkala',
                'title' => 'Informasi Berkala',
                'description' => 'Informasi publik yang diumumkan secara rutin dan berkala oleh badan publik.',
            ],
            [
                'slug' => 'dikecualikan',
                'title' => 'Informasi Dikecualikan',
                'description' => 'Informasi tertentu yang dikecualikan dari keterbukaan sesuai peraturan perundang-undangan.',
            ],
        ])->map(function (array $type) {
            $page = $this->findPpidPage('ppid', $type['slug']);

            if (! $page) {
                return $type + [
                    'exists' => false,
                    'categories' => collect(),
                ];
            }

            $statsMap = $this->loadStatsMap($page);
            $directItems = $this->mapLibraryItems($page->items, $statsMap, 'Tersedia')->values();

            $childCategories = $page->children
                ->filter(fn (Ppid $child) => $child->items->isNotEmpty())
                ->values()
                ->map(function (Ppid $child) use ($statsMap, $type) {
                    return [
                        'title' => $child->name,
                        'rows' => $this->mapLibraryItems($child->items, $statsMap, 'Tersedia')->values(),
                        'categorySlug' => $type['slug'],
                    ];
                });

            if ($childCategories->isEmpty() && $directItems->isNotEmpty()) {
                $childCategories = collect([[
                    'title' => 'Daftar Informasi',
                    'rows' => $directItems,
                    'categorySlug' => $type['slug'],
                ]]);
            }

            return $type + [
                'exists' => true,
                'categories' => $childCategories,
            ];
        })->values();

        return view('pages.ppid.information-types', [
            'types' => $types,
            'defaultTypeSlug' => data_get($types->first(), 'slug', 'serta-merta'),
            'site' => WebsiteIdentity::query()->latest('id')->first(),
        ]);
    }

    public function storePpidRequest(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:30'],
            'rincian_informasi' => ['required', 'string'],
            'tujuan_penggunaan' => ['required', 'string'],
            'cara_mendapatkan' => ['required', 'string', 'max:255'],
            'cara_memperoleh' => ['required', 'string', 'max:255'],
        ]);

        $record = PpidRequest::create($data + [
            'pekerjaan' => $data['pekerjaan'] ?: '-',
            'kode_permohonan' => 'PPID-' . now()->format('Y') . '-' . str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT),
            'status' => 'menunggu',
        ]);

        return response()->json([
            'message' => 'Permohonan informasi berhasil dikirim.',
            'ticket' => $record->kode_permohonan,
        ]);
    }

    public function lookupPpidRequest(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ticket' => ['required', 'string'],
        ]);

        $record = PpidRequest::query()
            ->where('kode_permohonan', strtoupper(trim($validated['ticket'])))
            ->first();

        if (! $record) {
            return response()->json(['message' => 'Nomor permohonan tidak ditemukan.'], 404);
        }

        return response()->json([
            'ticket' => $record->kode_permohonan,
            'name' => $record->nama_lengkap,
            'email' => $record->email,
            'submitted_at' => optional($record->created_at)->translatedFormat('d F Y H:i'),
            'status' => $record->status,
            'response' => $record->respon_admin,
            'note' => $record->catatan_admin,
        ]);
    }

    private function findDynamicPage(string $slug, string $prefix = '', array $templates = [])
    {
        $candidates = collect([
            $slug,
            trim($prefix . '/' . $slug, '/'),
            Str::slug($slug),
        ])->filter()->unique()->values();

        $query = DynamicPage::query()->where('published', true)->whereIn('slug', $candidates);

        if ($templates !== []) {
            $query->whereIn('template', $templates);
        }

        return $query->first();
    }

    private function findPpidPage(string $section, string $slug): ?Ppid
    {
        $needle = Str::of($slug)->replace('-', ' ')->lower()->toString();

        return Ppid::query()
            ->with(['items', 'children.items'])
            ->get()
            ->first(function (Ppid $page) use ($needle, $section) {
                $name = Str::of($page->name)->lower()->replace('-', ' ')->toString();
                $desc = Str::of((string) $page->description)->lower()->toString();

                if (! str_contains($name, $needle) && ! str_contains($desc, $needle)) {
                    return false;
                }

                if ($section === 'ppid') {
                    return true;
                }

                $markers = $section === 'dokumen'
                    ? ['dokumen', 'renstra', 'renja', 'dpa', 'iku', 'sop', 'sakip', 'rkpd', 'rpjpd', 'rpjmd']
                    : ['regulasi', 'undang', 'peraturan', 'sk'];

                return str_contains($desc, $section) || collect($markers)->contains(fn ($marker) => str_contains($name, $marker));
            });
    }

    private function renderDynamicLibraryPage(DynamicPage $dynamicPage)
    {
        $section = $this->resolveLibrarySectionFromMenu($dynamicPage);
        $content = is_array($dynamicPage->content) ? $dynamicPage->content : [];

        $page = null;

        if (! empty($content['ppid_id'])) {
            $page = Ppid::query()->with(['items', 'children.items'])->find($content['ppid_id']);
        }

        if (! $page) {
            $page = $this->findPpidPage($section, $dynamicPage->slug);
        }

        abort_if(! $page, 404);

        $statsMap = $this->loadStatsMap($page);
        $items = $page->items;
        $groupedChildren = $page->children->filter(fn (Ppid $child) => $child->items->isNotEmpty());

        return view('pages.library.dynamic-index', [
            'section' => $section,
            'slug' => $dynamicPage->slug,
            'page' => $page,
            'statsMap' => $statsMap,
            'documents' => $section === 'dokumen' ? $this->mapLibraryItems($items, $statsMap, 'Berlaku') : [],
            'regulations' => $section === 'regulasi' ? $this->mapLibraryItems($items, $statsMap, 'Berlaku') : [],
            'informasi' => $section === 'ppid' && $groupedChildren->isEmpty() ? $this->mapLibraryItems($items, $statsMap, 'Tersedia') : [],
            'accordions' => $section === 'ppid'
                ? $groupedChildren->map(function (Ppid $child) use ($statsMap) {
                    return [
                        'title' => $child->name,
                        'rows' => $this->mapLibraryItems($child->items, $statsMap, 'Tersedia')->values()->all(),
                    ];
                })->values()
                : collect(),
        ]);
    }

    private function resolveLibrarySectionFromMenu(DynamicPage $dynamicPage): string
    {
        $candidates = collect([
            optional($dynamicPage->menu)->name,
            optional(optional($dynamicPage->menu)->parent)->name,
            optional(optional(optional($dynamicPage->menu)->parent)->parent)->name,
        ])->filter()->map(fn ($name) => Str::lower((string) $name));

        if ($candidates->contains(fn ($name) => str_contains($name, 'regulasi'))) {
            return 'regulasi';
        }

        if ($candidates->contains(fn ($name) => str_contains($name, 'dokumen'))) {
            return 'dokumen';
        }

        return 'ppid';
    }

    private function loadStatsMap(Ppid $page): array
    {
        $keys = collect([$page])
            ->flatMap(function (Ppid $record) {
                $itemIds = $record->items->pluck('id')->map(fn ($id) => 'ppid_item_' . $id);
                $childIds = $record->children->flatMap(fn (Ppid $child) => $child->items->pluck('id')->map(fn ($id) => 'ppid_item_' . $id));

                return $itemIds->merge($childIds);
            })
            ->values();

        if ($keys->isEmpty() || ! Schema::hasTable('document_stats')) {
            return [];
        }

        return DocumentStat::query()
            ->whereIn('doc_key', $keys)
            ->get()
            ->mapWithKeys(fn (DocumentStat $stat) => [
                $stat->doc_key => [
                    'views' => $stat->views,
                    'downloads' => $stat->downloads,
                ],
            ])
            ->all();
    }

    private function mapLibraryItems($items, array $statsMap, string $statusLabel)
    {
        return collect($items)->values()->map(function ($item, $index) use ($statsMap, $statusLabel) {
            $key = 'ppid_item_' . $item->id;

            return [
                'key' => $key,
                'no' => str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
                'title' => $item->name,
                'year' => $item->tanggal_pembuatan ? Carbon::parse($item->tanggal_pembuatan)->format('Y') : optional($item->created_at)->format('Y'),
                'type' => $item->format_informasi ?: strtoupper(pathinfo((string) $item->file, PATHINFO_EXTENSION) ?: 'FILE'),
                'status' => $statusLabel,
                'kategori' => $item->penanggung_jawab,
                'file' => $this->resolveMediaUrl($item->file, ''),
                'views' => $statsMap[$key]['views'] ?? 0,
                'downloads' => $statsMap[$key]['downloads'] ?? 0,
            ];
        });
    }

    private function legacyView(string $view, array $data = [])
    {
        if (! view()->exists($view)) {
            return null;
        }

        return view($view, $data);
    }

    private function resolveMediaUrl(?string $path, string $fallback): string
    {
        if (blank($path)) {
            return $fallback;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, '/storage/')) {
            return $path;
        }

        if (Str::startsWith($path, 'storage/')) {
            return '/' . ltrim($path, '/');
        }

        return '/storage/' . ltrim($path, '/');
    }
}