<?php
// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\UserOnlytrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'mail'   => 'required|email',
            'profil' => 'required|in:0,1',
        ]);

        $existing = UserOnlytrap::where('mail', $request->mail)->first();

        if ($existing && $existing->email_verified_at) {
            return back()
                ->withErrors(['mail' => 'Cet email est déjà inscrit. Veuillez vous connecter.'])
                ->with('open_modal', 'loginModal');
        }

        $otp = (string) random_int(100000, 999999);

        $user = UserOnlytrap::updateOrCreate(
            ['mail' => $request->mail],
            [
                'profil'         => $request->profil,
                'otp_code'       => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]
        );

        Mail::to($user->mail)->send(new OtpMail($otp));

        session(['otp_email' => $user->mail, 'otp_mode' => 'register']);

        return back()->with('otp_sent', true);
    }
}