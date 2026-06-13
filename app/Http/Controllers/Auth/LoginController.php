<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\UserOnlytrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
        ]);

        $user = UserOnlytrap::where('mail', $request->mail)
                    ->whereNotNull('email_verified_at')
                    ->first();

        if (!$user) {
            return back()
                ->withErrors(['mail' => 'Aucun compte trouvé avec cet email. Inscrivez-vous d\'abord.'])
                ->with('open_modal', 'registerModal');
        }

        $otp = (string) random_int(100000, 999999);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->mail)->send(new OtpMail($otp));

        session(['otp_email' => $user->mail, 'otp_mode' => 'login']);

        return back()->with('otp_sent', true);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}