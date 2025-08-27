<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;

class CreateArticleController extends Controller
{
    public function __construct(
        private ArticleService $articleService
    ) {
        // No need to call parent::__construct() since base Controller is empty
    }

    public function show()
    {
        $sections = \App\Models\Section::all();
        return view('articles.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'sectionid' => 'required|integer|exists:sections,id',
            'attachments.*' => 'file|max:10240',
            'attachments' => 'array|max:3',
            'scope' => 'required',
            'published' => 'required',
            'article_body' => 'required|string',
            'expires' => 'nullable|date',
        ]);

        $files = $request->hasFile('attachments') ? $request->file('attachments') : null;

        $article = $this->articleService->createArticle($validated, $files);

        return redirect()->back()->with('success', 'Article created successfully!');
    }
}

