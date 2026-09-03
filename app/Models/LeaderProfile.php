<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderProfile extends Model
{
    protected $fillable = [
        'label',
        'name',
        'position',
        'nip',
        'pangkat',
        'golongan',
        'pendidikan',
        'photo',
        'quote',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function histories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LeaderProfileHistory::class)->orderByDesc('is_current')->orderByDesc('year_start');
    }
}
