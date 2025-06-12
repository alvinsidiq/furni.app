<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'content', 'author', 'published_at', 'image'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
