<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Livewire\Attributes\On;

class ArticleLatestComments extends Component
{
    public $article;

    public function render()
    {
        $comments = Comment::where('article_id', $this->article->id)
            ->latest()
            ->take(5)
            ->get();
        return view('livewire.article-latest-comments', compact('comments'));
    }

    #[On('latestComments')]
    public function refresh()
    {
        $this->render();
    }
}
