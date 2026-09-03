<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisqusSetting extends Model
{
    protected $fillable = [
        'shortname',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
