<?php

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $user = User::factory()->create(['username' => 'penulis']);
    $berita = PostCategory::firstOrCreate(['slug' => 'berita'], ['name' => 'Berita', 'active' => true]);
    $pengumuman = PostCategory::firstOrCreate(['slug' => 'pengumuman'], ['name' => 'Pengumuman', 'active' => true]);

    $base = ['user_id' => $user->id, 'content' => '<p>Isi</p>', 'type' => 'post', 'status' => 1, 'published_at' => now()];

    Post::create($base + ['category_id' => $berita->id, 'title' => 'Bupati Resmikan Jembatan', 'slug' => 'bupati-resmikan-jembatan']);
    Post::create($base + ['category_id' => $pengumuman->id, 'title' => 'Pengumuman Seleksi', 'slug' => 'pengumuman-seleksi-2026']);
    Post::create(['status' => 0] + $base + ['category_id' => $berita->id, 'title' => 'Konsep', 'slug' => 'berita-konsep']);
});

it('link lama /{slug} dialihkan permanen ke /berita/{slug}', function () {
    $this->get('/bupati-resmikan-jembatan')->assertStatus(301)->assertRedirect('/berita/bupati-resmikan-jembatan');
});

it('link lama dengan format tanggal WordPress tetap dialihkan', function () {
    $this->get('/2026/05/12/bupati-resmikan-jembatan')->assertStatus(301)->assertRedirect('/berita/bupati-resmikan-jembatan');
});

it('slug dengan huruf besar / karakter ter-encode tetap cocok', function () {
    $this->get('/Bupati-Resmikan-Jembatan')->assertStatus(301)->assertRedirect('/berita/bupati-resmikan-jembatan');
});

it('link lama pengumuman dialihkan ke halaman pengumuman', function () {
    $this->get('/pengumuman-seleksi-2026')->assertStatus(301)->assertRedirect('/halaman/pengumuman/pengumuman-seleksi-2026');
});

it('halaman tujuan berita bisa dibuka', function () {
    $this->get('/berita/bupati-resmikan-jembatan')->assertOk()->assertSee('Bupati Resmikan Jembatan');
});

it('slug tidak dikenal, berita konsep, dan file statis tetap 404', function () {
    $this->get('/tidak-ada-berita-ini')->assertNotFound();
    $this->get('/berita-konsep')->assertNotFound();
    $this->get('/bupati-resmikan-jembatan.jpg')->assertNotFound();
});

it('route yang sudah ada tidak terganggu', function () {
    $this->get('/berita')->assertOk();
    $this->get('/pengumuman')->assertRedirect('/halaman/pengumuman');
});
