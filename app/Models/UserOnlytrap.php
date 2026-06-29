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
    ];

    protected $hidden = ['password', 'remember_token', 'otp_code'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at'    => 'datetime',
        'profil'            => 'integer',
        'profil_chosen'     => 'boolean',
    ];

    public function profilLabel(): string
    {
        return $this->profil == 1 ? 'Voyageur' : 'Local';
    }
}