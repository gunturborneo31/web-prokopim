# /debug

Debug error berikut dari proyek TALL Stack saya: $ARGUMENTS

## ⚠️ LANGKAH PERTAMA — Cek Lessons Dulu
Sebelum menganalisis, **baca `tasks/lessons.md`** dan cari apakah error serupa pernah terjadi.
- Jika **YA** → langsung terapkan solusi yang sudah terbukti, sebutkan bahwa ini pernah terjadi sebelumnya
- Jika **TIDAK** → lanjut proses debug di bawah, lalu catat hasilnya ke lessons.md

---

## Proses Debug

### 1. Identifikasi Sumber Error
- **Laravel** → exception di `storage/logs/laravel.log`
- **Livewire** → error AJAX di Network tab browser
- **Blade** → syntax error template
- **Alpine.js** → console error browser
- **Vite/NPM** → error saat `npm run dev` atau `npm run build`

### 2. Analisis Root Cause
Jangan berhenti di pesan error — telusuri ke baris penyebabnya:
- Masalah N+1 query → tambahkan `with()`
- CSRF error → pastikan `@csrf` ada di form
- Permission error → `chmod 755 storage bootstrap/cache`
- Livewire property tidak sync → cek `wire:model` vs tipe data PHP

### 3. Berikan Solusi Permanen
- Solusi harus **permanen**, bukan patch sementara
- Sertakan kode yang diperbaiki
- Sebutkan semua file yang perlu diubah

---

## 📝 WAJIB — Catat ke `tasks/lessons.md`
Setelah error selesai, tambahkan entri baru:

```markdown
## [Tanggal] — [Judul Error Singkat]
- **Konteks**: [Di komponen/fitur apa error ini terjadi?]
- **Gejala**: [Pesan error atau perilaku yang terlihat]
- **Penyebab**: [Root cause sebenarnya]
- **Solusi**: [Kode atau langkah yang berhasil]
- **Pencegahan**: [Cara menghindari di masa depan]
- **Tag**: #livewire #validasi #query #alpine #blade #vite
```

---

## Format Jawaban ke User:
```
PERNAH TERJADI SEBELUMNYA: Ya/Tidak

PENYEBAB: [1 kalimat]
FILE YANG DIUBAH: [daftar file]
SOLUSI: [kode]
PENCEGAHAN: [1-2 kalimat]
→ Dicatat ke tasks/lessons.md ✅
```

