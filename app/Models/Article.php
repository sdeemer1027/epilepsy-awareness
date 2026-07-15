<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends BaseModel
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [

        'category_id',

        'author_id',

        'reviewed_by_user_id',

        'title',

        'slug',

        'excerpt',

        'content',

        'featured_image',

        'featured',

        'status',

        'evidence_level',

        'reading_time',

        'view_count',

        'published_at',

        'allow_indexing',

        'created_by_user_id',

        'updated_by_user_id',

    ];

    /**
     * Attribute casting.
     */
    protected $casts = [

        'featured'        => 'boolean',

        'allow_indexing'  => 'boolean',

        'published_at'    => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by_user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            ArticleTag::class,
            'article_tag'
        )->withTimestamps();
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ArticleAttachment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    public function scopePendingReview(Builder $query): Builder
    {
        return $query->where('status', 'pending_review');
    }

    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', 'archived');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getReadingTimeLabelAttribute(): string
    {
        return "{$this->reading_time} min read";
    }

    public function getStatusLabelAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    public function getEvidenceLabelAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->evidence_level));
    }

    public function getUrlAttribute(): string
    {
        return route('knowledgebase.show', $this->slug);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function publish(): void
    {
        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    public function archive(): void
    {
        $this->update([
            'status' => 'archived',
        ]);
    }

    public function feature(): void
    {
        $this->update([
            'featured' => true,
        ]);
    }

    public function unfeature(): void
    {
        $this->update([
            'featured' => false,
        ]);
    }

    public function incrementViews(): void
    {
        $this->increment('view_count');
    }

    /*
    |--------------------------------------------------------------------------
    | Route Model Binding
    |--------------------------------------------------------------------------
    */

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}