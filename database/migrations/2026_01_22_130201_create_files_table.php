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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->nullable(); // image, document, etc.
            $table->string('path');
            $table->unsignedBigInteger('size')->nullable(); // ukuran file dalam bytes
            $table->string('disk')->default('public');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('fileable_type')->nullable(); // Polymorphic
            $table->unsignedBigInteger('fileable_id')->nullable(); // Polymorphic
            $table->string('field')->nullable(); // Field purpose (e.g. 'avatar', 'gallery')
            $table->text('meta')->nullable();
            $table->timestamps();

            $table->index(['fileable_type', 'fileable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
