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
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function participate(Mission $mission)
    {
        $userId = auth::id();

        // Vérifier si l'utilisateur a déjà participé
        if ($mission->participations()->where('volunteer_id', $userId)->exists()) {
            return back()->with('error', 'Vous participez déjà à cette mission !');
        }

        $mission->participations()->create([
            'volunteer_id' => $userId,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Vous participez à cette mission !');
    }




    public function myParticipations()
    {
        $participations = Participation::with('mission.organization')
            ->where('volunteer_id', Auth::id())
            ->get();
        return view('user.missions.my-participations', compact('participations'));
    }
}
