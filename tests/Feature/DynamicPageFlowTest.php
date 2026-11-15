<?php

use App\Filament\Resources\DynamicPages\Pages\CreateDynamicPage;
use App\Filament\Resources\DynamicPages\Pages\EditDynamicPage;
use App\Models\DynamicPage;
use App\Models\Menu;
use App\Models\Ppid;
use App\Models\PpidItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

/**
 * Alur lengkap: admin membuat menu -> memilih template -> mengisi konten -> simpan
 * -> halaman tampil di frontend & link menu ter-update.
 */
function adminUser(): User
{
    return User::factory()->create(['username' => 'admin_test', 'role' => 'super_admin']);
}

function websiteMenu(string $name): Menu
{
    return Menu::create([
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name),
        'link' => '#',
        'position' => 'website',
        'order' => 1,
        'status' => 1,
    ]);
}

function createPageViaAdmin(Menu $menu, string $template, array $content, array $extra = []): DynamicPage
{
    $slug = $menu->slug;

    Livewire::withQueryParams([
        'menu_id' => $menu->id,
        'template' => $template,
        'title' => $menu->name,
        'slug' => $slug,
    ])
        ->test(CreateDynamicPage::class)
        ->fillForm(array_merge([
            'public_url' => '/halaman/' . $slug,
            'published' => true,
            'hero_badge' => 'Badge Tes',
        ], ['content' => $content], $extra))
        ->call('create')
        ->assertHasNoFormErrors();

    return DynamicPage::where('menu_id', $menu->id)->firstOrFail();
}

beforeEach(function () {
    $this->actingAs(adminUser());
});

it('membuka halaman admin: pilih menu, pilih template, form create', function () {
    $menu = websiteMenu('Halaman Uji');

    $this->get('/site-admin/dynamic-pages')->assertOk()->assertSee('Halaman Uji');
    $this->get('/site-admin/dynamic-pages/select-template?menu_id=' . $menu->id)->assertOk();
    $this->get('/site-admin/dynamic-pages/create?menu_id=' . $menu->id . '&template=penjelasan_1&title=Halaman+Uji&slug=halaman-uji')->assertOk();
});

it('template penjelasan_1 tersimpan, link menu diperbarui, dan tampil di frontend', function () {
    $menu = websiteMenu('Sejarah Singkat');
    $page = createPageViaAdmin($menu, 'penjelasan_1', [
        'judul' => 'Judul Sejarah',
        'isi_konten' => '<p>Isi sejarah PROKOPIM uji.</p>',
    ]);

    expect($page->template)->toBe('penjelasan_1')
        ->and($page->slug)->toBe('sejarah-singkat')
        ->and($menu->fresh()->link)->toBe('/halaman/sejarah-singkat');

    $this->get('/halaman/sejarah-singkat')->assertOk()
        ->assertSee('Sejarah Singkat')
        ->assertSee('Isi sejarah PROKOPIM uji.', false);
});

it('template penjelasan_2 tampil dua panel', function () {
    $menu = websiteMenu('Visi Misi Uji');
    createPageViaAdmin($menu, 'penjelasan_2', [
        'subtitle' => 'Sub uji',
        'box_1_title' => 'Visi Uji',
        'box_1_content' => '<p>Isi visi uji</p>',
        'box_2_title' => 'Misi Uji',
        'box_2_content' => '<p>Isi misi uji</p>',
    ]);

    $this->get('/halaman/visi-misi-uji')->assertOk()
        ->assertSee('Visi Uji')->assertSee('Isi visi uji', false)
        ->assertSee('Misi Uji')->assertSee('Isi misi uji', false);
});

it('template blank_editor tampil isi editor', function () {
    $menu = websiteMenu('Halaman Bebas');
    createPageViaAdmin($menu, 'blank_editor', [
        'isi_konten' => '<p>Konten bebas uji</p>',
        'media_items' => [],
    ]);

    $this->get('/halaman/halaman-bebas')->assertOk()->assertSee('Konten bebas uji', false);
});

it('template gambar_1 tampil subjudul & caption', function () {
    $menu = websiteMenu('Bagan Uji');
    createPageViaAdmin($menu, 'gambar_1', [
        'subtitle' => 'Subjudul gambar uji',
        'caption' => 'Caption gambar uji',
    ]);

    $this->get('/halaman/bagan-uji')->assertOk()->assertSee('Subjudul gambar uji');
});

it('template galeri bisa dibuka', function () {
    $menu = websiteMenu('Galeri Uji');
    createPageViaAdmin($menu, 'galeri', ['subtitle' => 'Subjudul galeri uji', 'images' => []]);

    $this->get('/halaman/galeri-uji')->assertOk()->assertSee('Galeri Uji');
});

it('template aparatur bisa dibuka', function () {
    $menu = websiteMenu('Aparatur Uji');
    createPageViaAdmin($menu, 'aparatur', ['subtitle' => 'Subjudul aparatur uji', 'aparaturs' => []]);

    $this->get('/halaman/aparatur-uji')->assertOk();
});

it('template profil_pimpinan bisa dibuka', function () {
    $menu = websiteMenu('Pimpinan Uji');
    createPageViaAdmin($menu, 'profil_pimpinan', ['subtitle' => 'Subjudul pimpinan uji', 'leaders' => []]);

    $this->get('/halaman/pimpinan-uji')->assertOk();
});

