<?php

namespace App\Traits;

use App\Models\Setting;

trait EmailsEnabled
{
    private $emailToggle;

    protected function getEmailToggle()
    {
        if ($this->emailToggle === null) {
            $this->emailToggle = Setting::getInstance()->email_toggle;
        }

        return $this->emailToggle;
    }

    protected function isEmailEnabled(): bool
    {
        return $this->getEmailToggle();
    }
}
