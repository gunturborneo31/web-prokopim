<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidAboutFile extends Model
{
    protected $fillable = [
        'name',
        'file',
        'ppid_id',
    ];

    public function ppid()
    {
        return $this->belongsTo(Ppid::class, 'ppid_id');
    }
}
