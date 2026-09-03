# Design System Referensi Website Instansi

Dokumen ini berfungsi sebagai acuan visual untuk meniru nuansa desain website ini ke aplikasi lain, khususnya yang ingin terasa formal, modern, bersih, dan profesional.

## 1. Tujuan Visual

Desain website ini menonjolkan karakter:
- Formal dan terpercaya
- Bersih, modern, dan nyaman dibaca
- Berwarna navy yang kuat dengan aksen kuning/oranye
- Mengutamakan hierarki visual yang rapi
- Menyediakan pengalaman yang ringan, responsif, dan elegan

## 2. Identitas Warna

Gunakan palet berikut sebagai dasar desain:

- Primary: #0f2747
- Surface: #f8fafc
- Accent: #f59e0b
- Text Main: #0f172a
- Text Muted: #64748b
- White: #ffffff
- Border: #e2e8f0

### Token CSS yang disarankan

```css
:root {
  --color-primary: #0f2747;
  --color-surface: #f8fafc;
  --color-accent: #f59e0b;
  --color-text-main: #0f172a;
  --color-text-muted: #64748b;
  --color-border: #e2e8f0;
  --radius-sm: 10px;
  --radius-md: 16px;
  --radius-lg: 24px;
  --shadow-soft: 0 10px 30px rgba(15, 23, 42, 0.08);
  --shadow-card: 0 16px 40px rgba(15, 23, 42, 0.12);
}
```

## 3. Tipografi

Gunakan kombinasi font yang terasa modern dan formal:

- Heading: Montserrat atau Inter
- Body: Instrument Sans, Inter, atau system sans
- Label/CTA: Inter

### Prinsip tipografi
- Heading tegas dan padat
- Body teks tidak terlalu tebal
- Gunakan jarak baris yang nyaman
- Hindari terlalu banyak variasi font

## 4. Layout dan Spasi

### Struktur layout umum
- Container maksimal: 1200px ke atas
- Padding horizontal: 16px mobile, 24px tablet, 48px desktop
- Jarak antar section: 64px hingga 96px

### Pola grid
- Grid 1 kolom untuk mobile
- Grid 2 kolom untuk tablet
- Grid 3 kolom untuk layout yang lebih luas
- Kombinasi grid yang seimbang untuk konten utama dan sidebar

### Spacing scale
- 4px, 8px, 12px, 16px, 24px, 32px, 48px, 64px

## 5. Komponen Utama

### a. Navbar
- Background putih atau semi-transparan
- Border bawah tipis
- Logo kiri, menu tengah/kanan, tombol CTA
- Bisa dibuat sticky saat scroll
- Tambahkan efek blur ringan bila ingin kesan premium

### b. Hero Section
- Elemen utama di sisi kiri: headline, subheadline, CTA
- Elemen visual di sisi kanan: gambar, ilustrasi, atau banner besar
- Gunakan background soft, overlay, dan efek blur ringan
- Susun agar fokus utama tetap pada headline

### c. Card Konten
- Rounded 16px sampai 24px
- Border tipis, shadow lembut
- Hover effect: sedikit naik, gambar zoom ringan
- Cocok untuk berita, layanan, artikel, agenda, dan fitur

### d. Slider / Carousel
- Gambar besar dengan transisi halus
- Kontrol vertikal atau bawah
- Fokus pada presentasi visual yang bersih
- Terapkan autoplay lembut dengan transisi yang halus

### e. Modal / Lightbox
- Latar hitam semi-transparan
- Tombol tutup di kanan atas
- Gambar ditampilkan penuh dan fokus
- Pastikan konten modal tidak terlalu ramai

### f. Footer
- Warna navy gelap dominan
- Informasi organisasi, kontak, tautan penting
- Memberi kesan resmi dan terpercaya

## 6. Interaksi dan Animasi

### Efek yang sering dipakai
- Hover lift: elemen naik sedikit ke atas
- Hover zoom: gambar membesar tipis
- Reveal on scroll: elemen muncul perlahan saat masuk viewport
- Transition halus: 200ms–800ms

### Contoh efek
```css
transition: all 0.3s ease;
transform: translateY(-6px);
transform: scale(1.08);
```

## 7. Visual Style

### Nuansa desain
- Clean dan modern
- Tidak terlalu penuh dekorasi
- Kesan formal pemerintahan/instansi
- Fokus pada informasi yang mudah dibaca

### Detail visual
- Radius card: 16px–32px
- Shadow lembut: rgba(15, 23, 42, 0.08)
- Border tipis untuk pemisah visual
- Overlay untuk memperjelas teks di gambar

## 8. Pola UI yang Sering Dipakai

### Layout konten berita
- Gambar besar di utama
- Sidebar kecil untuk agenda atau list terkait
- Keseimbangan visual yang rapi

### Layout layanan / fitur
- Kartu-kartu dengan ikon, title, deskripsi, CTA
- Menggunakan spacing konsisten di semua elemen

### Layout call to action
- Warna accent sebagai penanda action
- Tombol dengan kontras tinggi
- Desain sederhana namun mencolok

## 9. Referensi Implementasi di Project Ini

Elemen visual utama yang bisa dijadikan acuan:
- [resources/css/app.css](resources/css/app.css)
- [resources/views/sections/slider-pengumuman.blade.php](resources/views/sections/slider-pengumuman.blade.php)

## 10. Panduan Meniru ke Aplikasi Lain

Saat menerapkan desain ini ke aplikasi lain, ikuti urutan berikut:
1. Tetapkan palet warna primer dan aksen
2. Buat layout container dan spacing sistem
3. Terapkan komponen navbar, hero, card, modal, dan footer
4. Tambahkan animasi ringan yang konsisten
5. Pastikan desain tetap bersih dan tidak terlalu ramai

## 11. Saran Implementasi Cepat

Jika ingin cepat meniru gaya ini di aplikasi lain, gunakan pendekatan:
- Tailwind CSS untuk layout dan spacing
- Variabel warna CSS untuk konsistensi
- Shadow dan radius yang seragam
- Komponen reusable untuk card, button, navbar, dan modal

## 12. Contoh Komponen Dasar

### Tombol
```html
<button class="rounded-full bg-[color:var(--color-accent)] px-5 py-3 font-semibold text-white shadow-soft">
  Lihat Detail
</button>
```

### Card
```html
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-soft">
  <h3 class="text-lg font-semibold text-[color:var(--color-text-main)]">Judul</h3>
  <p class="mt-2 text-sm text-[color:var(--color-text-muted)]">Deskripsi singkat</p>
</div>
```

## 13. Ringkasan Visual

Desain ini cocok untuk aplikasi yang ingin terasa:
- Profesional
- Modern
- Formal
- Informatif
- Nyaman untuk pengguna umum
