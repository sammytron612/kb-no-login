<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class StatsController extends Controller
{
    public function index()
    {
    $topArticles = Article::orderByDesc('views')->limit(5)->get();
    $totalArticles = Article::count();
    $totalViews = Article::sum('views');
    $mostViewedArticle = Article::orderByDesc('views')->first();

    return view('stats.index', compact('topArticles', 'totalArticles', 'totalViews', 'mostViewedArticle'));
    }
}
