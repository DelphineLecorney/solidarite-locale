<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mission;
use App\Models\HelpRequest;

class AdminController extends Controller
{
    // Dashboard principal de l'admin
    public function index()
    {
        $userCount = User::count();
        $missionCount = Mission::count();
        $helpRequestCount = HelpRequest::count();

        return view('admin.dashboard', compact('userCount', 'missionCount', 'helpRequestCount'));
    }

    // Liste des utilisateurs
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Supprimer un utilisateur
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé.');
    }

    // Liste des missions
    public function missions()
    {
        $missions = Mission::all();
        return view('admin.missions.index', compact('missions'));
    }

    // Supprimer une mission
    public function destroyMission(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('admin.missions')->with('success', 'Mission supprimée.');
    }

    // Liste des demandes d'aide
    public function helpRequests()
    {
        $helpRequests = HelpRequest::all();
        return view('admin.helpRequests.index', compact('helpRequests'));
    }

    // Supprimer une demande d'aide
    public function destroyHelpRequest(HelpRequest $helpRequest)
    {
        $helpRequest->delete();
        return redirect()->route('admin.helpRequests')->with('success', 'Demande supprimée.');
    }
}
