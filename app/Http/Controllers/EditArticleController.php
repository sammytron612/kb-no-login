<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Section;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Gate;

class EditArticleController extends Controller
{
    public function __construct(
        private ArticleService $articleService
    ) {
        // No need to call parent::__construct() since base Controller is empty
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        if (! Gate::allows('canEdit', $article)) {
            abort(403);
        }

        $sections = Section::all();
        return view('articles.edit', compact('article', 'sections'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        // Check attachment count limit
        $existingAttachments = $article->attachments ?? [];
        $newAttachmentCount = $request->hasFile('attachments') ? count($request->file('attachments')) : 0;
        $totalAttachments = count($existingAttachments) + $newAttachmentCount;

        if ($totalAttachments > 3) {
            return redirect()->back()->withErrors(['attachments' => 'You can only have up to 3 attachments.']);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'sectionId' => 'required|integer',
            'scope' => 'required',
            'attachments.*' => 'file|max:10240',
            'published' => 'required',
            'expires' => 'nullable|date',
            'article_body' => 'required|string',
        ]);

        // Map sectionId to sectionid for consistency
        $validated['sectionid'] = $validated['sectionId'];
        unset($validated['sectionId']);

        $files = $request->hasFile('attachments') ? $request->file('attachments') : null;

        $article = $this->articleService->updateArticle($article, $validated, $files);

        return redirect()->route('articles.edit', $article->id)->with('success', 'Article updated successfully!');
    }
}
