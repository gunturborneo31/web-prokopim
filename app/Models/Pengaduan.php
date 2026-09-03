<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'kode_laporan',
        'kategori',
        'nama_lengkap',
        'nik',
        'email',
        'telepon',
        'alamat',
        'pekerjaan',
        'unit_kerja',
        'file_identitas',
        'judul_laporan',
        'kronologis',
        'tanggal_kejadian',
        'bukti_pendukung',
        'status',
        'catatan_admin',
        'respon_publik',
        'handled_by',
        'handled_at',
        'is_anonymous',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'handled_at' => 'datetime',
        'is_anonymous' => 'boolean',
    ];

    public static function generateKodeLaporan(): string
    {
        do {
            $kode = strtoupper(Str::random(6));
        } while (self::where('kode_laporan', $kode)->exists());

        return $kode;
    }

    public function handler(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'baru'      => 'Laporan Baru',
            'diproses'  => 'Sedang Diproses',
            'selesai'   => 'Selesai',
            'ditolak'   => 'Ditolak',
            default     => 'Tidak Diketahui',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'baru'      => 'blue',
            'diproses'  => 'yellow',
            'selesai'   => 'green',
            'ditolak'   => 'red',
            default     => 'gray',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'baru'      => 'bg-blue-100 text-blue-700',
            'diproses'  => 'bg-yellow-100 text-yellow-700',
            'selesai'   => 'bg-green-100 text-green-700',
            'ditolak'   => 'bg-red-100 text-red-700',
            default     => 'bg-gray-100 text-gray-700',
        };
    }
}
