<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class EditArticleController extends Controller
{

    public function __construct($id)
    {
        $article = Article::findOrFail($id);
        if (! Gate::allows('canEdit', $article)) {
            abort(403);}
    }

    public function edit($id)
    {
        $sections = Section::all();

        return view('articles.edit', compact('article', 'sections'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        if($request->hasFile('attachments')) {

            $attachCount = (count($request->attachments)) + count($article->attachments);
        }
        else
        {
            $attachCount = count($article->attachments);
        }

        if ($attachCount > 3) {

            return redirect()->back()->withErrors(['attachments' => 'You can only have up to 3 attachements.']);
        }



        if ($request->hasFile('attachments')) {

            $attachmentPaths = $article->attachments;
            $this->handleAttachments($request->attachments);
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

        $article->body->where('article_id',$article->id)->update(['body' => $request->input('article_body')]);

        $article->title = $validated['title'];
        $article->tags = $validated['tags'];
        $article->sectionid = $validated['sectionId'];
        $article->scope = $validated['scope'];
        $article->published = $validated['published'];
        if($request->published) {
            $article->approved = auth()->user()->role === 1 ? true : false;
        }
        $article->expires = $validated['expires'];
        $article->attachments = $attachmentPaths;
        $article->save();

        return redirect()->route('articles.edit', $article->id)->with('success', 'Article updated successfully!');
    }

    private function handleAttachments($request->attachments)
    {
        foreach ($request->file('attachments') as $file) {
                $originalName = time() . "-" . $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $originalName, 'public');
                $attachmentPaths[] = $path;
            }
        }

        return $attachmentPaths;
    }
}
