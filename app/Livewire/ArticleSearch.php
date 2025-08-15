<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;

class ArticleSearch extends Component
{
    use WithPagination;

    public $search="";

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {


        if (strlen($this->search) > 0) {
            $query = Article::query()->join('article_bodies', 'articles.id', '=', 'article_bodies.article_id')
                ->select('articles.*', 'article_bodies.body as article_body');

            if (!empty($this->search)) {
                $query->where(function ($q) {
                    $q->where('articles.title', 'like', '%' . $this->search . '%')
                      ->orWhere('articles.tags', 'like', '%' . $this->search . '%')
                      ->orWhere('article_bodies.body', 'like', '%' . $this->search . '%');
                });
            }

            $articles = $query->orderByDesc('articles.id')->paginate(10);
        } else {
            $articles = [];
        }




        return view('livewire.article-search', [
            'articles' => $articles
        ]);
    }
}
