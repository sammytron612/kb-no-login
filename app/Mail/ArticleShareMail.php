<?php
// filepath: app/Mail/ArticleShareMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
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
        $this->sharedBy = $sharedBy;
    }

    public function build()
    {
        return $this->subject('Knowledge Base Article: ' . $this->article->title)
                    ->view('emails.article-share');
    }
}
