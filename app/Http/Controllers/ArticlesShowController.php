<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesShowController extends Controller
{
    public function show($id)
    {
        $article = Article::with('body')->findOrFail($id);
        return view('articles.show', compact('article'));
    }
}
