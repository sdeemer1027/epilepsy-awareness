<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * Epilepsy Support Platform (ESP)
 *
 * Article Category Model
 *
 * Represents a category within the Knowledge Base.
 *
 * Categories support unlimited nesting through parent_id.
 */
class ArticleCategory extends BaseModel
{
    use HasFactory;

    protected $fillable = [

        'parent_id',

        'name',

        'slug',

        'description',

        'icon',

        'sort_order',

        'is_active',

    ];

    protected $casts = [

        'is_active' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Parent category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Child categories.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('sort_order');
    }

    /**
     * Articles in this category.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Active categories only.
     */
  //  public function scopeActive($query)
  //  {
  //      return $query->where('is_active', true);
  //  }

    /**
     * Root categories only.
     */
 //   public function scopeRoot($query)
 //   {
 //       return $query->whereNull('parent_id');
 //   }

    /**
 * Returns the full category path.
 *
 * Example:
 * Medication > Rescue Medication
 */
public function getFullPathAttribute(): string
{
    return $this->name;
}




public function scopeActive(Builder $query): Builder
{
    return $query->where('is_active', true);
}

public function scopeRoot(Builder $query): Builder
{
    return $query->whereNull('parent_id');
}


}