<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\ArticleBody;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NewArticleNotification;

class CreateArticleController extends Controller
{
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
            'section' => 'required|int',
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
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filename = $originalName . "-" . time() . "." . $extension;
                $path = $file->storeAs('attachments', $filename, 'public');
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
            'approved' => Auth::user()->role === 1 ? true : false,
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

        // Only send emails if article is published and public
        if ($validated['status'] == 1 && $validated['scope'] == 1) {
            $this->emailUsers($article->id);
        }

        return redirect()->back()->with('success', 'Article created successfully!');
    }

    private function emailUsers($articleId)
    {
        try {
            // Get the article with its relationships
            $article = Article::with(['section', 'body'])->find($articleId);

            if (!$article) {
                Log::error("Article not found for email notification: ID {$articleId}");
                return;
            }

            // Get all users except the current user
            $users = Auth::user()->otherUsers();

            if ($users->isEmpty()) {
                Log::info("No other users found to email for article: {$article->title}");
                return;
            }

            $emailsSent = 0;
            $emailsFailed = 0;

            foreach ($users as $user) {
                try {
                    // Send email to each user
                    Mail::to($user->email)->send(new NewArticleNotification($article, $user));
                    $emailsSent++;

                    Log::info("Article notification sent to: {$user->email}", [
                        'article_id' => $article->id,
                        'article_title' => $article->title,
                        'recipient' => $user->email
                    ]);

                } catch (\Exception $e) {
                    $emailsFailed++;
                    Log::error("Failed to send article notification to: {$user->email}", [
                        'article_id' => $article->id,
                        'article_title' => $article->title,
                        'recipient' => $user->email,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Update the article to mark notifications as sent
            if ($emailsSent > 0) {
                $article->update(['notify_sent' => true]);
            }

            Log::info("Article notification summary", [
                'article_id' => $article->id,
                'article_title' => $article->title,
                'emails_sent' => $emailsSent,
                'emails_failed' => $emailsFailed,
                'total_users' => $users->count()
            ]);

        } catch (\Exception $e) {
            Log::error("Error in emailUsers method", [
                'article_id' => $articleId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
