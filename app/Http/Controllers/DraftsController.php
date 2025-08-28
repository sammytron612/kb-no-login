<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class DraftsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $drafts = Article::where('author', 10003)
            ->where('published', 0)
            ->get();

        return view('drafts.index', compact('drafts'));
    }
}
