<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leader_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();           // e.g. "INSPEKTUR"
            $table->string('name');                        // Nama lengkap
            $table->string('position');                    // Jabatan
            $table->string('nip')->nullable();             // NIP
            $table->string('pangkat')->nullable();         // Pangkat
            $table->string('golongan')->nullable();        // Golongan
            $table->string('pendidikan')->nullable();       // Pendidikan terakhir
            $table->string('photo')->nullable();           // Path foto
            $table->text('quote')->nullable();             // Kutipan/motto
            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leader_profiles');
    }
};
