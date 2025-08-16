<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ArticleFeedback extends Component
{
    public $article;
    public $rating = 0;
    public $comment = '';
    public $success = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ];

    public function submitFeedback()
    {
        $this->validate();
        $userId = Auth::id();
        // Prevent multiple comments per user per article
        $alreadyCommented = Comment::where('article_id', $this->article->id)
            ->where('user_id', $userId)
            ->exists();
        if ($alreadyCommented) {
            $this->addError('comment', 'You have already commented on this article.');
            return;
        }
        // Save comment
        Comment::create([
            'article_id' => $this->article->id,
            'user_id' => $userId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);
        // Optionally update article rating
        $this->article->rating = Comment::where('article_id', $this->article->id)->avg('rating');
        $this->article->save();
        $this->success = true;
        $this->reset('rating', 'comment');


    $this->dispatch('latestComments');

    }

    public function render()
    {
        return view('livewire.article-feedback');
    }
}
