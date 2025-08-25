<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class EditArticleController extends Controller
{
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

        // Initialize attachment paths with existing attachments
        $attachmentPaths = $article->attachments ?? [];

        if($request->hasFile('attachments')) {
            $attachCount = count($request->file('attachments')) + count($attachmentPaths);
        } else {
            $attachCount = count($attachmentPaths);
        }

        if ($attachCount > 3) {
            return redirect()->back()->withErrors(['attachments' => 'You can only have up to 3 attachments.']);
        }

        // Handle new attachments if they exist
        if ($request->hasFile('attachments')) {
            $newAttachments = $this->handleAttachments($request->file('attachments')); // ✅ Pass the files directly
            $attachmentPaths = array_merge($attachmentPaths, $newAttachments); // ✅ Merge with existing
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

        // Update article body
        $article->body()->update(['body' => $request->input('article_body')]);

        // Update article with Scout-safe method
        Article::withoutSyncingToSearch(function () use ($article, $validated, $attachmentPaths, $request) {
            $article->update([
                'title' => $validated['title'],
                'tags' => explode(',', $validated['tags'] ?? ''),
                'sectionid' => $validated['sectionId'],
                'scope' => $validated['scope'],
                'published' => $validated['published'],
                'approved' => $request->published ? (auth()->user()->role === 1) : $article->approved,
                'expires' => $validated['expires'],
                'attachments' => $attachmentPaths,
            ]);
        });

        // Manually sync to Scout after both article and body are updated
        if (config('scout.enabled') && $article->shouldBeSearchable()) {
            $article->searchable();
        }

        return redirect()->route('articles.edit', $article->id)->with('success', 'Article updated successfully!');
    }

    private function handleAttachments($files) // ✅ Changed parameter name for clarity
    {
        $attachmentPaths = []; // ✅ Initialize the array

        foreach ($files as $file) { // ✅ Now iterating over the files directly
            $originalName = time() . "-" . $file->getClientOriginalName();
            $path = $file->storeAs('attachments', $originalName, 'public');
            $attachmentPaths[] = $path;
        }

        return $attachmentPaths;
    }
}
