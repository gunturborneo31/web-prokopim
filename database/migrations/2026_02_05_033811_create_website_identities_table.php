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
        Schema::create('website_identities', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            // Welcome Section
            $table->string('welcome_title')->nullable();
            $table->text('welcome_subtitle')->nullable();

            // Contact Information
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('header_contact_text')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('address')->nullable();
            $table->text('google_maps_embed')->nullable();

            // Images
            $table->string('logo')->nullable();
            $table->string('logo_secondary')->nullable();
            $table->string('logo_mengawal')->nullable();
            $table->string('logo_berakhlak')->nullable();
            $table->string('favicon')->nullable();
            $table->string('footer_logo')->nullable();

            // Leadership Team (JSON - flexible number of leaders)
            $table->json('leaders')->nullable();

            // Social Media
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();

            // Footer Links (JSON arrays)
            $table->json('footer_links_related')->nullable();   // Link Terkait
            $table->json('footer_links_city')->nullable();    // Inspektorat Kota
            $table->json('footer_links_regency')->nullable();    // Inspektorat Kab

            // GPR Widget
            $table->boolean('gpr_widget_status')->default(false);
            $table->string('gpr_widget_rss_url')->nullable()
                  ->default('https://widget.kominfo.go.id/data/latest/gpr.xml');
            
            // Survey Link
            $table->boolean('survey_link_status')->default(false);
            $table->string('survey_link_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_identities');
    }
};
