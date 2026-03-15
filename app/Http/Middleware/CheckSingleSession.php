<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSingleSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = $request->session()->getId();

            // If stored session id and current session id do not match,
            // it means user logged in somewhere else
            if ($user->current_session_id && $user->current_session_id !== $currentSessionId) {
                ActivityLog::create([
                    'user_id' => $user->id,
                    'action' => 'session_ended',
                    'description' => 'Previous session was ended because of a new login.',
                    'ip_address' => $request->ip(),
                ]);

                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('error', 'Your account was logged in from another device.');
            }
        }

        return $next($request);
    }
}