<?php
// filepath: app/Models/Setting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invites',
        'full_text',
        'editors',
        'email_toggle',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'invites' => 'boolean',
        'full_text' => 'boolean',
        'editors' => 'boolean',
        'email_toggle' => 'boolean',
    ];

    /**
     * Get the singleton settings instance.
     * This ensures only one settings record exists.
     */
    public static function getInstance()
    {
        return static::firstOrCreate([]);
    }

    /**
     * Get a specific setting value.
     */
    public static function get(string $key, $default = null)
    {
        $settings = static::getInstance();
        return $settings->$key ?? $default;
    }

    /**
     * Set a specific setting value.
     */
    public static function set(string $key, $value)
    {
        $settings = static::getInstance();
        $settings->$key = $value;
        $settings->save();
        return $settings;
    }

    /**
     * Update multiple settings at once.
     */
    public static function updateSettings(array $data)
    {
        $settings = static::getInstance();
        $settings->update($data);
        return $settings;
    }

    /**
     * Get all settings as an array.
     */
    public static function getAll()
    {
        $settings = static::getInstance();
        return [
            'invites' => $settings->invites,
            'full_text' => $settings->full_text,
            'editors' => $settings->editors,
            'email_toggle' => $settings->email_toggle,
        ];
    }
}
