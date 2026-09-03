<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidRequest extends Model
{
    protected $fillable = [
        'kode_permohonan',
        'nama_lengkap',
        'nik',
        'alamat',
        'pekerjaan',
        'email',
        'no_telepon',
        'rincian_informasi',
        'tujuan_penggunaan',
        'cara_mendapatkan',
        'cara_memperoleh',
        'status',
        'respon_admin',
        'catatan_admin',
        'handled_by',
        'handled_at',
    ];

    protected $casts = [
        'handled_at' => 'datetime',
    ];

    public function handler()
    {
        return $this->belongsTo(\App\Models\User::class, 'handled_by');
    }
}
