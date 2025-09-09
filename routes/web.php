<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpRequestController;
use App\Http\Controllers\HomeController;


// Route  middleware quand j'aurais ajouté la page login
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('requests', HelpRequestController::class)->only([
    'show',
    'edit',
    'update',
    'destroy'
]);

Route::get('/login', function () {
    return 'Page de login';
})->name('login');
Route::get('/register', function () {
    return 'Page de register';
})->name('register');

// });
