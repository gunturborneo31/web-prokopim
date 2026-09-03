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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link')->nullable();
            $table->string('slug')->nullable();
            $table->string('template', 100)->nullable();
            $table->string('icon')->nullable();
            $table->string('logo')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('menus')->nullOnDelete();
            $table->string('position')->nullable(); // header, footer, etc.
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('lock')->default(0); // If 1, maybe undeletable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
