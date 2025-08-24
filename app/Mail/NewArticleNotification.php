<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;
use App\Models\User;

class NewArticleNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $article;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Article $article, User $user)
    {
        $this->article = $article;
        $this->user = $user;
        // Configure queue settings
        $this->onQueue('emails');
        $this->delay(now()->addSeconds(5)); // Optional delay
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Knowledge Base Article: ' . $this->article->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-article-notification',
            with: [
                'article' => $this->article,
                'user' => $this->user,
                'articleUrl' => route('articles.show', $this->article->id),
            ]
        );
    }

    public function failed(\Throwable $exception): void
    {
        \Log::error('New article notification email failed', [
            'article_id' => $this->article->id,
            'author_id' => $this->author->id,
            'error' => $exception->getMessage()
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
