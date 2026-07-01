<?php
// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // ── Catégories disponibles ────────────────────────────────────────────────
    public const CATEGORIES = [
        'Gastronomie / Cuisine',
        'Nature / Randonnée',
        'Culture / Art',
        'Aventure / Sport',
        'Bateau / Mer',
        'Bien-être / Spa',
        'Transport / Guide',
        'Hébergement',
        'Photographie',
        'Autre',
    ];

    public const TYPES_TARIF = [
        'heure'        => 'Par heure',
        'demi-journee' => 'Par demi-journée',
        'journee'      => 'Par journée',
        'semaine'      => 'Par semaine',
        'mois'         => 'Par mois',
        'personne'     => 'Par personne',
        'forfait'      => 'Forfait fixe',
    ];

    // ── Middleware guard : Locaux uniquement ──────────────────────────────────
    private function requireLocal()
    {
        $user = Auth::user();
        if (!$user || $user->profil != 0) {
            abort(403, 'Accès réservé aux locaux.');
        }
        return $user;
    }

    // ── Affichage de la page de gestion ──────────────────────────────────────
    public function index()
    {
        $user     = $this->requireLocal();
        $services = Service::where('user_id', $user->id)
                           ->orderByDesc('created_at')
                           ->get();

        return view('services.index', [
            'services'   => $services,
            'categories' => self::CATEGORIES,
            'typesTarif' => self::TYPES_TARIF,
        ]);
    }

    // ── Ajout d'un service ────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $user = $this->requireLocal();

        $validated = $request->validate([
            'titre'         => 'required|string|max:200',
            'description'   => 'required|string|max:3000',
            'categorie'     => 'required|string|max:100',
            'tarif'         => 'required|numeric|min:0|max:99999',
            'type_tarif'    => 'required|in:heure,demi-journee,journee,semaine,mois,personne,forfait',
            'bonus'         => 'nullable|string|max:1500',
            'duree'         => 'nullable|string|max:150',
            'langues'       => 'nullable|string|max:250',
            'max_personnes' => 'nullable|integer|min:1|max:500',
            'ville'         => 'nullable|string|max:100',
            'pays'          => 'nullable|string|max:100',
            'photos'        => 'nullable|array|max:6',
            'photos.*'      => 'image|mimes:jpeg,png,webp|max:4096',
        ], [
            'titre.required'       => 'Le titre est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'categorie.required'   => 'Veuillez choisir une catégorie.',
            'tarif.required'       => 'Le tarif est obligatoire.',
            'tarif.numeric'        => 'Le tarif doit être un nombre.',
            'type_tarif.required'  => 'Veuillez choisir un type de tarif.',
            'photos.*.image'       => 'Chaque fichier doit être une image.',
            'photos.*.max'         => 'Chaque image ne doit pas dépasser 4 Mo.',
            'photos.max'           => 'Vous pouvez envoyer au maximum 6 photos.',
        ]);

        // Traitement des photos
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('services_photos', 'public');
            }
        }

        Service::create([
            'user_id'       => $user->id,
            'titre'         => $validated['titre'],
            'description'   => $validated['description'],
            'categorie'     => $validated['categorie'],
            'tarif'         => $validated['tarif'],
            'type_tarif'    => $validated['type_tarif'],
            'bonus'         => $validated['bonus'] ?? null,
            'duree'         => $validated['duree'] ?? null,
            'langues'       => $validated['langues'] ?? null,
            'max_personnes' => $validated['max_personnes'] ?? null,
            'ville'         => $validated['ville'] ?? null,
            'pays'          => $validated['pays'] ?? null,
            'photos'        => $photoPaths,
            'disponible'    => true,
        ]);

        return back()->with('success', 'Service ajouté avec succès !');
    }

    // ── Mise à jour d'un service ──────────────────────────────────────────────
    public function update(Request $request, int $id)
    {
        $user    = $this->requireLocal();
        $service = Service::where('id', $id)
                          ->where('user_id', $user->id)
                          ->firstOrFail();

        $validated = $request->validate([
            'titre'         => 'required|string|max:200',
            'description'   => 'required|string|max:3000',
            'categorie'     => 'required|string|max:100',
            'tarif'         => 'required|numeric|min:0|max:99999',
            'type_tarif'    => 'required|in:heure,demi-journee,journee,semaine,mois,personne,forfait',
            'bonus'         => 'nullable|string|max:1500',
            'duree'         => 'nullable|string|max:150',
            'langues'       => 'nullable|string|max:250',
            'max_personnes' => 'nullable|integer|min:1|max:500',
            'ville'         => 'nullable|string|max:100',
            'pays'          => 'nullable|string|max:100',
            'photos_new'    => 'nullable|array|max:6',
            'photos_new.*'  => 'image|mimes:jpeg,png,webp|max:4096',
            'photos_delete' => 'nullable|array',
            'photos_delete.*'=> 'string',
        ]);

        // Supprimer les photos cochées
        $currentPhotos = $service->photos ?? [];
        $toDelete      = $request->input('photos_delete', []);
        foreach ($toDelete as $path) {
            if (in_array($path, $currentPhotos)) {
                Storage::disk('public')->delete($path);
                $currentPhotos = array_values(array_diff($currentPhotos, [$path]));
            }
        }

        // Ajouter les nouvelles photos
        if ($request->hasFile('photos_new')) {
            foreach ($request->file('photos_new') as $photo) {
                if (count($currentPhotos) < 6) {
                    $currentPhotos[] = $photo->store('services_photos', 'public');
                }
            }
        }

        $service->update([
            'titre'         => $validated['titre'],
            'description'   => $validated['description'],
            'categorie'     => $validated['categorie'],
            'tarif'         => $validated['tarif'],
            'type_tarif'    => $validated['type_tarif'],
            'bonus'         => $validated['bonus'] ?? null,
            'duree'         => $validated['duree'] ?? null,
            'langues'       => $validated['langues'] ?? null,
            'max_personnes' => $validated['max_personnes'] ?? null,
            'ville'         => $validated['ville'] ?? null,
            'pays'          => $validated['pays'] ?? null,
            'photos'        => $currentPhotos,
        ]);

        return back()->with('success', 'Service mis à jour avec succès !');
    }

    // ── Activation / désactivation ────────────────────────────────────────────
    public function toggle(int $id)
    {
        $user    = $this->requireLocal();
        $service = Service::where('id', $id)
                          ->where('user_id', $user->id)
                          ->firstOrFail();

        $service->update(['disponible' => !$service->disponible]);

        $label = $service->disponible ? 'activé' : 'désactivé';
        return back()->with('success', "Service « {$service->titre} » {$label}.");
    }

    // ── Suppression ───────────────────────────────────────────────────────────
    public function destroy(int $id)
    {
        $user    = $this->requireLocal();
        $service = Service::where('id', $id)
                          ->where('user_id', $user->id)
                          ->firstOrFail();

        // Supprimer les photos du stockage
        foreach ($service->photos ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }

        $service->delete();
        return back()->with('success', 'Service supprimé.');
    }
}