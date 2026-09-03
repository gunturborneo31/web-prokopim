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
        Schema::table('posts', function (Blueprint $table) {
            $table->json('seo')->nullable()->after('status');
        });

        Schema::table('website_identities', function (Blueprint $table) {
            $table->json('seo')->nullable()->after('survey_link_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_identities', function (Blueprint $table) {
            $table->dropColumn('seo');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('seo');
        });
    }
};
