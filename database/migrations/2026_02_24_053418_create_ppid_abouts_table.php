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
        Schema::create('ppid_abouts', function (Blueprint $table) {
            $table->id();
            $table->longText('profil')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->longText('maklumat')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppid_abouts');
    }
};
