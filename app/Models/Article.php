<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    /**
     * Scope for full-text search on articles and article_bodies.
     */
    public function scopeFullTextSearch(Builder $query, string $keyword): Builder
    {
        return $query
            ->join('article_bodies', 'article_bodies.article_id', '=', 'articles.id')
            ->where(function ($q) use ($keyword) {
                $q->whereRaw("MATCH(articles.title) AGAINST (? IN BOOLEAN MODE)", [$keyword])
                  ->orWhereRaw("MATCH(article_bodies.body) AGAINST (? IN BOOLEAN MODE)", [$keyword]);
            })

            ->where(function ($q) {
                    $q->whereNull('expires')
                    ->orWhere('expires', '>', now());
                })
            ->where('articles.approved',1)
            ->where('articles.published',1)
            ->select('articles.*')
            ->with('body');
    }
}


