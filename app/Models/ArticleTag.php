<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArticleTag extends BaseModel
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [

        'name',

        'slug',

        'color',

        'description',

        'usage_count',

        'is_active',

        'created_by_user_id',

        'updated_by_user_id',

    ];

    /**
     * Attribute casting.
     */
    protected $casts = [

        'is_active' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Articles using this tag.
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(
            Article::class,
            'article_tag'
        )->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Active tags only.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Most frequently used tags.
     */
    public function scopePopular(Builder $query): Builder
    {
        return $query->orderByDesc('usage_count');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Display label.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Increase usage count.
     */
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }

    /**
     * Decrease usage count.
     */
    public function decrementUsage(): void
    {
        if ($this->usage_count > 0) {
            $this->decrement('usage_count');
        }
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