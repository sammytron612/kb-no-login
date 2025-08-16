<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleStatsController extends Controller
{
    public function mostViewed()
    {
        $articles = Article::orderByDesc('views')
            ->select('title', 'views')
            ->limit(5)
            ->get();
        return response()->json($articles);
    }
}
