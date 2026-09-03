<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidAbout extends Model
{
    protected $fillable = [
        'profil',
        'visi',
        'misi',
        'maklumat',
    ];

    public function files()
    {
        return $this->hasMany(PpidAboutFile::class);
    }
}
