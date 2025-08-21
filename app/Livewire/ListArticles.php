<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;

class ListArticles extends Component
{
    use WithPagination;

    public function render()
    {
        $articles = Article::where(function ($q) {
                    $q->whereNull('expires')
                    ->orWhere('expires', '>', now());
                })
            ->where('articles.approved',1)
            ->where('articles.published',1)
            ->with('section')->latest()->paginate(10);

        return view('livewire.list-articles', compact('articles'));
    }
}
