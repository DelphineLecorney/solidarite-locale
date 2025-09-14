<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\HelpRequest;


class UserController extends Controller
{

    public function dashboard()
    {
        // Nombre total de demandes de l'utilisateur
        $myRequestsCount = HelpRequest::where('user_id', Auth::id())->count();

        // Toutes les demandes pour le tableau principal (pagination)
        $helpRequests = HelpRequest::with(['user', 'category', 'address'])
            ->latest()
            ->paginate(10);


        // Les demandes déjà acceptées par l'utilisateur
        $acceptedRequests = HelpRequest::where('status', 'accepted')
            ->where('accepted_by_user_id', Auth::id())
            ->get();



        // Passer les variables à la vue
        return view('user.dashboard', compact('myRequestsCount', 'helpRequests', 'acceptedRequests'));
    }
}
