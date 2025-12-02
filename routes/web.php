<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Display login page (GET)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Process login form (POST)
Route::post('/login', [LoginController::class, 'login']);

// Display register page (GET)
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');

// Process register form (POST)
Route::post('/register', [LoginController::class, 'register']);
//
// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/app', function () {
    return view('app');
})->middleware('auth');

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
