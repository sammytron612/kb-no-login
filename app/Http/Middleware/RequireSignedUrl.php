<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequireSignedUrl
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasValidSignature()) {
            Log::warning('Invalid registration attempt', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);

            return redirect()->route('login')
                ->with('error', 'This registration link has expired or is invalid. Please contact an administrator for a new invitation.');
        }

        return $next($request);
    }
}
