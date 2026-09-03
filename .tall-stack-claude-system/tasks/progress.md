# tasks/progress.md — Core CMS Development

> File ini telah di-reset untuk fokus pada pengembangan **Core CMS & Clean Admin Panel**.
> Progres fitur spesifik pemerintahan (WBS, PPID, dsb) telah diarsipkan dari fokus utama.

---

## Status Proyek
**Terakhir diupdate**: 2026-04-30
**Fase saat ini**: FASE 3 — Quality Control Khusus Superadmin & UI Testing.
**Fokus Utama**: REST API Testing, Cleanup Admin Panel.

---

## Core CMS Features ✅
- [x] **Dynamic Page Builder**: Sistem template modular (Grid, List, Profile, dsb).
- [x] **Menu Management**: Navigasi hirarkis yang terintegrasi dengan Page Builder.
- [x] **Website Identity**: Pengaturan branding (Logo, Favicon, Title).
- [x] **Filament Admin Panel**: Custom UI dengan tema Light/Dark yang konsisten, desain Premium Split-Screen Login & Blue Glassmorphism Dashboard.
- [x] **Database Schema**: Skema tabel yang optimal untuk konten dinamis.

---

## Sedang Dikerjakan 🔄
- [x] **Modul SEO**: Menambahkan arsitektur SEO (Meta Title, Description, Image) berformat JSON di `WebsiteIdentity` (Global) dan di `Post` (Spesifik Berita). Beserta implementasi UI *Smart Fallback* di Filament.
- [x] **Modul REST API (FASE 2)**: Membuat Endpoint `/api/v1/posts` (Filter) dan `/api/v1/ppids` dengan arsitektur **Lazy Load** (Tidak langsung 1 pohon besar, melainkan terpisah: List Jenis -> Klik Jenis dapat list Kategori -> Klik Kategori dapat list File) untuk efisiensi Payload. Termasuk pembuatan `DummyApiSeeder`.
- [x] **Cleanup Boilerplate**: Menyembunyikan modul spesifik pemerintahan (WBS, Pengaduan, Permohonan PPID) dari navigasi admin agar menjadi Core CMS Generic.

---

## Antrian Berikutnya 📋
**Roadmap Secepatnya (Prioritas Tinggi)**:
1. ~~**FASE 1 — Fondasi Data SEO & UI Admin**~~ ✅ **Selesai**
2. ~~**FASE 2 — Pembuatan API Endpoint**~~ ✅ **Selesai**
3. **FASE 3 — Quality Control Khusus Superadmin**: Memastikan panel admin hanya fokus untuk Superadmin dan *boilerplate ready* (Mengecek API menggunakan Postman).
   ### 2. Status Blocker (Bug)
   *   **Issue:** `League\Flysystem\UnableToRetrieveMetadata` pada Filament `FileUpload`.
   *   **Penyebab Teridentifikasi:**
       *   Berawal dari konfigurasi direktori `livewire.php` yang konflik (teratasi sebelumnya dengan mengembalikan ke `livewire-tmp`).
       *   **Penyebab Utama Tersembunyi:** File yang di-upload oleh user (untuk testing) memiliki *filename* asli yang **sangat panjang** (lebih dari 150 karakter).
       *   Karena Filament menggunakan *Temporary Upload* via Livewire (yang melakukan `base64_encode` pada nama asli file untuk disematkan dalam *hash* string), total karakter path melampaui limit *Max Path Length* sistem operasi Windows (260 karakter).
       *   Hal ini menyebabkan `storeAs` (Flysystem) gagal menulis file secara diam-diam (karena default `throw => false` di disk `public`). Kegagalan ini mengembalikan path kosong (`""`) ke _frontend_ Filament, yang memicu _loop_ pembacaan *metadata* ke direktori `livewire-tmp` itu sendiri, sehingga menampilkan error `UnableToRetrieveMetadata`.
   *   **Tindakan yang Telah Diambil:**
       *   Konfigurasi direktori `livewire-tmp` telah diluruskan.
       *   Opsi `throw => true` telah diaktifkan di disk `public` (`config/filesystems.php`) agar sistem "berteriak" (memberikan error spesifik 500) alih-alih diam-diam gagal.
       *   Mengembalikan *source code* vendor Livewire ke versi _fresh_ (via composer reinstall).
       *   **Status:** **RESOLVED** secara teknis. Bug ini tidak berasal dari kode aplikasi CMS itu sendiri, melainkan limitasi OS Windows terhadap penamaan file yang ekstrem panjangnya saat melalui pipeline Livewire. Solusinya adalah sekadar memperpendek nama file sebelum di-upload atau memberlakukan limitasi pada _frontend_.
4. **FASE 4 — Deployment Hostinger**: Menyiapkan konfigurasi CORS & `.htaccess` agar API bisa diakses dari portal berita luar tanpa *block*. — *Ditunda sesuai permintaan user*.

---

## Keputusan Arsitektur 🏗️
- **Modularitas**: Fitur tambahan (seperti News/Posts) dianggap sebagai modul opsional, bukan bagian dari Core CMS.
- **UI/UX**: Menggunakan sistem layout *Split Sidebar* untuk Page Builder agar pengeditan konten lebih lega.
- **Branding**: Semua asset branding harus bisa diubah sepenuhnya via panel tanpa edit kode.

---

## Catatan Penting ⚠️
- Project ini sekarang berfungsi sebagai **Starter Kit / Boilerplate** CMS berbasis TALL stack.
