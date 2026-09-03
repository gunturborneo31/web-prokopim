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
        Schema::create('ppid_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppid_id')->constrained('ppids')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('tempat_pembuatan')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('format_informasi')->nullable();
            $table->date('tanggal_pembuatan')->nullable();
            $table->string('jangka_waktu_penyimpanan')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('downloads')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppid_items');
    }
};
