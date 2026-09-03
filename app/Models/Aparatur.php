<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aparatur extends Model
{
    protected $fillable = [
        'name',
        'position',
        'rank',
        'grade',
        'photo',
        'order',
        'status',
    ];
}
