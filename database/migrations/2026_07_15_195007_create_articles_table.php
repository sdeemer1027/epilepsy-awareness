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
        Schema::create('articles', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('category_id')
                ->constrained('article_categories')
                ->cascadeOnDelete();

            $table->foreignId('author_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('reviewed_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Article Information
            |--------------------------------------------------------------------------
            */

            $table->string('title', 200);

            $table->string('slug', 220)->unique();

            $table->text('excerpt')->nullable();

            $table->longText('content');

            /*
            |--------------------------------------------------------------------------
            | Display
            |--------------------------------------------------------------------------
            */

            $table->string('featured_image')->nullable();

            $table->boolean('featured')->default(false);

            /*
            |--------------------------------------------------------------------------
            | Publishing Workflow
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'draft',
                'pending_review',
                'published',
                'archived'
            ])->default('draft');

            /*
            |--------------------------------------------------------------------------
            | Evidence Level
            |--------------------------------------------------------------------------
            */

            $table->enum('evidence_level', [
                'community_experience',
                'clinically_reviewed',
                'research_based',
                'official_guideline'
            ])->default('community_experience');

            /*
            |--------------------------------------------------------------------------
            | Reading Information
            |--------------------------------------------------------------------------
            */

            $table->unsignedSmallInteger('reading_time')
                ->default(1);

            $table->unsignedInteger('view_count')
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Publishing Dates
            |--------------------------------------------------------------------------
            */

            $table->timestamp('published_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Auditing
            |--------------------------------------------------------------------------
            */

            $table->foreignId('created_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Laravel
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('category_id');
            $table->index('author_id');
            $table->index('status');
            $table->index('featured');
            $table->index('published_at');
            $table->index('evidence_level');
            $table->boolean('allow_indexing')->default(true);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};