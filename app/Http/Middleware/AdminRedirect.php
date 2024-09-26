<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, ...$guards): Response
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            if ($guard === 'admin') {
                return redirect()->route('admin.home'); // Redirection vers la page d'accueil admin
            }

            if ($guard === 'user') {
                return redirect()->route('user.home'); // Redirection vers la page d'accueil utilisateur
            }
        }
    }

    return $next($request);
}

}
