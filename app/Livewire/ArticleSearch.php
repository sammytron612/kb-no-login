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
            $articles = Article::fullTextSearch($this->search)->paginate(10);

        } else {
            $articles = [];
        }




        return view('livewire.article-search', [
            'articles' => $articles
        ]);
    }
}
