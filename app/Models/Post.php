<?php

namespace App\Models;

use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Post extends Model implements HasMedia
{
    use LogsActivity;
    use InteractsWithMedia;
    use HasUuids, HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'featured_image',
        'status',
        'workflow_status',
        'is_breaking',
        'is_featured',
        'is_pinned',
        'read_time',
        'source_credit',
        'views_count',
        'seo_title',
        'seo_description',
        'published_at',
        'scheduled_at',
        'created_by',
        'last_updated_by',
    ];

    protected $casts = [
        'published_at'  => 'datetime',
        'scheduled_at'  => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'is_breaking'   => 'boolean',
        'is_featured'   => 'boolean',
        'is_pinned'     => 'boolean',
        'views_count'   => 'integer',
        'read_time'     => 'integer',
    ];

    // === Relationships ===

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    // === Lifecycle Hooks ===

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (auth()->check()) {
                $post->created_by = auth()->id();
                $post->last_updated_by = auth()->id();
            }
            $post->slug = $post->generateUniqueSlug($post->title);
            $post->read_time = $post->calculateReadTime($post->content ?? '');
        });

        static::updating(function (Post $post) {
            if (auth()->check()) {
                $post->last_updated_by = auth()->id();
            }
            // Regenerate slug only if title changed and slug is empty/null
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = $post->generateUniqueSlug($post->title);
            }
            // Recalculate read_time when content changes
            if ($post->isDirty('content')) {
                $post->read_time = $post->calculateReadTime($post->content ?? '');
            }
        });
    }

    // === Scopes ===

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeBreaking(Builder $query): Builder
    {
        return $query->where('is_breaking', true)->published();
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->published();
    }

    // === Computed Attributes ===

    protected $appends = ['featured_image_url'];

    public function getFeaturedImageUrlAttribute(): ?string
    {
        // Priority 1: Spatie Media Library - 'featured_image' collection
        if ($this->relationLoaded('media')) {
            $media = $this->getMedia('featured_image')->first()
                ?? $this->getMedia('posts')->first();
            if ($media) {
                return $media->getUrl();
            }
        } else {
            $url = $this->getFirstMediaUrl('featured_image');
            if ($url) return $url;
            $url = $this->getFirstMediaUrl('posts');
            if ($url) return $url;
        }

        // Priority 2: External URL stored in DB column
        $dbImage = $this->attributes['featured_image'] ?? null;
        if ($dbImage && filter_var($dbImage, FILTER_VALIDATE_URL)) {
            return $dbImage;
        }

        return $dbImage ?: null;
    }

    public function getExcerptAttribute(): string
    {
        if (!empty($this->attributes['excerpt'])) {
            return $this->attributes['excerpt'];
        }
        $cleanContent = preg_replace('/<figure\b[^>]*>.*?<\/figure>/is', '', $this->content ?? '');
        return (string) str($cleanContent)->stripTags()->limit(200);
    }

    public function getReadableReadTimeAttribute(): string
    {
        $mins = $this->read_time ?? 1;
        return $mins . ' min read';
    }

    public function getEffectiveSeoTitleAttribute(): string
    {
        return $this->seo_title ?: $this->title;
    }

    public function getEffectiveSeoDescriptionAttribute(): string
    {
        return $this->seo_description ?: $this->excerpt;
    }

    // === Helpers ===

    public function generateUniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        if (empty($base)) {
            $base = 'post-' . substr($this->id ?? Str::uuid(), 0, 8);
        }

        $slug = $base;
        $counter = 1;
        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    public function calculateReadTime(string $content): int
    {
        $plainText = strip_tags($content);
        $wordCount = str_word_count($plainText);
        return max(1, (int) ceil($wordCount / 200));
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
