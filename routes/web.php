<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\MissionController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\HelpRequestController as AdminHelpRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\HelpRequestController as UserHelpRequestController;

/**
 * Routes web de l'application.
 *
 * Organisation :
 * - 🔓 Pages publiques
 * - 🔐 Authentification
 * - 👤 Utilisateur : dashboard, demandes, missions
 * - 🛠️ Admin : gestion des utilisateurs, missions, demandes
 * - 🚨 Fallback : redirection en cas d'URL inconnue
 */

// 🔓 Pages publiques
Route::get('/', [HomeController::class, 'home'])->name('home');

// 🔐 Authentification
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// 👤 Utilisateur : dashboard & demandes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // 📦 Demandes d'aide
    Route::resource('help-requests', UserHelpRequestController::class);
    Route::post('help-requests/{helpRequest}/accept', [UserHelpRequestController::class, 'accept'])->name('help-requests.accept');
    Route::post('help-requests/{helpRequest}/done', [UserHelpRequestController::class, 'done'])->name('help-requests.done');

    // 🗓️ Missions
    Route::prefix('missions')->name('missions.')->middleware('auth')->group(function () {
        Route::get('/', [MissionController::class, 'index'])->name('index');
        Route::post('/{mission}/participate', [MissionController::class, 'participate'])->name('participate');
        Route::get('my-participations', [MissionController::class, 'myParticipations'])->name('my-participations');
    });
});

// 🛠️ Admin : dashboard & gestion
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // 👥 Gestion des utilisateurs
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::delete('/user/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    // 🗓️ Gestion des missions
    Route::get('/missions', [AdminController::class, 'missions'])->name('missions');
    Route::delete('/missions/{mission}', [AdminController::class, 'destroyMission'])->name('missions.destroy');

    // 📦 Gestion des demandes d’aide
    Route::resource('help-requests', AdminHelpRequestController::class);
});

// 🚨 Fallback : redirection vers l'accueil si route inconnue
Route::fallback(function () {
    return redirect()->route('home');
});
