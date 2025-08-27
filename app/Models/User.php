<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'notifications',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
             'status' => 'boolean',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get all users except the current user
     */
    public function otherUsers()
    {
        return User::where('id', '!=', $this->id)->get();
    }
    /**
     * Check if user is disabled
     */
    public function getIsDisabledAttribute()
    {
        return $this->role === 0 || $this->status === false;
    }

    public function getRoleNameAttribute()
    {
        $roles = [
            0 => 'Disabled',
            1 => 'Admin',
            2 => 'Editor',
            3 => 'Viewer'
        ];
    }

    public function isAdmin()
    {
        return $this->role === 1 && $this->status === true;
    }

    /**
     * Check if user is editor
     */
    public function isEditor()
    {
        return $this->role === 2 && $this->status === true;
    }


    public function isViewer()
    {
        return $this->role === 3 && $this->status === true;
    }

    /**
     * Check if user can access system
     */
    public function canAccess()
    {
        return $this->status === true;
    }


    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class, 'author');
    }


}
