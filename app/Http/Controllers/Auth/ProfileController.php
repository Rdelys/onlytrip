<?php
// app/Http/Controllers/Auth/ProfileController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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

        $user->status = $user->isProfileComplete() ? 'actif' : 'inactif';
        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès !');
    }

    // ── Face gender detection — caméra en direct uniquement ──────────────────
    public function detectGender(Request $request)
    {
        $request->validate(['image' => 'required|image|max:3072']);

        $user = Auth::user();
        $imageData = base64_encode(file_get_contents($request->file('image')->path()));

        $deepfaceUrl = config('services.deepface.url', 'http://127.0.0.1:8001/analyze');

        try {
            $response = Http::timeout(20)->post($deepfaceUrl, [
                'image_b64' => $imageData,
            ]);

            // ── LOG TEMPORAIRE DE DEBUG ──────────────────────────────────────
            // À retirer une fois le problème identifié. Regardez
            // storage/logs/laravel.log après chaque tentative.
            Log::info('DeepFace response', [
                'url'              => $deepfaceUrl,
                'http_status'      => $response->status(),
                'successful'       => $response->successful(),
                'body'             => $response->body(),
            ]);
            // ───────────────────────────────────────────────────────────────

            if ($response->successful()) {
                $json = $response->json();

                // Le microservice peut retourner une erreur interne avec un 200
                if (isset($json['error'])) {
                    return response()->json([
                        'sexe'  => null,
                        'error' => 'Détection échouée côté serveur : ' . $json['error'],
                    ]);
                }

                $gender = strtolower($json['dominant_gender'] ?? '');
                $map = ['man' => 'homme', 'woman' => 'femme'];
                $sexe = $map[$gender] ?? null;

                if ($sexe) {
                    $user->sexe = $sexe;
                    $user->status = $user->isProfileComplete() ? 'actif' : 'inactif';
                    $user->save();

                    return response()->json(['sexe' => $sexe]);
                }

                // Réponse 200 mais pas de genre exploitable
                return response()->json([
                    'sexe'  => null,
                    'error' => 'Aucun visage net détecté sur l\'image (réponse: ' . json_encode($json) . ').',
                ]);
            }

            // Le service DeepFace a répondu avec un code d'erreur HTTP
            return response()->json([
                'sexe'  => null,
                'error' => 'Service de vérification a renvoyé une erreur HTTP ' . $response->status(),
            ]);

        } catch (\Throwable $e) {
            Log::error('DeepFace connection failed', [
                'url'     => $deepfaceUrl,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'sexe'  => null,
                'error' => 'Connexion au service de vérification impossible : ' . $e->getMessage(),
            ]);
        }
    }
}