<?php
// app/Http/Controllers/Auth/ProfileController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function switch(Request $request)
    {
        $user = Auth::user();
        $user->profil = $user->profil == 1 ? 0 : 1;
        $user->save();

        $label = $user->profil == 1 ? 'Voyageur' : 'Local';

        return back()->with('success', "Vous êtes maintenant en mode {$label}.");
    }

    public function choose(Request $request)
    {
        $request->validate([
            'profil' => 'required|in:0,1',
        ]);

        $user = Auth::user();
        $user->profil = $request->profil;
        $user->profil_chosen = 1;
        $user->save();

        $label = $user->profil == 1 ? 'Voyageur' : 'Local';

        return back()->with('success', "Bienvenue ! Vous êtes en mode {$label}.");
    }
}