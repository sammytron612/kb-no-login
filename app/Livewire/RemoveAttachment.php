<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class RemoveAttachment extends Component
{
    public $attachment;
    public $articleId;
    public $attachmentIndex;


    public function removeAttachment()
    {

        $article = Article::find($this->articleId);

        // Remove from storage
        if ($this->attachment && \Storage::disk('public')->exists($this->attachment)) {
            \Storage::disk('public')->delete($this->attachment);
        }
        // Remove from article model
        if ($article && is_array($article->attachments)) {
            $attachments = $article->attachments;
            $attachments = array_filter($attachments, fn($a) => $a !== $this->attachment);
            $article->attachments = $attachments;
            $article->save();
        }
        $this->dispatch('attachmentRemoved', ['attachmentIndex' => $this->attachmentIndex] );
    }

    public function render()
    {
        return view('livewire.remove-attachment');
    }
}
