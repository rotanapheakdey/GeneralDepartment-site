<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Document extends Model
{
    //
    use HasUuids;

    protected $fillable=[
        'title',
        'document_type',
        'file_path',
        'description',
        'published_date',
    ];
}
