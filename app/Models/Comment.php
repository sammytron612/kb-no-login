<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function article()
    {
        return $this->belongsTo(\App\Models\Article::class);
    }
}
