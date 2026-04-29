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
        'published_at',
        'created_by',      // Added for tracking
        'last_updated_by'  // Added for tracking
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
     * Relationship: Tracking who created the post.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship: Tracking who last updated the post.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    /**
     * Automatic User Stamping
     */
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->created_by = auth()->id();
            $post->last_updated_by = auth()->id();
        });

        static::updating(function ($post) {
            $post->last_updated_by = auth()->id();
        });
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
