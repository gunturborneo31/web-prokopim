<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Kategori Post disederhanakan menjadi 3 kategori baku: Berita, Pengumuman, Uncategorized.
     * Kolom "tags" diperlebar dari varchar(255) menjadi TEXT agar tidak terpotong ketika
     * menyimpan banyak hashtag, dan data tags lama (format campuran JSON/CSV) dirapikan
     * menjadi format JSON array yang konsisten agar filter hashtag berjalan akurat.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE posts MODIFY tags TEXT NULL');

        $now = now();

        $beritaId = $this->findOrCreateCategory('Berita', 'berita', $now);
        $pengumumanId = $this->findOrCreateCategory('Pengumuman', 'pengumuman', $now);
        $uncategorizedId = $this->findOrCreateCategory('Uncategorized', 'uncategorized', $now);

        // Semua tulisan yang bukan Pengumuman/Uncategorized (termasuk yang belum
        // memiliki kategori jelas) dipindahkan ke kategori "Berita".
        DB::table('posts')
            ->where(function ($query) use ($pengumumanId, $uncategorizedId) {
                $query->whereNull('category_id')
                    ->orWhereNotIn('category_id', [$pengumumanId, $uncategorizedId]);
            })
            ->update(['category_id' => $beritaId]);

        // Hapus semua kategori lama selain 3 kategori baku di atas.
        DB::table('post_categories')
            ->whereNotIn('id', [$beritaId, $pengumumanId, $uncategorizedId])
            ->delete();

        $this->normalizeTags();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Konsolidasi kategori & normalisasi tags tidak dapat dibatalkan (data lama sudah hilang).
        DB::statement('ALTER TABLE posts MODIFY tags VARCHAR(255) NULL');
    }

    private function findOrCreateCategory(string $name, string $slug, $now): int
    {
        $existing = DB::table('post_categories')->where('slug', $slug)->first();

        if ($existing) {
            DB::table('post_categories')->where('id', $existing->id)->update([
                'name' => $name,
                'active' => 1,
                'updated_at' => $now,
            ]);

            return $existing->id;
        }

        return DB::table('post_categories')->insertGetId([
            'name' => $name,
            'slug' => $slug,
            'active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function normalizeTags(): void
    {
        DB::table('posts')
            ->whereNotNull('tags')
            ->where('tags', '!=', '')
            ->orderBy('id')
            ->chunkById(200, function ($posts) {
                foreach ($posts as $post) {
                    DB::table('posts')->where('id', $post->id)->update([
                        'tags' => json_encode($this->parseTagList((string) $post->tags)),
                    ]);
                }
            });
    }

    private function parseTagList(string $raw): array
    {
        $decoded = json_decode($raw, true);

        if (is_array($decoded)) {
            $list = $decoded;
        } elseif (is_string($decoded)) {
            // Tersimpan sebagai satu JSON string berisi teks dipisah koma (format lama).
            $list = explode(',', $decoded);
        } else {
            // Bukan JSON valid sama sekali, anggap sebagai teks dipisah koma mentah.
            $list = explode(',', $raw);
        }

        return collect($list)
            ->map(fn ($tag) => trim(trim((string) $tag), "\"' "))
            ->filter(fn ($tag) => $tag !== '')
            ->unique()
            ->values()
            ->all();
    }
};
