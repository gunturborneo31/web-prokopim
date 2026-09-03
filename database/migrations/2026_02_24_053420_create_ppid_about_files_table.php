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
        Schema::create('ppid_about_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppid_about_id')->nullable()->constrained('ppid_abouts')->cascadeOnDelete();
            $table->string('name');
            $table->string('file');
            $table->foreignId('ppid_id')->nullable()->constrained('ppids')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppid_about_files');
    }
};
