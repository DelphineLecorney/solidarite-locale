<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\HelpRequest;
use App\Models\User;
use App\Models\HelpCategory;
use App\Models\Mission;
use App\Models\Participation;



class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord admin avec statistiques et filtres.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function dashboard(Request $request)
    {
        $usersCount = User::count();
        $requestsCount = HelpRequest::count();
        $categories = HelpCategory::all();
        $othersCount = 0;
        $missionsCount = Mission::where('is_published', true)->count();
        $query = HelpRequest::query()->latest();
        $helpRequests = $query->paginate(10);

        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        return view('admin.dashboard', compact(
            'usersCount',
            'requestsCount',
            'othersCount',
            'helpRequests',
            'categories',
            'missionsCount',
        ));
    }


    /**
     * Affiche la liste paginée des utilisateurs.
     *
     * @return \Illuminate\View\View
     */
    public function user()
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Supprime un utilisateur et redirige avec un message de succès.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé.');
    }

    /**
     * Affiche la liste des missions disponibles.
     *
     * @return \Illuminate\View\View
     */
    public function missions()
    {
        $missions = Mission::all();
        return view('admin.missions.index', compact('missions'));
    }

    /**
     * Supprime une mission et redirige avec un message de succès.
     *
     * @param Mission $mission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMission(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('admin.missions')->with('success', 'Mission supprimée.');
    }

    /**
     * Affiche la liste des demandes d'aide.
     *
     * @return \Illuminate\View\View
     */
    public function helpRequests()
    {
        $helpRequests = HelpRequest::all();
        return view('admin.helpRequests.index', compact('helpRequests'));
    }

    /**
     * Supprime une demande d'aide et redirige avec un message de succès.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyHelpRequest(HelpRequest $helpRequest)
    {
        $helpRequest->delete();
        return redirect()->route('admin.helpRequests')->with('success', 'Demande supprimée.');
    }
}
