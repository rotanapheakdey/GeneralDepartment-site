<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //

    protected $fillable=[
        'title',
        'document_type',
        'file_path',
        'description',
        'published_date',
    ];
}
