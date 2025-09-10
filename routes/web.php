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

// Dashboard pour utilisateurs connectés (role:user)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/help-requests', [HelpRequestController::class, 'index'])->name('help-requests.index');
});

// Dashboard pour associations (role:association)
Route::middleware(['auth', 'role:association'])->group(function () {
    Route::get('/missions', [DashboardController::class, 'missions'])->name('missions');
});

// Dashboard admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Mes actions, pages 'test' pour dashboard ou autres sans être connecté
Route::get('/dashboard-test', [DashboardController::class, 'index']);
Route::resource('requests', HelpRequestController::class);
