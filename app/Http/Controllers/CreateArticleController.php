<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\ArticleBody;
use Illuminate\Support\Facades\Auth;

class CreateArticleController extends Controller
{
    public function show()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'section' => 'required|string',
            'attachments.*' => 'file|max:10240',
            'attachments' => 'array|max:3',
            'scope' => 'required',
            'status' => 'required',
            'article_body' => 'required|string',
            'expires' => 'nullable|date',

        ]);

        $attachmentPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $originalName = $file->getClientOriginalName();
                $originalName = Str::slug($originalName, '-') . '-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('attachments', $originalName, 'public');
                $attachmentPaths[] = $path;
            }
        }

        $article = Article::create([
            'title' => $validated['title'],
            'author' => Auth::id(),
            'author_name' => Auth::user()->name ?? '',
            'sectionid' => $validated['section'],
            'tags' => $validated['tags'] ? explode(',', $validated['tags']) : [],
            'attachments' => $attachmentPaths,
            'views' => 0,
            'attachCount' => count($attachmentPaths),
            'scope' => $validated['scope'],
            'images' => [],
            'rating' => 0,
            'approved' => false,
            'published' => $validated['status'],
            'notify_sent' => false,
            'expires' => $validated['expires'] ?? null,
        ]);

        $article->update([
            'kb' => "kb" . rand(100,999) . $article->id,
            'slug' => Str::of($validated['title'])->slug('-') . "-" . $article->id
        ]);

        ArticleBody::create([
            'article_id' => $article->id,
            'body' => $validated['article_body'],
        ]);

        return redirect()->back()->with('success', 'Article created successfully!');
    }
}
