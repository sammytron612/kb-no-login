<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'kb',
        'title',
        'slug',
        'author',
        'author_name',
        'sectionid',
        'tags',
        'attachments',
        'views',
        'attachCount',
        'scope',
        'images',
        'rating',
        'approved',
        'published',
        'notify_sent',
        'expires',
    ];

    protected $casts = [
        'tags' => 'array',
        'attachments' => 'array',
        'images' => 'array',
        'approved' => 'boolean',
        'published' => 'boolean',
        'notify_sent' => 'boolean',
        'expires' => 'date',
    ];

    public function body()
    {
        return $this->hasOne(ArticleBody::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'sectionid', 'id');
    }

    public function authorUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'author');
    }
}
