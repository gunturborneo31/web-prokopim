<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /** Tipe dokumen yang boleh diupload (lampiran & sisipan editor). */
    public const DOCUMENT_MIME_TYPES = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/zip',
        'application/x-zip-compressed',
        'text/csv',
        'text/plain',
    ];

    /** Tombol lampiran di editor konten: gambar + dokumen. */
    public const EDITOR_ATTACHMENT_MIME_TYPES = [
        'image/png', 'image/jpeg', 'image/gif', 'image/webp',
        ...self::DOCUMENT_MIME_TYPES,
    ];

    /** Ekstensi file yang di editor ditampilkan sebagai link unduh, bukan gambar. */
    private const DOCUMENT_EXTENSIONS = 'pdf|docx?|xlsx?|pptx?|zip|csv|txt';

    protected static function booted()
    {
        static::observe(\App\Observers\PostObserver::class);

        static::saving(function ($post) {
            if (! empty($post->content)) {
                $post->content = static::convertDocumentImagesToLinks($post->content);
            }
        });
    }

    /**
     * Editor Filament menyisipkan semua lampiran sebagai <img>. Untuk dokumen (PDF, Word, dll)
     * ubah menjadi link unduh agar bisa dibuka pengunjung.
     */
    public static function convertDocumentImagesToLinks(string $html): string
    {
        $ext = self::DOCUMENT_EXTENSIONS;

        return preg_replace_callback(
            '/<img\b[^>]*?\bsrc="([^"]+?\.(' . $ext . '))(?:\?[^"]*)?"[^>]*>/i',
            function (array $m) {
                $url = $m[1];
                $extension = strtoupper($m[2]);
                $alt = preg_match('/\balt="([^"]*)"/i', $m[0], $altMatch) ? trim(html_entity_decode($altMatch[1])) : '';
                $label = $alt !== '' ? $alt : rawurldecode(basename(parse_url($url, PHP_URL_PATH) ?: $url));

                return '<a href="' . e($url) . '" target="_blank" rel="noopener" class="post-document-link">'
                    . '📄 ' . e($label) . ' (' . $extension . ')'
                    . '</a>';
            },
            $html
        ) ?? $html;
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'file_id',
        'title',
        'slug',
        'content',
        'attachments',
        'attachment_names',
        'tags',
        'type',
        'status',
        'show_on_home',
        'read',
        'penulis',
        'published_at',
        'sort_order',
        'seo',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'seo' => 'array',
        'show_on_home' => 'boolean',
        'attachments' => 'array',
        'attachment_names' => 'array',
    ];

    /**
     * Lampiran siap tampil: [['url', 'name', 'type' => 'pdf'|'video'|'file', 'extension'], ...]
     */
    public function attachmentItems(): array
    {
        $names = is_array($this->attachment_names) ? $this->attachment_names : [];

        return collect(is_array($this->attachments) ? $this->attachments : [])
            ->filter(fn ($path) => is_string($path) && $path !== '')
            ->map(function (string $path) use ($names) {
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

                return [
                    'url' => \Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])
                        ? $path
                        : asset('storage/' . ltrim(str_replace('\\', '/', $path), '/')),
                    'name' => $names[$path] ?? basename($path),
                    'extension' => $extension,
                    'type' => match (true) {
                        $extension === 'pdf' => 'pdf',
                        in_array($extension, ['mp4', 'webm', 'ogg', 'ogv', 'mov', 'm4v'], true) => 'video',
                        default => 'file',
                    },
                ];
            })
            ->values()
            ->all();
    }

    public function scopeAnnouncement(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->whereHas('category', fn ($q) => $q->announcement());
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function file(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
