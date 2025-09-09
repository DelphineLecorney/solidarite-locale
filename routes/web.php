<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpRequestController;


// Route  middleware quand j'aurais ajouté la page login
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('requests', HelpRequestController::class)->only([
    'show',
    'edit',
    'update',
    'destroy'
]);
// });
