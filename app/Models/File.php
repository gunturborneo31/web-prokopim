<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type', // Kept for legacy compatibility if needed
        'path', // Kept for legacy compatibility
        'storage_path', // New field
        'user_id',
        'folder_id',
        'original_name',
        'extension',
        'size',
        'mime_type',
        'disk',
        'fileable_type',
        'fileable_id',
        'field', // Legacy
        'meta', // Legacy
    ];

    public function folder(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fileable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
