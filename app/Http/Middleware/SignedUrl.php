<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;

class SignedUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $settings = Setting::first();

        // If invites are disabled, allow all requests
        if (!$settings || !$settings->invites) {
            return $next($request);
        }

        // If invites are enabled, require valid signature
        if (!$request->hasValidSignature()) {
            Log::warning('Invalid registration attempt', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('login')
                ->with('error', 'This registration link has expired or is invalid. Please contact an administrator for a new invitation.');
        }

        return $next($request);
    }
}
