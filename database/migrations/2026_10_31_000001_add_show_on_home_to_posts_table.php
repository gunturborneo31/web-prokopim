<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Penanda pengumuman yang tayang di panel samping slider beranda
            $table->boolean('show_on_home')->default(false)->after('status')->index();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['show_on_home']);
            $table->dropColumn('show_on_home');
        });
    }
};
