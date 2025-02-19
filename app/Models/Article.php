<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'content',
        'url',
        'image_url',
        'author',
        'source',
        'category',
        'published_at',
    ];
}
