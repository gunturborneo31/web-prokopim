<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda'; // Standard pluralization might fail here if not configured, better explicit.

    protected $fillable = [
        'schedule',
        'caption',
        'description',
        'location',
    ];

    protected $casts = [
        'schedule' => 'datetime',
    ];
}
