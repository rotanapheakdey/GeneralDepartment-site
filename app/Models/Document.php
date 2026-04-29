<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'title',
        'document_type',
        'file_path',
        'description',
        'published_date',
        'created_by',
        'last_updated_by'
    ];

    // THIS IS THE MOST IMPORTANT LINE
    protected $appends = ['file_url', 'preview_url'];

    protected $keyType = 'string';
    public $incrementing = false;

    public function getPreviewUrlAttribute()
    {
        return $this->id ? route('documents.preview', $this->id) : null;
    }

    public function getFileUrlAttribute()
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    protected static function booted()
    {
        static::creating(fn($doc) => $doc->created_by = $doc->last_updated_by = auth()->id());
        static::updating(fn($doc) => $doc->last_updated_by = auth()->id());
    }
}
