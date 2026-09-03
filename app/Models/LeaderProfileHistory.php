<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderProfileHistory extends Model
{
    protected $fillable = [
        'leader_profile_id',
        'year_start',
        'year_end',
        'position',
        'institution',
        'description',
        'is_current',
        'order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
    ];

    public function leaderProfile(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LeaderProfile::class);
    }
}
