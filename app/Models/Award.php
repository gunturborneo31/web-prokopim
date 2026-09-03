<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'title',
        'year',
        'institution',
        'file',
        'views',
        'status',
        'order',
    ];
}
