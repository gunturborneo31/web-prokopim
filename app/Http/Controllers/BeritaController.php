<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = trim((string) $request->string('q'));
        $activeCategory = trim((string) $request->string('kategori'));

        $baseQuery = Post::query()
            ->with(['category', 'file'])
            ->where('status', 1);

        if ($searchQuery !== '') {
            $baseQuery->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('content', 'like', '%' . $searchQuery . '%');
            });
        }

        if ($activeCategory !== '') {
            $baseQuery->whereHas('category', fn ($query) => $query->where('name', $activeCategory));
        }

        $featuredPost = (clone $baseQuery)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->first();

        $allNews = $baseQuery
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString()
            ->through(fn (Post $post) => $this->transformPost($post));

        $categories = PostCategory::query()
            ->where('active', true)
            ->orderBy('name')
            ->pluck('name')
            ->values();

        return view('pages.berita.index', [
            'featuredNews' => $featuredPost ? $this->transformPost($featuredPost) : [
                'slug' => '#',
                'title' => 'Belum ada berita dipublikasikan',
                'category' => 'Berita',
                'date' => now()->translatedFormat('d F Y'),
                'views' => 0,
                'image' => asset('images/desamahakamulu.jpg'),
                'excerpt' => 'Konten berita akan tampil di sini setelah dipublikasikan melalui panel admin.',
            ],
            'allNews' => $allNews,
            'categories' => $categories,
            'searchQuery' => $searchQuery,
            'activeCategory' => $activeCategory,
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::query()
            ->with(['category', 'file'])
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('read');
        $post->refresh();

        $relatedQuery = Post::query()
            ->with(['category', 'file'])
            ->where('status', 1)
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->orderByDesc('id');

        if ($post->category_id) {
            $relatedQuery->where('category_id', $post->category_id);
        }

        return view('pages.berita.show', [
            'news' => $this->transformPost($post, true),
            'recentNews' => Post::query()
                ->with(['category', 'file'])
                ->where('status', 1)
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take(5)
                ->get()
                ->map(fn (Post $item) => $this->transformPost($item))
                ->values(),
            'related' => $relatedQuery
                ->take(3)
                ->get()
                ->map(fn (Post $item) => $this->transformPost($item))
                ->values(),
        ]);
    }

    private function transformPost($post, bool $includeContent = false): array
    {
        if (! $post instanceof Post) {
            return [
                'title' => 'Konten tidak tersedia',
                'slug' => '#',
                'category' => 'Berita',
                'date' => now()->translatedFormat('d F Y'),
                'views' => 0,
                'image' => asset('images/desamahakamulu.jpg'),
                'excerpt' => 'Data berita belum tersedia.',
                'author' => 'Admin',
                'tags' => [],
                'content' => $includeContent ? '' : null,
            ];
        }

        $content = trim((string) $post->content);
        $contentForView = $content !== '' ? $content : '';

        return [
            'title' => $post->title,
            'slug' => $post->slug,
            'category' => $post->category?->name ?? 'Berita',
            'date' => optional($post->published_at)->translatedFormat('d F Y') ?? optional($post->created_at)->translatedFormat('d F Y'),
            'views' => (int) $post->read,
            'image' => $this->resolveMediaUrl($post->file?->storage_path ?? $post->file?->path, asset('images/desamahakamulu.jpg')),
            'excerpt' => Str::limit(trim(strip_tags($content)), 180),
            'author' => $post->penulis ?: ($post->user?->name ?? 'Admin'),
            'tags' => is_array($post->tags) ? $post->tags : array_values(array_filter(array_map('trim', explode(',', (string) $post->tags)))),
            'content' => $includeContent ? $contentForView : null,
        ];
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
}