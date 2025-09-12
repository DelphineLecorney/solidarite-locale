<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HelpRequest;
use App\Models\HelpCategory;
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
        $categories = HelpCategory::all();
        return view('user.helpRequests.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:help_categories,id',
        ]);
        $validated['user_id'] = Auth::id();



        HelpRequest::create($validated);

        return redirect()->route('user.help-requests.index')
            ->with('success', 'Demande créée avec succès');
    }


    public function show(HelpRequest $helpRequest)
    {
        // $this->authorize('view', $helpRequest);
        return view('user.help-requests.show', compact('helpRequest'));
    }

    public function edit(HelpRequest $helpRequest)
    {
        $this->authorize('update', $helpRequest); // sécurité
        return view('user.helpRequests.edit', compact('helpRequest'));
    }

    //$this->authorize('update', $helpRequest); permet d'accepter une demande,
    // mais ne la retire pas de la liste A CORRIGER
    public function update(Request $request, HelpRequest $helpRequest)
    {
        if ($helpRequest->user_id !== Auth::id()) {
            abort(403);
        }

        $helpRequest->update($request->all());

        return redirect()->route('user.help-requests.index');
    }


    public function destroy(HelpRequest $helpRequest)
    {
        $this->authorize('delete', $helpRequest);
        $helpRequest->delete();

        return redirect()->route('user.help-requests.index')->with('success', 'Demande supprimée');
    }
}
