# tasks/lessons.md — Database Pelajaran dari Error

> File ini dikelola otomatis oleh Claude setiap kali `/debug` berhasil memecahkan masalah.
> **Jangan hapus entri lama** — ini adalah memori kolektif proyek kita.
> Claude wajib membaca file ini sebelum mengerjakan `/debug`.

---

## Cara Membaca File Ini
- Gunakan **Tag** untuk cari cepat: `#livewire` `#blade` `#alpine` `#query` `#validasi` `#vite` `#auth` `#upload`
- Entri terbaru ada di **paling atas**
- Setiap entri punya status: ✅ Selesai | ⚠️ Perlu Monitor

---

## Entri Pelajaran

---
## 2026-04-28 — Class "Filament\Forms\Components\Tabs" not found
**Status**: ✅ Selesai
**Tag**: #filament #schema #namespace #v4

- **Konteks**: Modifikasi struktur form (`PostForm.php`) dari layout vertikal biasa menjadi menggunakan komponen *Tabs* di Filament v4.
- **Gejala**: Internal Server Error 500 dengan pesan `Class "Filament\Forms\Components\Tabs" not found`.
- **Penyebab**: Dalam Filament v4, komponen yang bersifat tata letak struktural (*Structural Layouts*) seperti `Tabs`, `Grid`, dan `Section` tidak lagi berada di namespace `Forms`. Mereka telah dipindahkan secara permanen ke namespace `Schemas`.
- **Solusi**:
  ```php
  // ❌ SALAH (Filament v3)
  use Filament\Forms\Components\Tabs;
  
  // ✅ BENAR (Filament v4)
  use Filament\Schemas\Components\Tabs;
  ```
- **Pencegahan**: Selalu ingat pemisahan tanggung jawab komponen di v4: **Input = Forms** (`TextInput`, `Select`), **Layout = Schemas** (`Tabs`, `Section`, `Group`). Pastikan *auto-import* IDE menunjuk ke `Schemas\Components` untuk elemen kerangka UI.

---
## 2026-04-09 — Class "Filament\Forms\Components\Section" not found
**Status**: ✅ Selesai
**Tag**: #filament #schema #namespace

- **Konteks**: Pembuatan desain struktur form Halaman Dinamis (`Aparatur.php` dsb) di dalam panel admin Filament v4.
- **Gejala**: Menabrak error 500 secara internal: `Class "Filament\Forms\Components\Section" not found`.
- **Penyebab**: Mulai dari pembaharuan Filament v4 (menemani rilisnya Laravel 12), terdapat standardisasi *Structural Separation* pada komponen mereka. Komponen yang bertugas sebagai **Penata Letak/Layout** (`Section`, `Tabs`, `Grid`, `Group`) didepak menjadi milik namespace `Filament\Schemas`. Namun, komponen interaktif yang bertugas menampung isian data / **Input** (`TextInput`, `Repeater`, `FileUpload`) menetap di `Filament\Forms`.
- **Solusi**:
  ```php
  // ❌ SALAH (Dahulu berlaku di Filament v3 ke bawah)
  use Filament\Forms\Components\Section;
  use Filament\Forms\Components\Grid;

  // ✅ BENAR (Aturan baku untuk proyek ini / Filament v4)
  use Filament\Schemas\Components\Section;
  use Filament\Schemas\Components\Grid;
  use Filament\Forms\Components\TextInput; // Input form tulen tetap natural
  ```
- **Pencegahan**: Pakem yang harus diingat: **"Layout = Schema, Input = Form"**. Saat mengonfirmasi menu IDE _auto-import_, pastikan matanya tak terkecoh memilih namespace `Forms` saat berniat memasukkan alat penata batas kerangka (seperti `Section` atau `Group`).

---
## 2026-04-09 — Template Dinamis Baru Tidak Muncul di Galeri Visual
**Status**: ✅ Selesai
**Tag**: #filament #ui #schema

- **Konteks**: `SelectTemplatePage.php` — Penambahan opsi template `ProfilPimpinan` pada CMS.
- **Gejala**: Template sudah didaftarkan pada model database (`DynamicPage::templates()`) dan skemanya sudah dibuat di `DynamicPageForm.php`, tetapi saat admin mencoba memilihnya di Galeri Halaman Pertama (grid menu template UI), pilihan tersebut tidak muncul.
- **Penyebab**: Karena modul *Dynamic Pages* proyek ini dikonfigurasi untuk menggunakan halaman Galeri Visual Card *custom* `SelectTemplatePage.php` ketimbang menggunakan opsi Select *dropdown* bawaan, halaman tersebut membidani *hardcoded array* dari metode `getTemplateData()` miliknya sendiri (demi kebutuhan *styling*).
- **Solusi**: Daftarkan kunci parameter baru ke dalam `getTemplateData()` di dalam kelas `SelectTemplatePage`.
- **Pencegahan**: Jangan pernah lupa **aturan ganda** pendaftaran Template: Setiap kali sebuah *Dynamic Template* baru digarap, jangan cuma didaftarkan pada Model Backend `DynamicPage.php`, tapi WAJIB daftarkan juga tampilannya di properti UI presentasi `SelectTemplatePage::getTemplateData()`.

---
## 2026-04-09 — Blank Sidebar di CMS (Hierarchical Navigation)
**Status**: ✅ Selesai
**Tag**: #filament #ux #routing

