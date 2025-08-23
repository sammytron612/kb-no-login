<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;
use App\Models\Setting;

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
            if($this->fullTextEnabled === true)
            {

                $articles = Article::fullTextSearch($this->search)->paginate(10);
            }
            else
            {
                $articles = Article::where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('tags', 'like', '%' . $this->search . '%')
                    ->paginate(10);
            }

        } else {
            $articles = [];
        }

        return view('livewire.article-search', [
            'articles' => $articles
        ]);
    }
}
