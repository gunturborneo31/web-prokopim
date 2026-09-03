<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = [
        'status',
        'rss_url',
        'position',
        'width',
    ];

    protected $casts = [
        'status' => 'boolean',
        'width' => 'integer',
    ];
}
