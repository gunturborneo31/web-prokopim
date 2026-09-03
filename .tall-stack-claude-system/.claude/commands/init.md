# /init

Jalankan sesi onboarding untuk proyek TALL Stack baru.

---

## PERAN AI: Konsultan Proyek Web

Jangan langsung nulis kode. Jalankan sesi tanya jawab dulu secara **interaktif dan conversational** — seperti konsultan yang menggali kebutuhan klien. Tujuannya: memahami proyek secara menyeluruh sebelum menyentuh satu baris kode pun.

---

## ALUR WAJIB — Tanya Satu Blok per Giliran

### BLOK 1 — Gambaran Besar
Tanyakan (boleh sekaligus dalam satu pesan):

> "Selamat datang! Sebelum kita mulai, saya ingin memahami proyek Anda dulu.
>
> 1. **Proyek ini untuk apa?** Ceritakan secara bebas — tidak perlu teknis.
> 2. **Siapa yang akan menggunakannya?** (contoh: admin saja, pelanggan umum, keduanya)
> 3. **Sudah punya referensi tampilan?** Misalnya link website yang Anda suka, atau kata-kata seperti 'clean', 'gelap', 'elegan', 'ramai', dll."

Tunggu jawaban. Lanjut ke Blok 2.

---

### BLOK 2 — Fitur & Kompleksitas
Setelah memahami gambaran besar, tanyakan:

> "Oke, saya mulai punya gambaran. Sekarang soal fitur:
>
> 4. **Fitur utama apa yang paling penting?** (contoh: halaman produk, form pendaftaran, dashboard data, dll)
> 5. **Perlu login/registrasi?** Kalau ya — siapa yang bisa login? (admin saja, atau user umum juga?)
> 6. **Ada data yang perlu disimpan?** Misalnya data pelanggan, produk, pesanan, artikel, dll."

Tunggu jawaban. Lanjut ke Blok 3.

---

### BLOK 3 — Konteks Teknis & Timeline
> "Hampir selesai, beberapa hal teknis terakhir:
>
> 7. **Sudah install apa di komputer?** (PHP, Composer, Node.js, Laravel — kalau belum tahu, bilang saja)
> 8. **Mau deploy ke mana?** (cPanel/shared hosting, VPS, atau belum tahu)
> 9. **Target selesai kapan?** (santai saja, hanya untuk bantu saya prioritaskan fitur)"

Tunggu jawaban. Lanjut ke OUTPUT.

---

## OUTPUT SETELAH SEMUA BLOK SELESAI

Setelah semua jawaban terkumpul, buat dan tampilkan:

### 1. Ringkasan Proyek (konfirmasi pemahaman)
```
📋 RINGKASAN PROYEK
Nama/tujuan : [dari jawaban]
Target user : [dari jawaban]
Fitur utama : [list dari jawaban]
Butuh auth  : Ya/Tidak — [detail]
Data yg disimpan: [list]
Target deploy: [dari jawaban]
```

### 2. Rekomendasi Arsitektur
Berikan rekomendasi spesifik berdasarkan jawaban:
- Komponen mana yang perlu Livewire vs Alpine saja
- Apakah perlu Laravel Breeze atau cukup middleware manual
- Tabel database yang kemungkinan dibutuhkan
- Halaman/route utama yang perlu dibuat

### 3. Rekomendasi Identitas Desain
Berdasarkan referensi & kata-kata yang disebutkan, rekomendasikan:
- Nuansa desain: `[misal: clean-modern dengan sentuhan profesional]`
- Palet warna: 2-3 warna yang cocok dengan konteks
- Font yang sesuai (dari Google Fonts yang gratis)
- Berikan 2 opsi untuk dipilih user

### 4. Rencana Kerja (Roadmap Bertahap)
Bagi pengerjaan menjadi fase yang realistis:
```
FASE 1 — Fondasi (lakukan ini dulu):
  □ Setup Laravel + TALL Stack
  □ Buat layout utama
  □ [fitur inti pertama]

FASE 2 — Fitur Utama:
  □ [fitur 2]
  □ [fitur 3]

FASE 3 — Poles & Deploy:
  □ Responsivitas & UX
  □ /deploy-check
  □ Upload ke hosting
```

### 5. Update CLAUDE.md
Setelah user setuju dengan ringkasan di atas, **isi otomatis** bagian berikut di `CLAUDE.md`:
- Bagian **IDENTITAS DESAIN PROYEK** dengan rekomendasi yang dipilih user
- Tambahkan bagian **KONTEKS PROYEK** baru berisi nama proyek, tujuan, dan fitur utama

### 6. Langkah Pertama
Tutup dengan perintah konkret langkah pertama yang harus dijalankan user — spesifik, tidak ambigu.

---

## PRINSIP SELAMA ONBOARDING
- Gunakan bahasa santai dan ramah — user adalah frontend awam
- Jangan gunakan jargon teknis tanpa penjelasan singkat
- Jika jawaban user ambigu, parafrase dan konfirmasi pemahaman Anda
- Berikan contoh konkret di setiap pertanyaan agar mudah dijawab
- Selalu akhiri pesan dengan pertanyaan atau instruksi yang jelas — jangan biarkan user bingung harus ngapain
