<?php
// app/Http/Controllers/Auth/ProfileController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // ── Profile switcher ────────────────────────────────────────────────────
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
        $request->validate(['profil' => 'required|in:0,1']);

        $user = Auth::user();
        $user->profil = $request->profil;
        $user->profil_chosen = 1;
        $user->save();

        $label = $user->profil == 1 ? 'Voyageur' : 'Local';
        return back()->with('success', "Bienvenue ! Vous êtes en mode {$label}.");
    }

    // ── Show profile page ────────────────────────────────────────────────────
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // ── Update profile ───────────────────────────────────────────────────────
    // NOTE: 'sexe' n'est jamais accepté ici. Il est défini uniquement par
    // detectGender() ci-dessous, pour empêcher toute usurpation/déclaration
    // manuelle du sexe.
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'nom'                => 'nullable|string|max:100',
            'prenom'             => 'nullable|string|max:100',
            'pseudo'             => 'nullable|string|max:80|unique:user_onlytrap,pseudo,' . $user->id,
            'date_naissance'     => 'nullable|date|before:today',
            'telephone'          => 'nullable|string|max:30',
            'centres_interet'    => 'nullable|array',
            'centres_interet.*'  => 'string|in:Aventure / Découverte,Culture,Culinaire,Randonnée / Nature,Famille,Road Trips,Sport,Spirituel,Plage,Animaux,Autres',
            'photo_profil'       => 'nullable|image|max:4096',
        ];

        if ($user->profil == 0) {
            $rules['bio'] = 'nullable|string|max:1000';
        }

        $validated = $request->validate($rules);

        // Handle photo upload
        if ($request->hasFile('photo_profil')) {
            if ($user->photo_profil) {
                Storage::disk('public')->delete($user->photo_profil);
            }
            $path = $request->file('photo_profil')->store('photos_profil', 'public');
            $validated['photo_profil'] = $path;
        } else {
            unset($validated['photo_profil']);
        }

        $user->fill($validated);
        $user->save();

        // Auto-update status based on completeness
        $user->status = $user->isProfileComplete() ? 'actif' : 'inactif';
        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès !');
    }

    // ── Face gender detection (server-side proxy to avoid CORS) ──────────────
    // Seul point d'entrée qui peut écrire la colonne `sexe`. Le résultat
    // DeepFace est enregistré directement en base — l'utilisateur ne peut
    // pas le modifier manuellement, ce qui empêche l'usurpation de sexe.
    public function detectGender(Request $request)
    {
        $request->validate(['image' => 'required|image|max:2048']);

        $user = Auth::user();
        $imageData = base64_encode(file_get_contents($request->file('image')->path()));

        try {
            $response = Http::timeout(15)->post(
                config('services.deepface.url', 'http://localhost:8001/analyze'),
                ['image_b64' => $imageData]
            );

            if ($response->successful()) {
                $gender = strtolower($response->json('dominant_gender') ?? '');
                $map = ['man' => 'homme', 'woman' => 'femme'];
                $sexe = $map[$gender] ?? null;

                if ($sexe) {
                    $user->sexe = $sexe;
                    $user->status = $user->isProfileComplete() ? 'actif' : 'inactif';
                    $user->save();

                    return response()->json(['sexe' => $sexe]);
                }
            }
        } catch (\Throwable $e) {
            // Service indisponible
        }

        return response()->json([
            'sexe'  => null,
            'error' => 'Détection impossible. Réessayez avec une photo de visage plus nette.',
        ], 200);
    }
}