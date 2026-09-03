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
        Schema::create('ppids', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('tempat_pembuatan')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('format_informasi')->nullable();
            $table->date('tanggal_pembuatan')->nullable();
            $table->string('jangka_waktu_penyimpanan')->nullable();
            $table->string('file')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('ppids')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppids');
    }
};
