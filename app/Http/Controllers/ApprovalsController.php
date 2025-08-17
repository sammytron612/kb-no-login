<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ApprovalsController extends Controller
{
    public function index($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.approval-show', compact('article'));
    }

    public function approve($id)
    {

        $article = Article::findOrFail($id);

        $article->approved = 1;
        $article->save();

        return redirect()->route('admin.approvals')->with('success', 'Article Approved!');
    }


    public function reject($id)
    {
        $article = Article::findOrFail($id);
        $article->published = 0;
        $article->save();
        return redirect()->route('admin.approvals')->with('success', 'Article Rejected!');
    }
}
