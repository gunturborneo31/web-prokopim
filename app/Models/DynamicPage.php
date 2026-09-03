<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DynamicPage extends Model
{
    protected $fillable = [
        'menu_id',
        'slug',
        'title',
        'template',
        'content',
        'hero_badge',
        'meta_title',
        'meta_desc',
        'published',
    ];

    protected $casts = [
        'content'   => 'array',
        'published' => 'boolean',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * All available templates with their labels and field definitions.
     */
    public static function templates(): array
    {
        return [
            'penjelasan_1'    => 'Penjelasan 1 (Judul & 1 Konten)',
            'penjelasan_2'    => 'Penjelasan 2 (Sub Judul & 2 Panel)',
            'aparatur'        => 'Daftar Aparatur',
            'profil_pimpinan' => 'Profil Pimpinan (Timeline)',
            'gambar_1'        => 'Halaman Gambar Tunggal',
            'galeri'          => 'Galeri Foto',
            'dokumen_grid'    => 'Dokumen Grid (Tabel)',
            'dokumen_list'    => 'Dokumen List (Kartu)',
            'tabel'           => 'Konten Tabel Custom',
            'blank_editor'    => 'Editor Bebas (Blank)',
            'berita'          => 'Daftar Berita',
        ];
    }

    /**
     * Badge color per template for Filament table.
     */
    public static function templateColor(string $template): string
    {
        return match($template) {
            'penjelasan_1'  => 'info',
            'penjelasan_2'  => 'info',
            'aparatur'      => 'success',
            'gambar_1'      => 'warning',
            'galeri'        => 'warning',
            'dokumen_grid'  => 'gray',
            'dokumen_list'  => 'gray',
            'tabel'         => 'danger',
            'blank_editor'  => 'primary',
            'berita'        => 'success',
            default         => 'gray',
        };
    }
}
