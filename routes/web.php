<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    $services = \App\Models\Service::with('user')   // charge le local
        ->where('disponible', true)
        ->latest()
        ->take(6)
        ->get();
 
    return view('welcome', compact('services'));
});

//loginmail

Route::post('/register/send-otp', [RegisterController::class, 'send'])->name('register.send');
Route::post('/login/send-otp', [LoginController::class, 'send'])->name('login.send');
Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Profil
Route::middleware('auth')->group(function () {
    Route::get('/profil',              [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profil',             [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/detect-genre',[ProfileController::class, 'detectGender'])->name('profile.detect-gender');
 
    // Already existing
    Route::post('/profil/switch',      [ProfileController::class, 'switch'])->name('profil.switch');
    Route::post('/profil/choose',      [ProfileController::class, 'choose'])->name('profil.choose');
});
 

//logingoogle

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// ── Routes services (réservé aux locaux connectés) ────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/mes-services',                     [ServiceController::class, 'index'])  ->name('services.index');
    Route::post('/mes-services',                    [ServiceController::class, 'store'])  ->name('services.store');
    Route::put('/mes-services/{id}',                [ServiceController::class, 'update']) ->name('services.update');
    Route::delete('/mes-services/{id}',             [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::patch('/mes-services/{id}/toggle',       [ServiceController::class, 'toggle']) ->name('services.toggle');
});