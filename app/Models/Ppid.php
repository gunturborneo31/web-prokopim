<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppid extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name',
        'description',
        'file',
        'parent_id',
        'tempat_pembuatan',
        'penanggung_jawab',
        'format_informasi',
        'tanggal_pembuatan',
        'jangka_waktu_penyimpanan',
    ];

    public function parent()
    {
        return $this->belongsTo(Ppid::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Ppid::class, 'parent_id');
    }

    public function items()
    {
        return $this->hasMany(PpidItem::class);
    }
}
