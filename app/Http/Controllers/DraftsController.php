<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class DraftsController extends Controller
{
    public function index()
    {

        $drafts = Article::where('published', 0)->where('author', auth()->id())->orderByDesc('id')->get();
        return view('articles.drafts', compact('drafts'));
    }
}
