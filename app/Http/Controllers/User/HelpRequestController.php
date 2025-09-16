<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HelpRequest;
use App\Models\HelpCategory;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpRequestController extends Controller
{

    /**
     * Affiche la liste complète des demandes d'aide
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();

        $helpRequests = HelpRequest::where('user_id', $userId)
            ->with(['category', 'address'])
            ->latest()
            ->get();

        $acceptedRequests = HelpRequest::where('accepted_by_user_id', $userId)
            ->with(['user', 'category', 'address'])
            ->get();

        return view('user.help-requests.index', compact('helpRequests', 'acceptedRequests'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle demande d'aide.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = HelpCategory::all();
        $addresses = Address::all();

        return view('user.help-requests.create', compact('categories', 'addresses'));
    }

    /**
     * Enregistre une nouvelle demande d'aide avec les données validées.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:help_categories,id',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => ['required', 'regex:/^[0-9]{4}$/'],
        ]);


        if ($request->filled('address_id')) {
            $addressId = $request->address_id;
        } elseif ($request->filled(['street', 'city', 'postcode'])) {
            $address = Address::create([
                'street' => $request->street,
                'city' => $request->city,
                'postcode' => $request->postcode,
            ]);
            $addressId = $address->id;
        } else {
            return back()->withErrors('Vous devez sélectionner ou créer une adresse.');
        }

        HelpRequest::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'address_id' => $addressId,
            'status' => 'pending',
        ]);

        return redirect()->route('user.help-requests.index')
            ->with('success', 'Demande créée avec succès !');
    }

    /**
     * Affiche les détails d'une demande d'aide spécifique.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\View\View
     */
    public function show(HelpRequest $helpRequest)
    {
        return view('user.help-requests.show', compact('helpRequest'));
    }

    /**
     * Affiche le formulaire d'édition pour une demande d'aide.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\View\View
     */
    public function edit(HelpRequest $helpRequest)
    {

        if ($helpRequest->user_id != Auth::id()) {
            abort(403);
        }

        return view('user.help-requests.edit', compact('helpRequest'));
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

        if ($helpRequest->user_id != Auth::id()) {
            abort(403);
        }

        $helpRequest->update($request->only(['title', 'description']));

        return redirect()->route('user.help-requests.index')
            ->with('success', 'Demande mise à jour avec succès !');
    }

    /**
     * Supprime une demande d'aide et redirige avec un message de confirmation.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HelpRequest $helpRequest)
    {
        if ($helpRequest->user_id != Auth::id()) {
            abort(403);
        }

        $helpRequest->delete();

        return redirect()->route('user.help-requests.index')
            ->with('success', 'Demande supprimée avec succès !');
    }

    /**
     * Marque une demande d'aide comme acceptée.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(HelpRequest $helpRequest)
    {

        if ($helpRequest->status !== 'pending') {
            return redirect()->back()->with('error', 'Cette demande ne peut pas être acceptée.');
        }

        $helpRequest->update([
            'status' => 'accepted',
            'accepted_by_user_id' => Auth::id(),

        ]);

        return redirect()->route('user.dashboard')->with('success', 'Demande acceptée !');
    }

    /**
     * Marque une demande d'aide comme terminée.
     *
     * @param HelpRequest $helpRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function done(HelpRequest $helpRequest)
    {
        if ($helpRequest->accepted_by_user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas terminer cette demande.');
        }

        if ($helpRequest->status !== 'accepted') {
            return redirect()->back()->with('error', 'Seules les demandes acceptées peuvent être terminées.');
        }

        $helpRequest->update([
            'status' => 'done',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Demande marquée comme terminée !');
    }
}
