<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AdminAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($request->routeIs('admin.*')) {
                session()->flash('fail', 'You must log in first');
                return route('admin.login'); // Rediriger vers la route d'authentification admin
            }

            if ($request->routeIs('user.*')) {
                session()->flash('fail', 'You must log in first');
                return route('user.login'); // Rediriger vers la route d'authentification utilisateur
            }
        }

        // Si la requête est JSON ou si aucune condition n'est satisfaite, retourner null
        return null;
    }
}
