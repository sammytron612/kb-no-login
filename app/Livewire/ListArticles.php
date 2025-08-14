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
        $articles = \App\Models\Article::with('section')->latest()->paginate(10);
        return view('livewire.list-articles', compact('articles'));
    }
}
