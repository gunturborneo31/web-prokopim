<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Lampiran PDF / video: daftar path file & nama asli file
            $table->json('attachments')->nullable()->after('content');
            $table->json('attachment_names')->nullable()->after('attachments');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['attachments', 'attachment_names']);
        });
    }
};
