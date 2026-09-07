<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\LeaderProfile;
use App\Models\Post;
use App\Models\Service;
use App\Models\Slider;
use App\Models\WebsiteIdentity;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    public function index()
    {
        $site = WebsiteIdentity::query()->latest('id')->first();
        $leader = LeaderProfile::query()
            ->where('status', true)
            ->with('histories')
            ->orderBy('order')
            ->first();

        $posts = Post::query()
            ->with(['category', 'file'])
            ->where('status', 1)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->take(6)
            ->get();

        $featuredNewsItems = $posts->take(4)
            ->map(fn (Post $post) => [
                'title' => $post->title,
                'category' => $post->category?->name ?? 'Berita',
                'date' => optional($post->published_at)->translatedFormat('d F Y') ?? optional($post->created_at)->translatedFormat('d F Y'),
                'image' => $this->resolveMediaUrl($post->file?->storage_path ?? $post->file?->path, asset('images/desamahakamulu.jpg')),
                'excerpt' => Str::limit(trim(strip_tags($post->content ?? '')), 160),
                'slug' => $post->slug,
                'url' => route('berita.show', $post->slug),
            ])
            ->values();

        $pengumumanItems = Slider::query()
            ->with('file')
            ->where('status', 1)
            ->orderByDesc('is_pinned')
            ->orderByDesc('updated_at')
            ->take(5)
            ->get()
            ->map(fn (Slider $slider) => [
                'title' => $slider->caption ?: 'Pengumuman',
                'description' => $slider->description,
                'image' => $this->resolveMediaUrl($slider->file?->storage_path ?? $slider->file?->path, asset('images/desamahakamulu.jpg')),
                'link' => $slider->link,
            ])
            ->values();

        $agendaTotalCount = Agenda::query()->count();

        $agendaItems = Agenda::query()
            ->orderBy('schedule')
            ->take(5)
            ->get()
            ->map(function (Agenda $agenda) {
                $schedule = $agenda->schedule ? Carbon::parse($agenda->schedule) : null;
                $localizedSchedule = $schedule?->copy()->locale('id');

                return [
                    'title' => $agenda->caption,
                    'description' => $agenda->description,
                    'date' => $localizedSchedule?->translatedFormat('d F Y') ?? '-',
                    'iso' => $schedule?->format('Y-m-d') ?? null,
                    'time' => $localizedSchedule?->translatedFormat('H:i') ?? '-',
                    'hari' => $localizedSchedule?->translatedFormat('l') ?? '-',
                    'location' => $agenda->location ?? 'Mahakam Ulu',
                    'opd' => $agenda->opd ?? '-',
                    'day' => $schedule?->translatedFormat('d') ?? '-',
                    'month' => strtoupper((string) $localizedSchedule?->translatedFormat('M')),
                ];
            })
            ->values();

        $allLinks = $this->serviceLinks();

        return view('landing', [
            'site' => $site,
            'leader' => $leader,
            'featuredNewsItems' => $featuredNewsItems,
            'pengumumanItems' => $pengumumanItems,
            'agendaItems' => $agendaItems,
            'agendaTotalCount' => $agendaTotalCount,
            'allLinks' => $allLinks,
        ]);
    }

    public function showEGovPage()
    {
        return view('egov', [
            'allLinks' => $this->serviceLinks(),
        ]);
    }

    private function serviceLinks()
    {
        return Service::query()
            ->with('file')
            ->where('status', true)
            ->orderBy('name')
            ->get()
            ->map(fn (Service $service) => [
                'name' => $service->name,
                'desc' => $service->description,
                'link' => $service->link ?: '#',
                'logo' => $this->resolveMediaUrl(
                    $service->file?->storage_path ?? $service->file?->path,
                    $this->serviceLogoFallback($service->name)
                ),
            ])
            ->values();
    }

    private function resolveMediaUrl(?string $path, string $fallback): string
    {
        if (blank($path)) {
            return $fallback;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $normalizedPath = str_replace('\\', '/', trim($path));
        $normalizedPath = ltrim($normalizedPath, '/');
        $normalizedPath = preg_replace('#^(?:storage/app/public/|app/public/|public/storage/|public/)#i', '', $normalizedPath);
        $normalizedPath = preg_replace('#^storage/#i', '', $normalizedPath);

        if (blank($normalizedPath)) {
            return $fallback;
        }

        return asset('storage/' . ltrim($normalizedPath, '/'));
    }

    private function serviceLogoFallback(?string $serviceName): string
    {
        $name = Str::upper(trim((string) $serviceName));

        return match (true) {
            Str::contains($name, 'E-CATALOGUE') => asset('images/logo_e_catalogue.webp'),
            Str::contains($name, 'LAPOR') => asset('images/logo_lapor_go_id.png'),
            Str::contains($name, 'LPSE') => asset('images/lpse.webp'),
            Str::contains($name, 'SIPD') => asset('images/logo_sipd_kemendagri.png'),
            Str::contains($name, 'SIRUP') => asset('images/logo_sirup.png'),
            Str::contains($name, 'SRIKANDI') => asset('images/logo_srikandi.webp'),
            Str::contains($name, 'KEMENDAGRI') => asset('images/logo_sipd_kemendagri.png'),
            default => asset('images/logo_mahulu.png'),
        };
    }
}