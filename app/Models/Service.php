<?php
// app/Models/Service.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'categorie',
        'tarif',
        'type_tarif',
        'bonus',
        'duree',
        'langues',
        'max_personnes',
        'ville',
        'pays',
        'photos',
        'disponible',
    ];

    protected $casts = [
        'photos'     => 'array',
        'disponible' => 'boolean',
        'tarif'      => 'decimal:2',
    ];

    // ── Relation ──────────────────────────────────────────────────────────────
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserOnlytrap::class, 'user_id');
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /** Première photo ou placeholder */
    public function coverPhoto(): string
    {
        $photos = $this->photos ?? [];
        if (!empty($photos)) {
            return asset('storage/' . $photos[0]);
        }
        // Placeholder généré selon la catégorie
        $placeholders = [
            'Gastronomie / Cuisine' => 'https://images.unsplash.com/photo-1539020140153-e479b8c22e70?w=600&q=80',
            'Nature / Randonnée'    => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600&q=80',
            'Culture / Art'         => 'https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=600&q=80',
            'Aventure / Sport'      => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=600&q=80',
            'Bateau / Mer'          => 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?w=600&q=80',
        ];
        return $placeholders[$this->categorie]
            ?? 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=600&q=80';
    }

    /** Label lisible du type de tarif */
    public function typeTarifLabel(): string
    {
        return match($this->type_tarif) {
            'heure'        => '/ heure',
            'demi-journee' => '/ demi-journée',
            'journee'      => '/ journée',
            'semaine'      => '/ semaine',
            'mois'         => '/ mois',
            'personne'     => '/ personne',
            'forfait'      => 'forfait',
            default        => '',
        };
    }
}