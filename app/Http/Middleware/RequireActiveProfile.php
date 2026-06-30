<?php
// app/Http/Middleware/RequireActiveProfile.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequireActiveProfile
{
    /**
     * If the authenticated user's status is 'inactif', redirect them to
     * the profile completion page (except when they're already there,
     * on the profile update endpoint, or on logout).
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $allowedRoutes = ['profile.show', 'profile.update', 'profile.detect-gender', 'logout', 'profil.switch'];

            if ($user->status === 'inactif' && !in_array($request->route()->getName(), $allowedRoutes)) {
                return redirect()->route('profile.show')
                    ->with('info', 'Veuillez compléter votre profil pour continuer.');
            }
        }

        return $next($request);
    }
}