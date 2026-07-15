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
        Schema::create('article_attachments', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('article_id')
                ->constrained('articles')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Attachment Information
            |--------------------------------------------------------------------------
            */

            $table->string('title', 200);

            $table->string('file_name');

            $table->string('original_file_name');

            $table->string('mime_type', 100);

            $table->unsignedBigInteger('file_size')->default(0);

            $table->string('disk')->default('public');

            $table->string('file_path');

            /*
            |--------------------------------------------------------------------------
            | Display
            |--------------------------------------------------------------------------
            */

            $table->text('description')->nullable();

            $table->boolean('is_downloadable')->default(true);

            $table->unsignedInteger('download_count')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')->default(true);

            /*
            |--------------------------------------------------------------------------
            | Auditing
            |--------------------------------------------------------------------------
            */

            $table->foreignId('created_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Laravel
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('article_id');

            $table->index('mime_type');

            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_attachments');
    }
};