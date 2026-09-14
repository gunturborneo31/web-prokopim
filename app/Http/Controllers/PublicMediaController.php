<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicMediaController extends Controller
{
    public function show(string $path)
    {
        $normalizedPath = str_replace('\\', '/', trim($path));
        $normalizedPath = ltrim($normalizedPath, '/');

        abort_if(
            blank($normalizedPath) || Str::contains($normalizedPath, ['../', '..\\']),
            404
        );

        if (Storage::disk('public')->exists($normalizedPath)) {
            return Storage::disk('public')->response($normalizedPath);
        }

        if (Storage::disk('local')->exists($normalizedPath)) {
            return Storage::disk('local')->response($normalizedPath);
        }

        abort(404);
    }
}
