<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSessionExpiration
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && $this->sessionHasExpired()) {
            Auth::logout();
            return redirect('/login')->with('status', 'Sesi Anda telah kadaluwarsa. Silakan login kembali.');
        }

        return $next($request);
    }

    private function sessionHasExpired()
    {
        $lastActivity = session('last_activity');

        if (!empty($lastActivity) && time() - $lastActivity > config('session.lifetime') * 60) {
            return true;
        }

        return false;
    }
}
