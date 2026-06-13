<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ProfileController;


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
    Route::post('/profil/switch', [ProfileController::class, 'switch'])->name('profil.switch');
});