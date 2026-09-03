<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leader_profile_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leader_profile_id')->constrained()->cascadeOnDelete();
            $table->string('year_start');                  // Tahun mulai, e.g. "2022"
            $table->string('year_end')->nullable();        // Tahun selesai, null = "Sekarang"
            $table->string('position');                    // Nama jabatan
            $table->string('institution')->nullable();     // Instansi/lembaga
            $table->text('description')->nullable();       // Deskripsi singkat
            $table->boolean('is_current')->default(false); // Jabatan sekarang
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leader_profile_histories');
    }
};
