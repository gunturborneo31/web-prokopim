<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = trim((string) $request->string('q'));
        $activeCategory = trim((string) $request->string('kategori'));

        $baseQuery = $this->announcementBaseQuery();

        if ($searchQuery !== '') {
            $baseQuery->where(function (Builder $query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('content', 'like', '%' . $searchQuery . '%');
            });
        }

        if ($activeCategory !== '') {
            $baseQuery->whereHas('category', fn (Builder $query) => $query->where('name', $activeCategory));
        }

        $items = $baseQuery
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString()
            ->through(fn (Post $post) => $this->transformPost($post));

        $categories = PostCategory::query()
            ->where('active', true)
            ->where(function (Builder $query) {
                $query->where('slug', 'pengumuman')
                    ->orWhereRaw('LOWER(name) = ?', ['pengumuman'])
                    ->orWhereRaw('LOWER(name) LIKE ?', ['%pengumuman%']);
            })
            ->orderBy('name')
            ->pluck('name')
            ->values();

        return view('pages.pengumuman.index', [
            'allItems' => $items,
            'categories' => $categories,
            'searchQuery' => $searchQuery,
            'activeCategory' => $activeCategory,
        ]);
    }

    public function show(string $slug)
    {
        /** @var Post $post */
        $post = $this->announcementBaseQuery()
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('read');
        $post->refresh();

        $relatedQuery = $this->announcementBaseQuery()
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->orderByDesc('id');

        if ($post->category_id) {
            $relatedQuery->where('category_id', $post->category_id);
        }

        return view('pages.pengumuman.show', [
            'item' => $this->transformPost($post, true),
            'recentItems' => $this->announcementBaseQuery()
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take(6)
                ->get()
                ->map(fn (Post $newsItem) => $this->transformPost($newsItem))
                ->values(),
            'related' => $relatedQuery
                ->take(4)
                ->get()
                ->map(fn (Post $newsItem) => $this->transformPost($newsItem))
                ->values(),
        ]);
    }

    private function announcementBaseQuery(): Builder
    {
        return Post::query()
            ->with(['category', 'file'])
            ->where('status', 1)
            ->where('type', 'post')
            ->whereHas('category', function (Builder $query) {
                $query->where(function (Builder $categoryQuery) {
                    $categoryQuery->where('slug', 'pengumuman')
                        ->orWhereRaw('LOWER(name) = ?', ['pengumuman'])
                        ->orWhereRaw('LOWER(name) LIKE ?', ['%pengumuman%']);
                });
            });
    }

    private function transformPost(Post $post, bool $includeContent = false): array
    {
        $content = trim((string) $post->content);
        $contentForView = $content !== '' ? $content : '';

        return [
            'title' => $post->title,
            'slug' => $post->slug,
            'category' => $post->category?->name ?? 'Pengumuman',
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
