<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\V1\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'file'])
            ->where('status', 1); // Assuming 1 is published

        // Filter by title (nama)
        if ($request->filled('nama')) {
            $query->where('title', 'like', '%' . $request->nama . '%');
        }

        // Filter by date (tanggal)
        if ($request->filled('tanggal')) {
            // Assuming format YYYY-MM-DD
            $query->whereDate('published_at', $request->tanggal);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->orderBy('published_at', 'desc')->paginate($request->get('per_page', 10));

        return PostResource::collection($posts);
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'file'])
            ->where('slug', $slug)
            ->firstOrFail();

        return new PostResource($post);
    }
}
