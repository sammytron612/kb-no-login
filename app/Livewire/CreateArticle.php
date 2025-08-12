<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\ArticleBody;

class CreateArticle extends Component
{
    use WithFileUploads;

    public $title;
    public $tags;
    public $section;
    public $attachments = [];
    public $scope = 0;
    public $status = 1;
    public $body;
    public $expires;

    protected $rules = [
        'title' => 'required|string|max:255',
        'tags' => 'nullable|string',
        'section' => 'required|string',
        'attachments.*' => 'file|max:10240',
        'scope' => 'required',
        'status' => 'required',
        'body' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        $attachmentPaths = [];
        if (is_array($this->attachments)) {
            foreach ($this->attachments as $file) {
                if ($file) {
                    $originalName = $file->getClientOriginalName();
                    $originalName = Str::slug($originalName, '-') . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('attachments', $originalName, 'public');
                    $attachmentPaths[] = $path;
                }
            }
        }

        $article = Article::create([
            'title' => $this->title,
            'author' => auth()->id(),
            'author_name' => auth()->user()->name ?? '',
            'sectionid' => $this->section,
            'tags' => $this->tags ? explode(',', $this->tags) : [],
            'attachments' => $attachmentPaths,
            'views' => 0,
            'attachCount' => count($attachmentPaths),
            'scope' => $this->scope,
            'images' => [],
            'rating' => 0,
            'approved' => false,
            'published' => $this->status,
            'notify_sent' => false,
            'expires' => $this->expires,

        ]);

        $article->update([
            'kb' => "kb100" . $article->id,
            'slug' => Str::of($this->title)->slug('-') . "-" . $article->id
        ]);

        $article->save();

        $body = ArticleBody::create([
            'article_id' => $article->id,
            'body' => $this->body,
        ]);



        session()->flash('success', 'Article created successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.create-article');
    }
}
