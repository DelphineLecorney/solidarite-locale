<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpRequest;
use Illuminate\Http\Request;

class HelpRequestController extends Controller
{
    /**
     * Affiche la liste complète des demandes d'aide.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $helpRequests = HelpRequest::all();
        return view('admin.help-requests.index', compact('helpRequests'));
    }

    /**
     * Affiche les détails d'une demande d'aide spécifique.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\View\View
     */
    public function show(HelpRequest $helpRequest)
    {
        return view('admin.help-requests.show', compact('helpRequest'));
    }

    /**
     * Affiche le formulaire d'édition pour une demande d'aide.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\View\View
     */
    public function edit(HelpRequest $helpRequest)
    {
        return view('admin.help-requests.edit', compact('helpRequest'));
    }

    /**
     * Met à jour une demande d'aide avec les données validées du formulaire.
     *
     * @param Request $request
     * @param HelpRequest $helpRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HelpRequest $helpRequest)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $helpRequest->update($data);

        return redirect()->route('admin.help-requests.index')->with('success', 'Demande mise à jour');
    }

    /**
     * Supprime une demande d'aide et redirige avec un message de confirmation.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HelpRequest $helpRequest)
    {
        $helpRequest->delete();

        return redirect()->route('admin.help-requests.index')->with('success', 'Demande supprimée');
    }
}
