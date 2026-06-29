<?php
// app/Http/Controllers/Auth/OtpController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserOnlytrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|digits:6',
        ]);

        $email = session('otp_email');

        if (!$email) {
            return back()->withErrors(['otp_code' => 'Session expirée, veuillez recommencer.']);
        }

        $user = UserOnlytrap::where('mail', $email)->first();

        if (!$user || $user->otp_code !== $request->otp_code) {
            return back()
                ->withErrors(['otp_code' => 'Code incorrect.'])
                ->with('otp_sent', true);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()
                ->withErrors(['otp_code' => 'Code expiré, demandez un nouveau code.'])
                ->with('otp_sent', true);
        }

        $user->update([
            'otp_code'          => null,
            'otp_expires_at'    => null,
            'email_verified_at' => $user->email_verified_at ?? now(),
        ]);

        Auth::login($user);

        session()->forget(['otp_email', 'otp_mode']);

        return redirect('/')->with('success', 'Connecté avec succès !');
    }
}