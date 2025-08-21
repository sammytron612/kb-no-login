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
use App\Models\User;

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
            'sectionid' => 'required|integer|exists:sections,id', // Fixed: lowercase 'sectionid'
            'attachments.*' => 'file|max:10240',
            'attachments' => 'array|max:3',
            'scope' => 'required',
            'published' => 'required',
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
            'sectionid' => $validated['sectionid'], // Fixed: use 'sectionid'
            'tags' => $validated['tags'] ? explode(',', $validated['tags']) : [],
            'attachments' => $attachmentPaths,
            'views' => 0,
            'attachCount' => count($attachmentPaths),
            'scope' => $validated['scope'],
            'images' => [],
            'rating' => 0,
            'approved' => Auth::user()->role === 1 ? true : false,
            'published' => $validated['published'],
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

        // Only send emails if article is published
        if ($validated['published'] == 1) {
            $this->emailUsers($article);
        }

        return redirect()->back()->with('success', 'Article created successfully!');
    }



    private function emailUsers($article)
    {
        $users = Auth::user()->otherUsers();

        if ($users->isEmpty()) {
            Log::info("No other users found to email for article: {$article->title}");
            return;
        }

        foreach ($users as $user) {
            try {
                Log::info("Attempting to send email to: {$user->email}");
                Mail::to($user->email)->send(new NewArticleNotification($article, $user));
                Log::info("Email sent to: {$user->email}");
            } catch (\Exception $e) {

                Log::error("Failed to send email to {$user->email}: " . $e->getMessage());
            }
        }
    }
}

