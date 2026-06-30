<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return view('welcome');
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
