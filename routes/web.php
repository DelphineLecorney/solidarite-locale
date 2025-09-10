<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpRequestController;
use App\Http\Controllers\AdminController;

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
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/help-requests', [HelpRequestController::class, 'index'])->name('help-requests.index');
});

// Dashboard associations
Route::middleware(['auth', 'role:association'])->group(function () {
    Route::get('/missions', [DashboardController::class, 'missions'])->name('missions');
});

// Dashboard admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    Route::get('/missions', [AdminController::class, 'missions'])->name('missions');
    Route::delete('/missions/{mission}', [AdminController::class, 'destroyMission'])->name('missions.destroy');

    Route::get('/help-requests', [AdminController::class, 'helpRequests'])->name('helpRequests');
    Route::delete('/help-requests/{helpRequest}', [AdminController::class, 'destroyHelpRequest'])->name('helpRequests.destroy');
});


Route::resource('requests', HelpRequestController::class);
