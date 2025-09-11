<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HelpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpRequestController extends Controller
{
    public function index()
    {
        $helpRequests = HelpRequest::where('user_id', Auth::id())->get();
        return view('user.helpRequests.index', compact('helpRequests'));
    }

    public function create()
    {
        return view('user.helpRequests.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $data['user_id'] = Auth::id();
        HelpRequest::create($data);

        return redirect()->route('user.help-requests.index')->with('success', 'Demande créée avec succès');
    }

    public function show(HelpRequest $helpRequest)
    {
        // $this->authorize('view', $helpRequest);
        return view('user.helpRequests.show', compact('helpRequest'));
    }

    public function edit(HelpRequest $helpRequest)
    {
        $this->authorize('update', $helpRequest); // sécurité
        return view('user.helpRequests.edit', compact('helpRequest'));
    }

    public function update(Request $request, HelpRequest $helpRequest)
    {
        //$this->authorize('update', $helpRequest); permet d'accepter une demande,
        // mais ne la retire pas de la liste A CORRIGER

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $helpRequest->update($data);

        return redirect()->route('user.help-requests.index')->with('success', 'Demande mise à jour');
    }

    public function destroy(HelpRequest $helpRequest)
    {
        $this->authorize('delete', $helpRequest);
        $helpRequest->delete();

        return redirect()->route('user.help-requests.index')->with('success', 'Demande supprimée');
    }
}
