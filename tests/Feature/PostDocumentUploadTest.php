<?php

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create(['username' => 'admin_post', 'role' => 'super_admin']));
    $this->category = PostCategory::firstOrCreate(['slug' => 'berita'], ['name' => 'Berita', 'active' => true]);
});

it('halaman buat post di admin bisa dibuka', function () {
    $this->get('/site-admin/posts/create')->assertOk()->assertSee('Lampiran');
});

it('upload dokumen Word, Excel dan PDF di tab Lampiran lalu tampil di halaman berita', function () {
    Livewire::test(CreatePost::class)
        ->fillForm([
            'title' => 'Berita Dengan Dokumen',
            'slug' => 'berita-dengan-dokumen',
            'category_id' => $this->category->id,
            'content' => '<p>Isi berita</p>',
            'status' => 1,
            'published_at' => now()->subMinute(),
            'attachments' => [
                UploadedFile::fake()->create('Laporan Kegiatan.docx', 120, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
                UploadedFile::fake()->create('Rekap Anggaran.xlsx', 80, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
                UploadedFile::fake()->create('Surat Edaran.pdf', 200, 'application/pdf'),
            ],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $post = Post::where('slug', 'berita-dengan-dokumen')->firstOrFail();

    expect($post->attachments)->toHaveCount(3)
        ->and(array_values($post->attachment_names))->toContain('Laporan Kegiatan.docx', 'Rekap Anggaran.xlsx', 'Surat Edaran.pdf');

    foreach ($post->attachments as $path) {
        Storage::disk('public')->assertExists($path);
    }

    $this->get('/berita/berita-dengan-dokumen')->assertOk()
        ->assertSee('Lampiran')
        ->assertSee('Laporan Kegiatan.docx')
        ->assertSee('Rekap Anggaran.xlsx')
        ->assertSee('Surat Edaran.pdf');
});

it('menolak file berbahaya seperti .exe di tab Lampiran', function () {
    Livewire::test(CreatePost::class)
        ->fillForm([
            'title' => 'Berita Exe',
            'slug' => 'berita-exe',
            'category_id' => $this->category->id,
            'status' => 1,
            'attachments' => [UploadedFile::fake()->create('virus.exe', 10, 'application/x-msdownload')],
        ])
        ->call('create')
        ->assertHasFormErrors(['attachments']);
});

it('dokumen yang disisipkan lewat editor berubah menjadi link unduh', function () {
    $html = '<p>Silakan unduh:</p><img alt="Surat Undangan" data-id="posts/content/a.pdf" src="http://localhost/storage/posts/content/a.pdf">'
        . '<img src="http://localhost/storage/posts/content/b.docx">'
        . '<img src="http://localhost/storage/posts/content/foto.jpg" alt="Foto">';

    $result = Post::convertDocumentImagesToLinks($html);

    expect($result)
        ->toContain('<a href="http://localhost/storage/posts/content/a.pdf"')
        ->toContain('Surat Undangan (PDF)')
        ->toContain('<a href="http://localhost/storage/posts/content/b.docx"')
        ->toContain('b.docx (DOCX)')
        ->toContain('<img src="http://localhost/storage/posts/content/foto.jpg" alt="Foto">');
});

it('editor konten menerima dokumen sebagai lampiran', function () {
    $editor = collect(\App\Filament\Resources\Posts\Schemas\PostForm::configure(
        \Filament\Schemas\Schema::make(Livewire::test(CreatePost::class)->instance())
    )->getFlatComponents())->first(fn ($c) => $c instanceof \Filament\Forms\Components\RichEditor);

    expect($editor->getFileAttachmentsAcceptedFileTypes())
        ->toContain('application/pdf')
        ->toContain('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
        ->toContain('image/jpeg');
});
