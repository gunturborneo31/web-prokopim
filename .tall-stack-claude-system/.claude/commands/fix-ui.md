# /fix-ui

Perbaiki dan tingkatkan tampilan komponen/halaman berikut: $ARGUMENTS

## Tugas AI — Senior UI/UX Engineer Mode:

### 1. Analisis Tampilan
- Identifikasi elemen yang terasa kaku, tidak responsif, atau membosankan
- Cek apakah sudah mobile-first (`sm:` → `md:` → `lg:`)
- Pastikan spacing konsisten (gunakan skala Tailwind: 4, 6, 8, 12, 16)

### 2. Perbaikan Tailwind
Tambahkan atau perbaiki:
- `hover:` dan `focus:` states pada elemen interaktif
- `transition-all duration-200` untuk animasi halus
- `rounded-xl shadow-sm` untuk card yang lebih modern
- Warna konsisten menggunakan palet yang sudah ada di proyek

### 3. Injeksi Alpine.js (jika dibutuhkan)
Contoh pattern yang boleh ditambahkan:
```html
<!-- Dropdown -->
<div x-data="{ open: false }">
  <button @click="open = !open">Menu</button>
  <div x-show="open" x-transition>...</div>
</div>

<!-- Loading state tombol -->
<button @click="loading = true" :disabled="loading" x-data="{ loading: false }">
  <span x-show="!loading">Simpan</span>
  <span x-show="loading">Menyimpan...</span>
</button>
```

### 4. Livewire Loading States
Pastikan semua aksi Livewire punya feedback:
```html
<button wire:click="simpan" wire:loading.attr="disabled">
  <span wire:loading.remove>Simpan</span>
  <span wire:loading>Memproses...</span>
</button>
```

### 5. Output
- Kode Blade yang sudah diperbaiki (tampilkan diff atau file lengkap)
- Daftar singkat perubahan yang dibuat (maksimal 5 poin)
- Tidak boleh menambah library JavaScript baru

### 5. Advisor Mode (wajib aktif)
Sebelum menyerahkan hasil, evaluasi dan sampaikan jika ada:
- Komponen yang sebaiknya dijadikan Blade reusable (`<x-...>`)
- Pola desain yang tidak konsisten dengan identitas proyek
- UX flow yang membingungkan

Format: `💡 SARAN: [masalah] → [rekomendasi]`

### 6. Filament PHP Forms & Layouting
Saat bekerja dengan komponen Backend atau *Form Builder* Filament:
- **Prioritaskan *Whitespace*:** Hindari meletakkan komponen lebar seperti `RichEditor` ke dalam `Grid` multi-kolom yang berpotensi membuatnya menyempit (*squished toolbars*).
- **Beralih ke `Tabs`:** Atasi masalah *grid* yang tumpang tindih untuk komponen yang kompleks (seperti Editor majemuk untuk layout multi-panel) dengan cara memisahkannya ke dalam `Tabs`.
- **Standar Layout CMS Terpisah (Split Sidebar):** Untuk rancangan *Page Builder*, pakailah struktur 3-Kolom. Gunakan `columnSpan(2)` (kiri) untuk area pengeditan konten, dan letakkan metadata esensial (+ *toggle* Status Publikasi) pada porsi `columnSpan(1)` sebagai *sidebar* menempel di kanan. Jangan pernah meletakkan pengaturan krusial di balik tab *hidden* yang menyebabkan admin rentan melupakannya.
