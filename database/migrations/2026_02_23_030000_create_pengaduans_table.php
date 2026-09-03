<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan')->unique(); // Kode unik seperti PGD-XXXX1234
            $table->string('kategori'); // Korupsi, Gratifikasi, Penyalahgunaan wewenang, dll.
            
            // Identitas Pelapor
            $table->string('nama_lengkap');
            $table->string('nik')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('file_identitas')->nullable(); // Path file KTP/SIM

            // Detail Laporan
            $table->string('judul_laporan');
            $table->text('kronologis');
            $table->date('tanggal_kejadian')->nullable();
            $table->string('bukti_pendukung')->nullable(); // Path file bukti

            // Status & Pengelolaan
            $table->enum('status', ['baru', 'diproses', 'selesai', 'ditolak'])->default('baru');
            $table->text('catatan_admin')->nullable(); // Catatan respon admin
            $table->text('respon_publik')->nullable(); // Respon yang bisa dilihat pelapor
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('handled_at')->nullable();

            // Kerahasiaan
            $table->boolean('is_anonymous')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
