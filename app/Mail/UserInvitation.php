<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserInvitation extends Mailable
{
    use Queueable, SerializesModels;

    // Avoid conflicts with Laravel's built-in properties
    public string $userEmail;
    public ?string $userName;
    public ?string $personalMessage;
    public string $registrationUrl;
    public User $sender;

    public function __construct(string $email, ?string $name, ?string $message, string $signedUrl, User $invitedBy)
    {
        $this->userEmail = $email;
        $this->userName = $name;
        $this->personalMessage = $message;
        $this->registrationUrl = $signedUrl;
        $this->sender = $invitedBy;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 You\'re invited to join our Knowledge Base!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user-invitation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
