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
        if (! Gate::allows('canEditOrDelete', $article)) {
            abort(403);
        }

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

    public function downloadAttachments(Article $article)
{
    if (empty($article->attachments) || count($article->attachments) === 0) {
        abort(404, 'No attachments found');
    }

    $zip = new \ZipArchive();
    $zipFileName = 'article-' . $article->id . '-attachments.zip';
    $zipPath = storage_path('app/temp/' . $zipFileName);

    // Create temp directory if it doesn't exist
    if (!file_exists(storage_path('app/temp'))) {
        mkdir(storage_path('app/temp'), 0755, true);
    }

    if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
        foreach ($article->attachments as $attachment) {
            $filePath = storage_path('app/public/' . $attachment);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, basename($attachment));
            }
        }
        $zip->close();

        return response()->download($zipPath)->deleteFileAfterSend();
    }

    abort(500, 'Could not create zip file');
}
}