it('template dokumen mode otomatis (PPID) tampil daftar dokumen', function () {
    $ppid = Ppid::create(['name' => 'Kategori Dokumen Uji']);
    PpidItem::create(['ppid_id' => $ppid->id, 'name' => 'Dokumen PPID Uji', 'file' => 'ppid-files/uji.pdf']);

    $menu = websiteMenu('Dokumen Otomatis');
    createPageViaAdmin($menu, 'dokumen_list', ['mode' => 'automatic', 'ppid_id' => $ppid->id]);

    $this->get('/halaman/dokumen-otomatis')->assertOk()->assertSee('Dokumen PPID Uji');
});

it('template dokumen mode manual tampil daftar dokumen', function (string $template) {
    $menu = websiteMenu('Dokumen Manual ' . $template);
    $page = createPageViaAdmin($menu, $template, [
        'mode' => 'manual',
        'documents' => [
            ['name' => 'Dokumen Manual Uji', 'date' => '2026', 'description' => 'Deskripsi manual uji'],
        ],
    ]);

    $this->get('/halaman/' . $page->slug)->assertOk()->assertSee('Dokumen Manual Uji');
})->with(['dokumen_grid', 'dokumen_list', 'tabel']);

it('halaman yang tidak dipublikasikan tidak bisa diakses publik', function () {
    $menu = websiteMenu('Halaman Draft');
    createPageViaAdmin($menu, 'penjelasan_1', ['judul' => 'Draft', 'isi_konten' => '<p>x</p>'], ['published' => false]);

    $this->get('/halaman/halaman-draft')->assertNotFound();
});

it('edit halaman: perubahan konten tampil di frontend', function () {
    $menu = websiteMenu('Halaman Edit');
    $page = createPageViaAdmin($menu, 'penjelasan_1', ['judul' => 'Awal', 'isi_konten' => '<p>Konten awal</p>']);

    $this->get('/site-admin/dynamic-pages/' . $page->id . '/edit')->assertOk();

    Livewire::test(EditDynamicPage::class, ['record' => $page->getRouteKey()])
        ->fillForm(['content' => ['judul' => 'Baru', 'isi_konten' => '<p>Konten sudah diubah</p>']])
        ->call('save')
        ->assertHasNoFormErrors();

    $this->get('/halaman/halaman-edit')->assertOk()->assertSee('Konten sudah diubah', false);
});

it('menu dengan halaman dinamis muncul di navbar frontend', function () {
    $menu = websiteMenu('Menu Navbar Uji');
    createPageViaAdmin($menu, 'penjelasan_1', ['judul' => 'x', 'isi_konten' => '<p>x</p>']);

    $this->get('/halaman/menu-navbar-uji')->assertOk()
        ->assertSee('Menu Navbar Uji')
        ->assertSee('/halaman/menu-navbar-uji', false);
});

it('menu Berita & Pengumuman diarahkan ke daftar Post kategorinya, bukan dibuatkan halaman dinamis', function () {
    $berita = \App\Models\PostCategory::firstOrCreate(['slug' => 'berita'], ['name' => 'Berita', 'active' => true]);
    $pengumuman = \App\Models\PostCategory::firstOrCreate(['slug' => 'pengumuman'], ['name' => 'Pengumuman', 'active' => true]);

    $menuBerita = Menu::create(['name' => 'Berita', 'slug' => 'berita', 'link' => '/berita', 'position' => 'website', 'order' => 1, 'status' => 1]);
    $menuPengumuman = Menu::create(['name' => 'Pengumuman', 'slug' => 'pengumuman', 'link' => '/halaman/pengumuman', 'position' => 'website', 'order' => 2, 'status' => 1]);

    // Halaman "Pilih Menu Website" menandai menu sebagai otomatis dari Post
    $this->get('/site-admin/dynamic-pages')->assertOk()
        ->assertSee('filters%5Bcategory%5D%5Bvalue%5D=' . $berita->id, false)
        ->assertSee('Otomatis dari Post kategori');

    // Membuka pilih template / form create untuk menu ini dialihkan ke daftar Post terfilter
    $this->get('/site-admin/dynamic-pages/select-template?menu_id=' . $menuBerita->id)
        ->assertRedirectContains('/site-admin/posts')
        ->assertRedirectContains('filters%5Bcategory%5D%5Bvalue%5D=' . $berita->id);
    $this->get('/site-admin/dynamic-pages/create?menu_id=' . $menuPengumuman->id . '&template=penjelasan_1&title=Pengumuman&slug=pengumuman')
        ->assertRedirectContains('filters%5Bcategory%5D%5Bvalue%5D=' . $pengumuman->id);

    // Link menu tidak berubah dan tidak ada halaman dinamis dibuat
    expect($menuBerita->fresh()->link)->toBe('/berita')
        ->and($menuPengumuman->fresh()->link)->toBe('/halaman/pengumuman')
        ->and(DynamicPage::count())->toBe(0);

    // Daftar Post di admin bisa dibuka dengan filter kategori
    $this->get('/site-admin/posts?filters[category][value]=' . $pengumuman->id)->assertOk();
});
