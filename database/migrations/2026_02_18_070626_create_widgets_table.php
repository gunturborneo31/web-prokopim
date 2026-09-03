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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(false);
            $table->string('rss_url')->default('https://widget.kominfo.go.id/data/latest/gpr.xml');
            $table->string('position')->default('sidebar_right'); // 'sidebar_left' or 'sidebar_right'
            $table->integer('width')->default(500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
