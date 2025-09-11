<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\UserController;


use App\Http\Controllers\Admin\HelpRequestController as AdminHelpRequestController;
use App\Http\Controllers\User\HelpRequestController as UserHelpRequestController;

// Pages publiques
Route::get('/', function () {
    return view('home');
})->name('home');

// Auth
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Dashboard utilisateurs
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('help-requests', UserHelpRequestController::class);
});


// Dashboard associations
Route::middleware(['auth', 'role:association'])->group(function () {
    Route::get('/missions', [DashboardController::class, 'missions'])->name('missions');
});

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Gestion des users
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::delete('/user/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    // Gestion des missions
    Route::get('/missions', [AdminController::class, 'missions'])->name('missions');
    Route::delete('/missions/{mission}', [AdminController::class, 'destroyMission'])->name('missions.destroy');

    // Gestion des demandes d’aide
    Route::resource('help-requests', AdminHelpRequestController::class);
});

Route::fallback(function () {
    return redirect()->route('home');
});
