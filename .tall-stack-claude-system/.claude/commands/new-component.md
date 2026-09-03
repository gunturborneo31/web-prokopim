# /new-component

Buat komponen TALL Stack baru berdasarkan deskripsi berikut: $ARGUMENTS

## Langkah yang harus dilakukan:

1. **Tentukan tipe komponen:**
   - Apakah perlu interaksi server (database, session) → **Livewire Component**
   - Apakah hanya UI statik/reusable → **Blade Component**
   - Apakah hanya interaksi klien (show/hide, animasi) → **Blade + Alpine.js**

2. **Jika Livewire**, buat dengan format:
   ```bash
   php artisan livewire:make NamaKomponen
   ```
   Sertakan:
   - Properties dengan tipe data PHP 8.1+
   - Validasi `rules()` jika ada input
   - `wire:loading` pada semua tombol aksi
   - Skeleton loader jika ada data dari database

3. **Jika Blade Component**, buat dengan format:
   ```bash
   php artisan make:component NamaKomponen
   ```
   Gunakan `$slot` atau named slots untuk konten dinamis

4. **Tailwind**: Mobile-first, gunakan utility classes standar, tambahkan hover/focus states

5. **Alpine.js** (jika perlu): Tambahkan `x-data` minimal, hanya untuk state lokal UI

## Output yang dihasilkan:
- File PHP class (jika Livewire/Blade Component)
- File Blade template
- Contoh cara pemakaian `<livewire:nama-komponen />` atau `<x-nama-komponen />`
- Penjelasan singkat cara kerjanya (1-2 kalimat)
