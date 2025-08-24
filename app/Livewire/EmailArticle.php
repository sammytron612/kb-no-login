<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\ArticleShareMail;

class EmailArticle extends Component
{
    public $article;
    public $email = '';
    public $message = '';
    public $showModal = false;

    public function mount(Article $article)
    {
        $this->article = $article;
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->reset(['email', 'message']);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['email', 'message']);
    }

    public function sendEmail()
    {
        $this->validate([
            'email' => 'required|email',
            'message' => 'nullable|string|max:500',
        ]);

        // Generate signed URL that expires in 24 hours
        $signedUrl = URL::temporarySignedRoute(
            'articles.shared',
            now()->addHours(24),
            ['article' => $this->article->id]
        );

        // Send email
        Mail::to($this->email)->send(new ArticleShareMail(
            $this->article,
            $signedUrl,
            $this->message,
            auth()->user()
        ));

        // Close modal and show success
        $this->closeModal();
        $this->dispatch('email-sent', 'Article shared successfully!');
    }

    public function render()
    {
        return view('livewire.email-article');
    }
}
