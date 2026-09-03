<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::observe(\App\Observers\PostObserver::class);

        static::saving(function ($post) {
            // Otomatis ubah tag <img> yang mengarah ke PDF menjadi link <a> agar bisa dibuka
            if (!empty($post->content)) {
                $post->content = preg_replace_callback(
                    '/<img src="([^"]+\.pdf)"[^>]*>/i',
                    function ($matches) {
                        return '<a href="' . $matches[1] . '" target="_blank" class="text-blue-600 hover:text-blue-800 font-bold underline flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Buka PDF
                        </a>';
                    },
                    $post->content
                );
            }
        });
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'file_id',
        'title',
        'slug',
        'content',
        'tags',
        'type',
        'status',
        'read',
        'penulis',
        'published_at',
        'sort_order',
        'seo',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'seo' => 'array',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
