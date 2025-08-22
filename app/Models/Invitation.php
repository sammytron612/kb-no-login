<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'message',
        'signed_url',
        'invited_by',
        'expires_at',
        'accepted_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    /**
     * Get the user who sent the invitation
     */
    public function invitedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    /**
     * Check if the invitation has expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if the invitation has been accepted
     */
    public function isAccepted(): bool
    {
        return !is_null($this->accepted_at);
    }

    /**
     * Check if the invitation is still active (not expired and not accepted)
     */
    public function isActive(): bool
    {
        return !$this->isExpired() && !$this->isAccepted();
    }

    /**
     * Mark the invitation as accepted
     */
    public function markAsAccepted(): void
    {
        $this->update(['accepted_at' => now()]);
    }

    /**
     * Get the status of the invitation
     */
    public function getStatusAttribute(): string
    {
        if ($this->isAccepted()) {
            return 'accepted';
        }

        if ($this->isExpired()) {
            return 'expired';
        }

        return 'pending';
    }

    /**
     * Get the status badge color for the invitation
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'accepted' => 'green',
            'expired' => 'red',
            'pending' => 'yellow',
            default => 'gray'
        };
    }

    /**
     * Get formatted expiration time
     */
    public function getExpiresInAttribute(): string
    {
        if ($this->isExpired()) {
            return 'Expired ' . $this->expires_at->diffForHumans();
        }

        return 'Expires ' . $this->expires_at->diffForHumans();
    }

    /**
     * Scope for active (non-expired, non-accepted) invitations
     */
    public function scopeActive($query)
    {
        return $query->whereNull('accepted_at')
                    ->where('expires_at', '>', now());
    }

    /**
     * Scope for expired invitations
     */
    public function scopeExpired($query)
    {
        return $query->whereNull('accepted_at')
                    ->where('expires_at', '<=', now());
    }

    /**
     * Scope for accepted invitations
     */
    public function scopeAccepted($query)
    {
        return $query->whereNotNull('accepted_at');
    }

    /**
     * Scope for pending invitations
     */
    public function scopePending($query)
    {
        return $query->whereNull('accepted_at')
                    ->where('expires_at', '>', now());
    }

    /**
     * Scope for invitations by a specific user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('invited_by', $userId);
    }

    /**
     * Scope for invitations to a specific email
     */
    public function scopeForEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Boot method to add model events
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invitation) {
            // Set default expiration if not provided
            if (!$invitation->expires_at) {
                $invitation->expires_at = now()->addHours(24);
            }
        });
    }

    /**
     * Check if a user can resend this invitation
     */
    public function canBeResent(): bool
    {
        return !$this->isAccepted();
    }

    /**
     * Check if a user can cancel this invitation
     */
    public function canBeCancelled(): bool
    {
        return !$this->isAccepted();
    }

    /**
     * Generate a new signed URL for this invitation
     */
    public function regenerateSignedUrl(): string
    {
        $signedUrl = \Illuminate\Support\Facades\URL::temporarySignedRoute(
            'register',
            now()->addHours(24),
            ['email' => $this->email]
        );

        $this->update([
            'signed_url' => $signedUrl,
            'expires_at' => now()->addHours(24)
        ]);

        return $signedUrl;
    }
}
