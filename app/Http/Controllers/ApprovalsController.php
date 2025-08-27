<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Services\ArticleApprovalService;
use Illuminate\Support\Facades\Log;

class ApprovalsController extends Controller
{
    public function __construct(
        private ArticleApprovalService $approvalService
    ) {
        // No need to call parent::__construct() since base Controller is empty
    }

    public function index($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.approval-show', compact('article'));
    }

    public function approve($id)
    {
        try {
            $article = Article::with('authorUser')->findOrFail($id);

            $this->approvalService->approveArticle($article);

            return redirect()->route('admin.approvals')->with('success', 'Article approved and author notified!');

        } catch (\Exception $e) {
            Log::error('Error approving article: ' . $e->getMessage(), [
                'article_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('admin.approvals')->with('error', 'Error approving article. Please try again.');
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $reason = $request->rejection_reason;

            $this->approvalService->rejectArticle($article, $reason);

            return redirect()->route('admin.approvals')->with('success', 'Article rejected and author notified!');

        } catch (\Exception $e) {
            Log::error('Error rejecting article: ' . $e->getMessage(), [
                'article_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('admin.approvals')->with('error', 'Error rejecting article. Please try again.');
        }
    }
}
