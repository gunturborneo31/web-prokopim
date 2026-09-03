<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WbsAbout extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'is_active',
    ];
}
