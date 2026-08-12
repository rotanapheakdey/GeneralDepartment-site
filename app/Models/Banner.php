<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title_en',
        'title_km',
        'link',
        'order',
        'is_active',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('banners') ?: null;
    }
}
