# UI Kit - Website Instansi

## 1. Komponen Dasar

### Tombol Primer
```html
<button class="rounded-full bg-[#0f2747] px-5 py-3 font-semibold text-white shadow-[0_10px_30px_rgba(15,23,42,0.08)]">
  Lihat Detail
</button>
```

### Tombol Sekunder
```html
<button class="rounded-full border border-[#0f2747] bg-white px-5 py-3 font-semibold text-[#0f2747]">
  Pelajari Lebih Lanjut
</button>
```

### Tombol Aksen
```html
<button class="rounded-full bg-[#f59e0b] px-5 py-3 font-semibold text-white">
  Hubungi Kami
</button>
```

## 2. Card
```html
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,0.08)]">
  <h3 class="text-lg font-semibold text-[#0f172a]">Judul Card</h3>
  <p class="mt-2 text-sm text-[#64748b]">Deskripsi singkat konten</p>
</div>
```

## 3. Hero Section
```html
<section class="bg-slate-50 px-6 py-20 lg:px-12">
  <div class="mx-auto grid max-w-7xl items-center gap-10 lg:grid-cols-2">
    <div>
      <h1 class="text-4xl font-bold text-[#0f172a] lg:text-5xl">Headline Utama</h1>
      <p class="mt-4 text-lg text-[#64748b]">Subheadline yang menjelaskan layanan atau informasi.</p>
      <div class="mt-6 flex gap-3">
        <button class="rounded-full bg-[#0f2747] px-5 py-3 font-semibold text-white">Mulai</button>
        <button class="rounded-full border border-[#0f2747] px-5 py-3 font-semibold text-[#0f2747]">Lihat Lebih</button>
      </div>
    </div>
    <div class="rounded-3xl bg-white p-6 shadow-[0_16px_40px_rgba(15,23,42,0.12)]">
      <div class="h-72 rounded-2xl bg-gradient-to-br from-[#0f2747] to-[#1e3a5f]"></div>
    </div>
  </div>
</section>
```

## 4. Navbar
```html
<nav class="border-b border-slate-200 bg-white/90 backdrop-blur">
  <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
    <div class="font-semibold text-[#0f2747]">Logo Instansi</div>
    <div class="hidden gap-6 text-sm text-[#334155] md:flex">
      <a href="#">Beranda</a>
      <a href="#">Profil</a>
      <a href="#">Layanan</a>
      <a href="#">Kontak</a>
    </div>
  </div>
</nav>
```

## 5. Modal / Lightbox
```html
<div class="fixed inset-0 flex items-center justify-center bg-black/80 p-4">
  <div class="relative w-full max-w-4xl rounded-2xl bg-white p-4 shadow-2xl">
    <button class="absolute right-4 top-4 text-slate-500">✕</button>
    <img src="" alt="" class="max-h-[80vh] w-full rounded-xl object-contain" />
  </div>
</div>
```

## 6. Form Input
```html
<div class="space-y-2">
  <label class="text-sm font-medium text-[#0f172a]">Nama</label>
  <input class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none focus:border-[#0f2747]" />
</div>
```

## 7. Spacing dan Radius
- Padding section: 64px–96px
- Radius card: 16px–24px
- Radius button: 999px
- Shadow: lembut dan konsisten

## 8. State UI
- Hover: translateY(-4px) atau scale(1.02)
- Focus: border warna primer
- Disabled: opacity 50%
