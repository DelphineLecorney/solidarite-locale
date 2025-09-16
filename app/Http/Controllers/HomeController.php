<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HelpCategory;
use App\Models\HelpRequest;
use App\Models\Mission;
use App\Models\Organization;

class HomeController extends Controller
{

    /**
     * Affiche la page d'accueil de l'application.
     *
     * Cette méthode peut charger des données générales comme les missions disponibles,
     * les statistiques globales ou des éléments de présentation, puis les transmettre à la vue.
     *
     * @return Response La réponse HTTP contenant la vue de la page d'accueil.
     */
    public function home()
    {
        // Statistiques globales
        $categories = HelpCategory::all();
        $usersCount = User::count();
        $requestsCount = HelpRequest::count();
        $categoriesCount = $categories->count();
        $missionsCount = Mission::where('is_published', true)->count();
        $organizationsCount = Organization::count();
        $othersCount = 0;

        return view('home', compact(
            'usersCount',
            'requestsCount',
            'categoriesCount',
            'othersCount',
            'missionsCount',
            'organizationsCount'

        ));
    }
}
