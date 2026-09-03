# /form

Buat form Livewire lengkap untuk: $ARGUMENTS

## Yang harus dibuat:

### 1. Livewire Component Class
```php
// Struktur wajib:
class NamaForm extends Component
{
    // Public properties untuk setiap field
    public string $nama = '';
    
    // Aturan validasi
    protected function rules(): array { ... }
    
    // Method submit
    public function simpan(): void { ... }
    
    // render()
}
```

Wajib sertakan:
- Tipe data PHP 8.1+ pada setiap property
- Validasi lengkap di `rules()` (required, min, max, email, unique, dll)
- Pesan error kustom dalam Bahasa Indonesia di `messages()`
- Flash message setelah berhasil submit
- Reset form setelah berhasil (`$this->reset()`)

### 2. Blade Template Form
Wajib sertakan:
- Label yang jelas untuk setiap field
- `wire:model.lazy` untuk input teks biasa
- `wire:model.live` untuk input yang perlu validasi real-time
- `@error('nama_field')` untuk setiap field
- Tombol submit dengan `wire:loading` state:
  ```html
  <button type="submit" wire:loading.attr="disabled" wire:target="simpan">
    <span wire:loading.remove wire:target="simpan">Simpan</span>
    <span wire:loading wire:target="simpan">Menyimpan...</span>
  </button>
  ```
- Styling Tailwind yang konsisten dan responsif

### 3. FormRequest (jika form juga butuh validasi server-side terpisah)
```bash
php artisan make:request NamaFormRequest
```

### Output:
- File Livewire PHP class
- File Blade template
- Perintah artisan untuk membuat file
- Cara pakai di halaman: `<livewire:nama-form />`
