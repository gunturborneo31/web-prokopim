<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSharing extends Model
{
    use HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'title',
        'is_folder',
        'parent_id',
        'file_path',
        'description',
        'type',
        'size',
        'download_count',
        'user_id',
        'is_public',
        'is_favorite',
        'status',
        'share_code',
    ];

    protected $casts = [
        'is_folder' => 'boolean',
        'status' => 'integer',
        'download_count' => 'integer',
        'parent_id' => 'integer',
        'user_id' => 'integer',
        'is_public' => 'boolean',
        'is_favorite' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->share_code = \Illuminate\Support\Str::random(10);
            while (static::where('share_code', $model->share_code)->exists()) {
                $model->share_code = \Illuminate\Support\Str::random(10);
            }
        });
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FileSharing::class, 'parent_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FileSharing::class, 'parent_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision).' '.$units[$pow];
    }
    public function getFileSizeFormattedAttribute(): string
    {
        // If size is numeric, format it. If already string (legacy), return as is.
        return is_numeric($this->size) ? self::formatBytes($this->size) : ($this->size ?? '0 B');
    }
}
