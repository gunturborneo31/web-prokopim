<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ppid_requests', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik');
            $table->text('alamat');
            $table->string('pekerjaan');
            $table->string('email');
            $table->string('no_telepon');
            $table->text('rincian_informasi');
            $table->text('tujuan_penggunaan');
            $table->string('cara_mendapatkan'); // Misal: Melihat/Membaca...
            $table->string('cara_memperoleh');  // Misal: Mengambil Langsung...
            // Kode permohonan
            $table->string('kode_permohonan')->nullable()->unique();
            
            $table->string('status')->default('menunggu'); // menunggu, diproses, selesai, ditolak
            $table->text('respon_admin')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->unsignedBigInteger('handled_by')->nullable();
            $table->timestamp('handled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppid_requests');
    }
};
