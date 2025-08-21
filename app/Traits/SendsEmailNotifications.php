<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NewArticleNotification;

trait SendsEmailNotifications
{
    /**
     * Send email notifications to all users except the current user
     */

    private function emailUsers($article)
    {
        $users = Auth::user()->otherUsers();

        if ($users->isEmpty()) {
            Log::info("No other users found to email for article: {$article->title}");
            return;
        }

        foreach ($users as $user) {
            try {
                Log::info("Attempting to send email to: {$user->email}");
                Mail::to($user->email)->send(new NewArticleNotification($article, $user));
                Log::info("Email sent to: {$user->email}");
            } catch (\Exception $e) {

                Log::error("Failed to send email to {$user->email}: " . $e->getMessage());
            }
        }
    }
}
