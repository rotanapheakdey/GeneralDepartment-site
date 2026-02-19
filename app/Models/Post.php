<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'category_id',
        'published_at',
    ];

    /**
     * Relationship: A post belongs to a category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Helper to get a clean excerpt for the news cards.
     */
    public function getExcerptAttribute(): string
    {
        return str($this->content)->stripTags()->limit(150);
    }
}
