# /deploy-check

Lakukan pemeriksaan kesiapan hosting untuk proyek ini.

## Checklist Wajib:

### 🔒 Keamanan
- [ ] File `.env` tidak ikut ter-commit (cek `.gitignore`)
- [ ] `APP_DEBUG=false` di `.env` produksi
- [ ] `APP_ENV=production` sudah diset
- [ ] Tidak ada kredensial hardcode di kode (API key, password)
- [ ] CSRF protection aktif (form Livewire otomatis, tapi cek form HTML biasa)

### 📁 Path & Asset
- [ ] Semua asset menggunakan `asset()`, `vite()`, atau `route()` — tidak ada URL hardcode
- [ ] Jalankan `npm run build` dan pastikan tidak ada error
- [ ] Folder `public/build/` ter-generate dengan benar
- [ ] Cek `APP_URL` di `.env` sudah sesuai domain produksi

### 🗄️ Database
- [ ] Semua migration sudah dibuat dan tidak ada error
- [ ] Tidak ada `dd()`, `dump()`, atau `ray()` yang tertinggal di kode
- [ ] Eager loading (`with()`) sudah dipakai di semua query yang perlu relasi

### ⚙️ Server (cPanel/VPS)
- [ ] Permission folder: `chmod 755 storage` dan `chmod 755 bootstrap/cache`
- [ ] Jalankan: `php artisan config:cache`
- [ ] Jalankan: `php artisan route:cache`
- [ ] Jalankan: `php artisan view:cache`
- [ ] Jalankan: `php artisan optimize`
- [ ] Document root server mengarah ke folder `public/`

### 🎨 Frontend
- [ ] Tidak ada `console.log()` yang tertinggal di JS
- [ ] Semua gambar menggunakan `asset()` atau path relatif yang benar
- [ ] Test tampilan di mobile (responsive check)

### ✅ Test Fungsional
- [ ] Login / Register berfungsi
- [ ] Form submit berfungsi (cek CSRF)
- [ ] Upload file berfungsi (jika ada)
- [ ] Email/notifikasi berfungsi (jika ada)

## Output:
Laporkan setiap item yang **GAGAL** dengan solusi singkat.
Jika semua aman, nyatakan "✅ Siap deploy".
