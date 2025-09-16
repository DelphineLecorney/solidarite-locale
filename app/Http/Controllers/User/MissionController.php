<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mission;
use App\Models\Participation;

class MissionController extends Controller
{
    /**
     * Affice la liste complète des missions.
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $missions = Mission::with('organization')
            ->where('is_published', true)
            ->orderBy('starts_at', 'asc')
            ->paginate(10);

        $myParticipationsCount = Participation::where('volunteer_id', Auth::id())->count();

        return view('user.missions.index', compact('missions', 'myParticipationsCount'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle mission.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //
    }

    /**
     * Enregistre une nouvelle demande de mission avec les données validées.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Affiche les détails d'une mission spécifique.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Affiche le formulaire d'édition pour une mission.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Met à jour une mission avec les données validées du formulaire.
     *
     * @param Request $request
     * @param HelpRequest $helpRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Supprime une mission et redirige avec un message de confirmation.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Permet à l'utilisateur connecté de participer à une mission donnée.
     *
     * Cette méthode vérifie si l'utilisateur est éligible, puis l'ajoute à la mission.
     * @param Mission $mission L'entité Mission à laquelle l'utilisateur souhaite participer.
     * @return Response Une réponse HTTP indiquant le résultat de l'opération.
     */
    public function participate(Mission $mission)
    {
        $userId = auth::id();

        if ($mission->participations()->where('volunteer_id', $userId)->exists()) {
            return back()->with('error', 'Vous participez déjà à cette mission !');
        }

        $mission->participations()->create([
            'volunteer_id' => $userId,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Vous participez à cette mission !');
    }

    /**
     * Affiche la liste des missions auxquelles l'utilisateur connecté participe.
     *
     * Cette méthode récupère les participations de l'utilisateur actuel
     * et les transmet à la vue pour affichage.
     *
     * @return Response La réponse HTTP contenant la vue des participations.
     */
    public function myParticipations()
    {
        $participations = Participation::with('mission.organization')
            ->where('volunteer_id', Auth::id())
            ->get();
        return view('user.missions.my-participations', compact('participations'));
    }
}
