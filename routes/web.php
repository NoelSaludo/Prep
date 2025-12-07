<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AppController;
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

// Forgot password routes
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
//
// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/dashboard', function () {
    return view('app');
})->middleware('auth');

// Email verification routes
Route::middleware('auth')->group(function () {
    Route::get('/api/recipes', [AppController::class, 'fetchAllRecipe']);
    Route::post('/api/recipes/search-ingredients', [AppController::class, 'searchRecipebyIngredient']);
    Route::post('/api/recipes/toggle-filter/{name}', [AppController::class, 'toggleFilter']);
    Route::post('/api/recipes/{id}/favorite', [AppController::class, 'addToFavorite']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
