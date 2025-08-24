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


    public string $userEmail;
    public ?string $userName;
    public ?string $personalMessage;
    public string $registrationUrl;
    public User $invitedBy;

    public function __construct(string $email, ?string $name, ?string $message, string $signedUrl, User $invitedBy)
    {
        $this->userEmail = $email;
        $this->userName = $name;
        $this->personalMessage = $message;
        $this->registrationUrl = $signedUrl;
        $this->sender = $invitedBy->name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You are invited to join our Knowledge Base!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.user-invitation',
            with: [
                'user' => $this->userName,
                'invitedBy' => $this->sender,
                'message' => $this->personalMessage,
                'registrationURL' => $this->registrationUrl
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
