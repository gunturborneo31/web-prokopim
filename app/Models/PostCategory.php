<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'active'];

    /**
     * Kategori yang dianggap "Pengumuman" (slug pengumuman atau nama mengandung "pengumuman").
     */
    public function scopeAnnouncement(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where(function (\Illuminate\Database\Eloquent\Builder $q) {
            $q->where('slug', 'pengumuman')
                ->orWhereRaw('LOWER(name) LIKE ?', ['%pengumuman%']);
        });
    }

    public function isAnnouncement(): bool
    {
        return $this->slug === 'pengumuman'
            || str_contains(strtolower((string) $this->name), 'pengumuman');
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
