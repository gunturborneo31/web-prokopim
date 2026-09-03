<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidItem extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'ppid_id',
        'name',
        'description',
        'tempat_pembuatan',
        'penanggung_jawab',
        'format_informasi',
        'tanggal_pembuatan',
        'jangka_waktu_penyimpanan',
        'file',
        'views',
        'downloads',
    ];

    public function ppid()
    {
        return $this->belongsTo(Ppid::class);
    }
}
