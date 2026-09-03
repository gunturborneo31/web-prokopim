<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentStat extends Model
{
    protected $fillable = [
        'doc_key',
        'type',
        'category',
        'views',
        'downloads',
        'last_viewed_at',
        'last_downloaded_at',
    ];

    protected $casts = [
        'views' => 'integer',
        'downloads' => 'integer',
        'last_viewed_at' => 'datetime',
        'last_downloaded_at' => 'datetime',
    ];
}