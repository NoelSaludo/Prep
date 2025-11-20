<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', [LoginController::class, 'showLoginForm'])->name('login'); */
Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::post('/app', function () {
    return response()->noContent();
})->middleware('auth');
