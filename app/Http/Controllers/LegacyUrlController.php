<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Menangani link dari website lama (WordPress) yang formatnya "/{slug}"
 * atau "/2024/05/12/{slug}", lalu mengalihkan (301) ke "/berita/{slug}".
 * Dipasang sebagai Route::fallback, jadi hanya jalan untuk URL yang tidak dikenal.
 */
class LegacyUrlController extends Controller
{
    public function __invoke(Request $request)
    {
        $path = trim(rawurldecode($request->path()), '/');

        // Abaikan file statis (gambar, css, js, dll) dan path kosong
        if ($path === '' || preg_match('/\.[a-z0-9]{2,5}$/i', $path)) {
            abort(404);
        }

        $post = $this->findPost($path);

        abort_if(! $post, 404);

        $route = $post->category?->slug === 'pengumuman' ? 'pengumuman.show' : 'berita.show';

        return redirect()->route($route, $post->slug, 301);
    }

    private function findPost(string $path): ?Post
    {
        $segments = array_values(array_filter(explode('/', $path), fn ($s) => $s !== ''));
        $last = end($segments);

        if (! $last) {
            return null;
        }

        // Cocokkan dengan cara yang sama seperti saat impor berita WordPress
        $candidates = collect([
            $last,
            Str::slug($last),
            Str::limit(Str::slug($last), 180, ''),
        ])->filter()->unique()->values();

        return Post::query()
            ->with('category')
            ->where('status', 1)
            ->whereIn('slug', $candidates)
            ->first();
    }
}
