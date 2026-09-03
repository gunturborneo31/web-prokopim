# /new-page

Buat halaman baru: $ARGUMENTS

## Mode: Senior UI/UX + TALL Stack Engineer

### 1. Sebelum Koding — Tanya Dulu (jika belum jelas)
- Halaman ini untuk siapa? (admin, user umum, tamu)
- Ada data dari database? Atau halaman statik?
- Ada interaksi penting? (filter, search, modal, form)

### 2. Periksa Identitas Desain (dari CLAUDE.md)
Baca bagian **IDENTITAS DESAIN PROYEK** dan pastikan halaman baru konsisten:
- Pakai palet warna yang sama
- Pakai font yang sama
- Pakai border radius yang sama
- Nuansa desain harus seragam

### 3. Struktur Halaman
Buat dengan layout yang mempertimbangkan:
- **Hero/Header section** — informasi paling penting di atas
- **Konten utama** — gunakan Bento Grid jika ada banyak informasi
- **Empty state** — tampilkan UI yang bagus saat data kosong
- **Loading state** — skeleton screen, bukan spinner polos

### 4. Komponen yang Wajib Ada
```html
{{-- Layout wrapper --}}
<x-layouts.app>
  {{-- Page header dengan breadcrumb --}}
  {{-- Konten utama --}}
  {{-- Empty state (jika ada data) --}}
</x-layouts.app>
```

### 5. Standar Visual Premium (wajib)
- Tambahkan `transition-all duration-200` pada elemen interaktif
- Card menggunakan `shadow-sm hover:shadow-md` 
- Tombol primer punya `hover:-translate-y-0.5` untuk feel premium
- Gunakan gradien subtle pada header section jika sesuai nuansa proyek
- Warna teks gunakan skala opacity: judul `text-gray-900`, body `text-gray-600`, caption `text-gray-400`

### 6. Responsivitas Wajib
Setiap halaman ditest untuk:
- Mobile (`< 640px`) — satu kolom, padding kecil
- Tablet (`640px–1024px`) — dua kolom
- Desktop (`> 1024px`) — layout penuh

### 7. Output
- File Blade lengkap
- Livewire component jika ada data dinamis
- Daftar komponen yang dipakai ulang (`<x-...>`)
- 💡 SARAN jika ada pola desain yang bisa lebih baik

---

> **Prinsip**: Halaman yang selesai harus terasa *dibuat desainer*, bukan *diprint dari template*.
