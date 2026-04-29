<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasUuids, HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'category_id',
        'featured_image',
        'status',
        'published_at'
    ];
    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
        // First remove all <figure> tags (Trix attachments) so their text doesn't leak into the excerpt
        $cleanContent = preg_replace('/<figure\b[^>]*>.*?<\/figure>/is', '', $this->content);
        return str($cleanContent)->stripTags()->limit(150);
    }

    protected $appends = ['featured_image_url'];

    public function getFeaturedImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('featured_image');
    }
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
