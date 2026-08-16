<?php

namespace App\Models;

use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use LogsActivity;

    use HasFactory;

    protected $fillable = [
        'slug',
        'title_en',
        'title_km',
        'content_en',
        'content_km',
        'timeline_data',
        'units_data',
        'portfolio_data',
    ];

    protected $casts = [
        'timeline_data' => 'array',
        'units_data' => 'array',
        'portfolio_data' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
