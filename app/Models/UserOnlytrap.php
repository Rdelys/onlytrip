<?php
// app/Models/UserOnlytrap.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserOnlytrap extends Authenticatable
{
    use Notifiable;

    protected $table = 'user_onlytrap';

    protected $fillable = [
        'mail', 'google_id', 'profil', 'profil_chosen',
        'otp_code', 'otp_expires_at', 'email_verified_at', 'password',
        // New fields
        'status',
        'nom', 'prenom', 'pseudo', 'date_naissance', 'sexe',
        'telephone', 'photo_profil', 'centres_interet',
        'bio', 'classement_etoile',
    ];

    protected $hidden = ['password', 'remember_token', 'otp_code'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at'    => 'datetime',
        'date_naissance'    => 'date',        // ← fix: manquait, causait l'erreur ->format()
        'profil'            => 'integer',
        'profil_chosen'     => 'boolean',
        'centres_interet'   => 'array',
        'classement_etoile' => 'float',
    ];

    public function profilLabel(): string
    {
        return $this->profil == 1 ? 'Voyageur' : 'Local';
    }

    /**
     * Returns true when all required profile fields are filled.
     * Le sexe est désormais déterminé exclusivement par DeepFace
     * (jamais saisi manuellement) donc il fait toujours partie
     * des champs requis pour la complétion.
     */
    public function isProfileComplete(): bool
    {
        $base = $this->nom
            && $this->prenom
            && $this->pseudo
            && $this->date_naissance
            && $this->sexe
            && $this->telephone
            && $this->photo_profil
            && !empty($this->centres_interet);

        if ($this->profil == 0) {          // Local profile needs bio too
            return $base && $this->bio;
        }

        return (bool) $base;
    }

    /**
     * Computed display name: pseudo > prenom nom > mail
     */
    public function displayName(): string
    {
        if ($this->pseudo) return $this->pseudo;
        if ($this->prenom || $this->nom) return trim("{$this->prenom} {$this->nom}");
        return $this->mail;
    }
}