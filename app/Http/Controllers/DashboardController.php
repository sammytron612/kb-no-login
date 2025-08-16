<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\User;

class DashboardController extends Controller
{
   public function index()
    {
        //$topArticles = Article::orderByDesc('views')->limit(5)->get();
        $totalArticles = Article::count();
        $totalViews = Article::sum('views');
        $topAuthor = Article::orderByDesc('views')->pluck('author_name')->first();

        return view('dashboard', compact('topAuthor', 'totalArticles', 'totalViews'));
    }
}
