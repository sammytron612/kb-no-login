<?php

namespace App\Traits;

use App\Models\Setting;

trait EmailsEnabled
{
    private $emailToggle;

    public function __construct()
    {
        $this->emailToggle = Setting::getInstance()->email_toggle;

        // Call parent constructor if it exists
        if (method_exists(parent::class, '__construct')) {
            parent::__construct();
        }
    }
}
