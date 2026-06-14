<?php
// app/Http/Controllers/Auth/GoogleController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserOnlytrap;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = UserOnlytrap::where('google_id', $googleUser->getId())
                ->orWhere('mail', $googleUser->getEmail())
                ->first();

        if ($user) {
            // Compte existant : on complète google_id si besoin
            if (!$user->google_id) {
                $user->google_id = $googleUser->getId();
            }
            $user->email_verified_at = $user->email_verified_at ?? now();
            $user->save();
        } else {
            // Nouveau compte : profil par défaut = 1 (voyageur), à confirmer ensuite
            $user = UserOnlytrap::create([
                'mail'              => $googleUser->getEmail(),
                'google_id'         => $googleUser->getId(),
                'profil'            => 1,
                'profil_chosen'     => 0,
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, true);

        if (!$user->profil_chosen) {
            return redirect('/')->with('choose_profile', true);
        }

        return redirect('/')->with('success', 'Connecté avec succès !');
    }
}