<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function show($id)
    {
        $article = Article::with('body')->findOrFail($id);
        $article->increment('views');

        return view('articles.show', compact('article'));
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if (! \Gate::allows('canEditOrDelete', $article)) {
            abort(403);
        }
        // Delete attachments from storage
        if (!empty($article->attachments)) {
            foreach ($article->attachments as $attachment) {
                \Storage::disk('public')->delete($attachment);
            }
        }
        $article->delete();
        return redirect()->route('dashboard')->with('success', 'Article deleted successfully.');
    }
}
