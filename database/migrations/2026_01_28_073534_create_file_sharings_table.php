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
        // Drop old galleries table if exists
        Schema::dropIfExists('galleries');

        // Create file_sharings table with all necessary columns if it doesn't exist
        if (! Schema::hasTable('file_sharings')) {
            Schema::create('file_sharings', function (Blueprint $table) {
                $table->id();
                $table->string('share_code', 10)->nullable()->unique();
                $table->string('title');
                $table->boolean('is_folder')->default(false);
                $table->foreignId('parent_id')->nullable()->constrained('file_sharings')->onDelete('cascade');
                $table->string('file_path')->nullable();
                $table->text('description')->nullable();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
                $table->string('type')->nullable();
                $table->string('size')->nullable();
                $table->integer('download_count')->default(0);
                $table->boolean('is_public')->default(true);
                $table->boolean('is_favorite')->default(false);
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_sharings');

        // Restore galleries table
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('image');
            $table->string('caption')->nullable();
            $table->string('slug')->nullable();
            $table->string('link')->nullable();
            $table->string('tags')->nullable();
            $table->text('description')->nullable();
            $table->integer('read')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }
};
