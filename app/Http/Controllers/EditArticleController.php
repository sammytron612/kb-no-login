<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Section;

class EditArticleController extends Controller
{
    public function edit($id)
    {

        $article = Article::findOrFail($id);
        $sections = Section::all();


        return view('articles.edit', compact('article', 'sections'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'sectionid' => 'required|integer',
            'scope' => 'required',
            'published' => 'required',
            'expires' => 'nullable|date',
            'article_body' => 'required|string',

        ]);
        $article->body->where('article_id',$article->id)->update(['body' => $request->input('article_body')]);

        $article->update($validated);


        return redirect()->route('articles.edit', $article->id)->with('success', 'Article updated successfully!');
    }
}
