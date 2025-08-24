<?php
// filepath: app/Mail/ArticleShareMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;
use App\Models\User;

class ArticleShareMail extends Mailable
{
    use Queueable, SerializesModels;

    public $article;
    public $signedUrl;
    public $customMessage;
    public $sharedBy;

    public function __construct(Article $article, $signedUrl, $customMessage, User $sharedBy)
    {
        $this->article = $article;
        $this->signedUrl = $signedUrl;
        $this->customMessage = $customMessage;
        $this->sharedBy = $sharedBy->name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Knowledge Base Article: ' . $this->article->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.article-share',
            with: [
                'article' => $this->article,
                'user' => $this->sharedBy,
                'signedUrl' => $this->signedUrl,
                'message' => $this->customMessage,
            ]

        );
    }


}
