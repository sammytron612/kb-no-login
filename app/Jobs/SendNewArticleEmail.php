<?php
// filepath: app/Jobs/SendNewArticleEmail.php

namespace App\Jobs;

use App\Mail\NewArticleMail;
use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewArticleEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 60;
    public $deleteWhenMissingModels = true;

    public function __construct(
        public Article $article,
        public User $user
    ) {
        $this->onQueue('emails');
        $this->delay(now()->addSeconds(5)); // Small delay
    }

    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new NewArticleMail($this->article, $this->user));
        } catch (\Exception $e) {
            // Re-throw to trigger retry
            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        \Log::error('Failed to send new article email', [
            'article_id' => $this->article->id,
            'user_email' => $this->user->email,
            'error' => $exception->getMessage()
        ]);
    }

    public function backoff(): array
    {
        return [30, 120, 300]; // Retry after 30s, 2min, 5min
    }
}
