<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\HelpRequest;
use App\Models\Mission;
use App\Models\Participation;

class UserController extends Controller
{
    /**
     * Affiche le tableau de bord de l'utilisateur connecté.
     *
     * Récupère les statistiques personnelles, les demandes d'aide,
     * les missions et les participations, puis les transmet à la vue.
     *
     * @return Response
     */

    public function dashboard()
    {
        $userId = Auth::id();

        // Nombre total de demandes créées par l'utilisateur
        $myRequestsCount = HelpRequest::where('user_id', $userId)->count();

        // Toutes les demandes pour le tableau principal (pagination)
        $helpRequests = HelpRequest::with(['user', 'category', 'address'])
            ->latest()
            ->paginate(10);

        // Les demandes que l'utilisateur a acceptées pour aider d'autres users
        $acceptedRequests = HelpRequest::where('accepted_by_user_id', $userId)
            ->with(['user', 'category', 'address'])
            ->get();

        // Nombre de missions publiées
        $missionsCount = Mission::where('is_published', true)->count();

        // Nombre de participations de l'utilisateur à des missions
        $myParticipationsCount = Participation::where('volunteer_id', $userId)->count();

        // Passer toutes les variables à la vue
        return view('user.dashboard', compact(
            'myRequestsCount',
            'helpRequests',
            'acceptedRequests',
            'missionsCount',
            'myParticipationsCount'
        ));
    }
}
