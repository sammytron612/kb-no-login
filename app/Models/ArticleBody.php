<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ArticleBody extends Model
{
    use HasFactory,Searchable;

    public $timestamps = false;

    protected $fillable = [
        'article_id',
        'body',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
