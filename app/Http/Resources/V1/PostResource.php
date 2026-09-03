<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'image_url' => $this->file ? asset('storage/' . ($this->file->storage_path ?? $this->file->path)) : null,
            'content' => $this->content,
            'penulis' => $this->penulis,
            'published_at' => $this->published_at,
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ] : null,
            'seo' => $this->seo,
        ];
    }
}
