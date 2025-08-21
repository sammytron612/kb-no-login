<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ArticleApprovedNotification;
use App\Traits\SendsEmailNotifications;

class ApprovalsController extends Controller
{
    use SendsEmailNotifications;

    public function index($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.approval-show', compact('article'));
    }

    public function approve($id)
    {
        try {
            $article = Article::with('author')->findOrFail($id);

            // Update article status
            $article->approved = 1;
            $article->save();

            // Send email to author
            $this->sendApprovalEmail($article);

            // sends new article email to users uses SendsEmailNotifications trait
            $this->emailUsers($article);

            return redirect()->route('admin.approvals')->with('success', 'Article approved and author notified!');

        } catch (\Exception $e) {
            Log::error('Error approving article: ' . $e->getMessage(), [
                'article_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('admin.approvals')->with('error', 'Error approving article. Please try again.');
        }
    }

    public function reject($id)
    {
        try {
            $article = Article::with('author')->findOrFail($id);

            // Update article status
            $article->published = 0;
            $article->save();

            // Send rejection email to author
            $this->sendRejectionEmail($article);

            return redirect()->route('admin.approvals')->with('success', 'Article rejected and author notified!');

        } catch (\Exception $e) {
            Log::error('Error rejecting article: ' . $e->getMessage(), [
                'article_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('admin.approvals')->with('error', 'Error rejecting article. Please try again.');
        }
    }

    private function sendApprovalEmail($article)
    {
        try {
            // Get the author user
            $author = \App\Models\User::find($article->author);

            if (!$author || !$author->email) {
                Log::warning('Cannot send approval email - author not found or no email', [
                    'article_id' => $article->id,
                    'author_id' => $article->author
                ]);
                return;
            }

            // Send approval email
            Mail::to($author->email)->send(new ArticleApprovedNotification($article, $author));

            Log::info('Approval email sent successfully', [
                'article_id' => $article->id,
                'article_title' => $article->title,
                'author_email' => $author->email
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send approval email', [
                'article_id' => $article->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    private function sendRejectionEmail($article)
    {
        try {
            // Get the author user
            $author = \App\Models\User::find($article->author);

            if (!$author || !$author->email) {
                Log::warning('Cannot send rejection email - author not found or no email', [
                    'article_id' => $article->id,
                    'author_id' => $article->author
                ]);
                return;
            }

            // Send rejection email
            Mail::to($author->email)->send(new \App\Mail\ArticleRejectedNotification($article, $author));

            Log::info('Rejection email sent successfully', [
                'article_id' => $article->id,
                'article_title' => $article->title,
                'author_email' => $author->email
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send rejection email', [
                'article_id' => $article->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
