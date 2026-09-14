<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAnnouncement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'link',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('order', 'asc')->orderByDesc('updated_at');
        });
    }
}
