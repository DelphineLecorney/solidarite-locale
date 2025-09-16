<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Enregistrez tous les services d'application.
     */
    public function register(): void
    {
        //
    }

    /**
     * Démarrer tous les services d'application.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
