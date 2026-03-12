<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    //
    use HasUuids, HasFactory;

    protected $fillable=[
        'title',
        'document_type',
        'file_path',
        'description',
        'published_date',
    ];
    protected $keyType = 'string';
    public $incrementing = false;
}
