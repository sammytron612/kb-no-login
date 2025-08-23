<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function __construct()
    {
        Setting::getInstance();
    }

    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings', compact('settings'));
    }
}
