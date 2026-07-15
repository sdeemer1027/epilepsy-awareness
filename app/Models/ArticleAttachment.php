<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ArticleAttachment extends BaseModel
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [

        'article_id',

        'title',

        'file_name',

        'original_file_name',

        'mime_type',

        'file_size',

        'disk',

        'file_path',

        'description',

        'is_downloadable',

        'download_count',

        'is_active',

        'created_by_user_id',

    ];

    /**
     * Attribute casting.
     */
    protected $casts = [

        'is_downloadable' => 'boolean',

        'is_active'       => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Parent article.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Human readable size.
     */
    public function getHumanFileSizeAttribute(): string
    {
        $bytes = $this->file_size;

        if ($bytes >= 1073741824) {
            return round($bytes / 1073741824, 2) . ' GB';
        }

        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' MB';
        }

        if ($bytes >= 1024) {
            return round($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' Bytes';
    }

    /**
     * Public download URL.
     */
    public function getDownloadUrlAttribute(): string
    {
        return Storage::disk($this->disk)
            ->url($this->file_path);
    }

    /**
     * Is Image?
     */
    public function getIsImageAttribute(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Is PDF?
     */
    public function getIsPdfAttribute(): bool
    {
        return $this->mime_type === 'application/pdf';
    }

    /**
     * Is Video?
     */
    public function getIsVideoAttribute(): bool
    {
        return str_starts_with($this->mime_type, 'video/');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function incrementDownloads(): void
    {
        $this->increment('download_count');
    }

    public function getIconAttribute(): string
    {
        return match (true) {

        $this->getIsPdfAttribute() => 'file-pdf',

        $this->getIsImageAttribute() => 'image',

        $this->getIsVideoAttribute() => 'video',

        default => 'file',
    };
}
}