<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasUuids;

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

    protected $appends = ['featured_image_url'];

    public function getFeaturedImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('featured_image');
    }
}