- **Konteks**: `EditDynamicPage.php` & `CreateDynamicPage.php` — URL Query merujuk ke leaf/child mode
- **Gejala**: Ketika kembali (navigasi "Back") ke halaman Panel Admin Hierarkis dari sebuah *child-node* (seperti profil "Visi Misi"), *sidebar* menu utama di sebelah kiri tidak menyorot elemen apapun dan terlihat *nge-bug*.
- **Penyebab**: Kode melempar nilai query parameter `active_id = {id_child}`. Padahal *view* Filament untuk *sidebar* kiri hanya memuat dan meloop data kategori utama (*Top Level / Root*).
- **Solusi**:
  ```php
  // Gunakan loop untuk me-resolve ID Root sebelum mereturn URL Back
  $root = $menu;
  while ($root->parent_id) {
      $parent = \App\Models\Menu::find($root->parent_id);
      if (!$parent) break;
      $root = $parent;
  }
  return DynamicPageResource::getUrl('index', ['active_id' => $root->id]);
  ```
- **Pencegahan**: Pada arsitektur UX *Split-Panel* di mana navigasi dirender secara Parent > Children, tombol arah "kembali" atau parameter statis (seperti `active_id`) harus selalu diarahkan persis ke ID Root Level, bukan ID turunannya.

---
## 2026-03-13 — Livewire Property dipakai tanpa deklarasi
**Status**: ✅ Selesai
**Tag**: #livewire #filament

- **Konteks**: `ListPpids.php` — property `$editingPpidId` dan `$ppidData` dipakai di method tapi tidak dideklarasikan di class
- **Gejala**: Livewire tidak bisa reaktif — perubahan tidak terpantau, state hilang antar request
- **Penyebab**: Di Livewire, property **wajib dideklarasikan** secara eksplisit di class agar bisa di-track
- **Solusi**: `public ?int $editingPpidId = null;` dan `public array $ppidData = [];`
- **Pencegahan**: Setiap `$this->prop` di Livewire harus dideklarasikan di class dengan tipe & nilai default

---
## 2026-03-13 — N+1 Query dalam closure kolom tabel Filament
**Status**: ✅ Selesai
**Tag**: #query #filament #performa

- **Konteks**: `PpidsTable.php` — `visible()` dan `label()` memanggil `Ppid::find($livewire->parent_id)` untuk setiap kolom di setiap baris
- **Gejala**: Query `SELECT * FROM ppids WHERE id = ?` terpanggil N×baris kali — makin banyak kolom makin lambat
- **Penyebab**: Eloquent query di dalam closure kolom tabel dieksekusi per baris render, bukan sekali
- **Solusi**: Cache di property Livewire saat `mount()`, akses via `$livewire->parentPpid` di closure
- **Pencegahan**: Jangan panggil `Model::find()` di dalam closure `visible()` / `label()` kolom tabel — selalu cache di `mount()`

---
## 2026-03-13 — dispatch() Livewire: Unknown named parameter $id
**Status**: ✅ Selesai
**Tag**: #livewire #filament #modal

- **Konteks**: `ListPpids.php` — halaman list PPID yang menggunakan modal form custom di Filament
- **Gejala**: IDE error `Unknown named parameter $id` pada baris pemanggilan `$this->dispatch()`
- **Penyebab**: `$this->dispatch('event-name', id: 'value')` menggunakan **named parameter PHP** (`id:`) yang tidak dikenali oleh signature method `dispatch()` di Livewire. Method `dispatch()` menerima argumen secara **positional**, bukan named.
- **Solusi**:
  ```php
  // ❌ SALAH — named parameter PHP
  $this->dispatch('open-modal', id: 'ppid-form-modal');

  // ✅ BENAR — positional argument
  $this->dispatch('open-modal', 'ppid-form-modal');
  ```
- **Pencegahan**: Saat menggunakan `$this->dispatch()` di Livewire, **selalu gunakan positional argument**. Named parameter PHP hanya berlaku jika signature method-nya memang menamai parameter tersebut.

---

---

## Template untuk Claude (salin saat menambah entri baru):

```markdown
---
## [YYYY-MM-DD] — [Judul Error Singkat]
**Status**: ✅ Selesai
**Tag**: #[tag1] #[tag2]

- **Konteks**: [Di komponen/fitur/halaman apa error ini terjadi?]
- **Gejala**: [Pesan error atau perilaku yang terlihat oleh user]
- **Penyebab**: [Root cause sebenarnya — bukan hanya gejala]
- **Solusi**:
  ```php/html/js
  [kode solusinya di sini]
  ```
- **Pencegahan**: [Apa yang harus selalu dilakukan/dihindari agar ini tidak terulang?]
---
```

---

## Pola Error Umum TALL Stack (Pre-loaded Knowledge)

### #livewire — Property tidak tersimpan
**Penyebab umum**: Lupa tambahkan nama property ke `$fillable` di Model
**Solusi**: Cek `protected $fillable` di Model terkait

### #livewire — CSRF Token Mismatch  
**Penyebab umum**: Form Livewire tidak dibungkus tag `<form>`
**Solusi**: Selalu bungkus form Livewire dengan `<form wire:submit="...">`

### #query — Data relasi tidak muncul (N+1)
**Penyebab umum**: Tidak menggunakan `with()` saat query
**Solusi**: `Model::with(['relasi1', 'relasi2'])->get()`

### #vite — Asset 404 setelah deploy
**Penyebab umum**: Lupa jalankan `npm run build` atau menggunakan URL hardcode
**Solusi**: Gunakan `@vite(...)` helper dan pastikan `npm run build` dijalankan sebelum deploy

### #alpine — `x-data` tidak reaktif ke Livewire
**Penyebab umum**: Alpine dan Livewire mengelola state terpisah
**Solusi**: Gunakan `$wire.entangle('propertyName')` untuk sinkronisasi
