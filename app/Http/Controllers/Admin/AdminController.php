<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HelpRequest;
use App\Models\User;
use App\Models\HelpCategory;
use App\Models\Mission;



class AdminController extends Controller
{

    public function dashboard(Request $request)
    {
        $usersCount = User::count();
        $requestsCount = HelpRequest::count();
        $missionsCount = 0;
        $othersCount = 0;

        $query = HelpRequest::query()->latest();

        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $helpRequests = $query->paginate(10);

        $categories = HelpCategory::all();

        return view('admin.dashboard', compact(
            'usersCount',
            'requestsCount',
            'helpRequests',
            'missionsCount',
            'othersCount',
            'categories'
        ));
    }


    // Liste des utilisateurs
    public function user()
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
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
