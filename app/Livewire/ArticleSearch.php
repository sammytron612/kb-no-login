<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;
use App\Models\Setting;
use App\Models\ArticleBody;

class ArticleSearch extends Component
{
    use WithPagination;

    public $search="";

    public $fullTextEnabled;

    public function mount()
    {
        $this->fullTextEnabled = Setting::get('full_text');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        if (strlen($this->search) > 2) {
            if(config('scout.enabled'))
            {

                $searchTerm = '*' . $this->search . '*';

                $articles = Article::search($this->search)
                    ->where('published', true)
                    ->where('approved', true)
                    ->paginate(10);

            }
            else
            {

                $articles = Article::fullTextSearch($this->search)->paginate(10);
            }

        } else {
            $articles = [];
        }

        return view('livewire.article-search', [
            'articles' => $articles
        ]);
    }
}
