<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasUuids, InteractsWithMedia;

    protected $fillable = [
        'category_id', 'title', 'slug', 'content', 'excerpt', 'status', 'meta_data'
    ];

    protected $casts = [
        'meta_data' => 'array',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
