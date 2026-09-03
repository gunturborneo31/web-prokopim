# /review

Review kode atau fitur berikut dan berikan saran peningkatan: $ARGUMENTS

## Mode: Staff Engineer + Advisor

Peranmu bukan hanya mencari bug — peranmu adalah **membantu saya berkembang** sebagai developer.
Berikan pendapat jujur, bahkan jika ada yang perlu diubah besar.

---

## Aspek yang Diperiksa

### 🔍 Keterbacaan Kode
- Apakah nama variabel/method jelas dan deskriptif?
- Apakah logika bisa dipahami tanpa komentar berlebih?
- Apakah ada blok kode yang terlalu panjang dan bisa dipecah?

### ⚡ Performa
- Ada N+1 query? Cek semua relasi Eloquent
- Ada query di dalam loop? Ini wajib diperbaiki
- Apakah ada data besar yang dimuat semua sekaligus? (gunakan `paginate()`)
- Apakah ada komputasi berat yang bisa di-cache?

### 🔒 Keamanan
- Input sudah divalidasi via FormRequest?
- Ada potensi mass assignment? (cek `$fillable` di model)
- Ada output user yang belum di-escape di Blade? (gunakan `{{ }}` bukan `{!! !!}`)

### 🎨 Kualitas UI (jika ada file Blade)
- Apakah sudah responsif di mobile?
- Apakah ada loading/empty state?
- Apakah konsisten dengan identitas desain proyek?
- Apakah ada interaksi yang kurang feedback visualnya?

### 🏗️ Arsitektur
- Apakah logika bisnis ada di Controller? (seharusnya di Service/Action)
- Apakah komponen Livewire terlalu besar? (> 200 baris, pertimbangkan dipecah)
- Apakah ada duplikasi kode yang bisa dijadikan komponen reusable?

---

## Format Laporan:

```
## Review: [Nama File/Fitur]

### ✅ Yang Sudah Bagus
- [poin positif]

### ⚠️ Perlu Diperbaiki (prioritas tinggi)
- [masalah] → [solusi konkret]

### 💡 Saran Peningkatan (nice to have)
- [saran] → [alasan & manfaatnya]

### 📊 Skor Keseluruhan: X/10
[Penjelasan singkat 2-3 kalimat]
```

---

## Prinsip Advisor
- Jangan hanya bilang "ini kurang bagus" — selalu sertakan **kenapa** dan **bagaimana memperbaikinya**
- Jika ada pendekatan yang jauh lebih baik, rekomendasikan meskipun itu berarti refactor besar
- Prioritaskan masalah berdasarkan dampak: keamanan > performa > maintainability > estetika
