<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasSubordinates
{
    /**
     * Handle an incoming request.
     * Only allow users who have subordinates (can verify logs)
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|null $user */
        $user = Auth::user();
        
        if (!Auth::check() || !$user || !$user->hasSubordinates()) {
            abort(403, 'Anda tidak memiliki akses ke halaman verifikasi.');
        }

        return $next($request);
    }
}
