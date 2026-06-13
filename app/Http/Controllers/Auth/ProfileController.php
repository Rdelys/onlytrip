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

        // Bascule : 1 -> 0, 0 -> 1
        $user->profil = $user->profil == 1 ? 0 : 1;
        $user->save();

        $label = $user->profil == 1 ? 'Voyageur' : 'Local';

        return back()->with('success', "Vous êtes maintenant en mode {$label}.");
    }
}