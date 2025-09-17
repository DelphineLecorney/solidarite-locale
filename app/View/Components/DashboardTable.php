<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Composant Vue : Tableau de bord
 *
 * Ce composant est utilisé pour afficher un tableau dans le tableau de bord de l'application.
 * Il encapsule la logique de rendu et permet une réutilisation facile dans les vues Blade.
 *
 * @package App\View\Components
 */
class DashboardTable extends Component
{
    /**
     * Crée une nouvelle instance du composant DashboardTable.
     *
     * Ce constructeur peut être étendu pour accepter des paramètres dynamiques
     * (ex. : données du tableau, options d'affichage, etc.).
     */
    public function __construct()
    {
        //
    }

    /**
     * Retourne la vue associée au composant.
     *
     * Cette méthode est appelée automatiquement par Laravel pour rendre le composant.
     *
     * @return View|Closure|string La vue Blade à afficher
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-table');
    }
}
