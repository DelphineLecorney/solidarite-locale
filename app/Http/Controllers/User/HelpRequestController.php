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
    public function index()
    {
        $helpRequests = HelpRequest::where('user_id', Auth::id())->get();
        return view('user.helpRequests.index', compact('helpRequests'));
    }

    public function create()
    {
        $categories = HelpCategory::all();
        $addresses = Address::all();

        return view('user.helpRequests.create', compact('categories', 'addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:help_categories,id',
            'address_id' => 'nullable|exists:addresses,id',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'postcode' => 'nullable|string',
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

    public function show(HelpRequest $helpRequest)
    {
        // $this->authorize('view', $helpRequest);
        return view('user.help-requests.show', compact('helpRequest'));
    }

    public function edit(HelpRequest $helpRequest)
    {
        // Vérifie que l'utilisateur est bien l'auteur
        if ($helpRequest->user_id != Auth::id()) {
            abort(403);
        }

        return view('user.helpRequests.edit', compact('helpRequest'));
    }

    public function update(Request $request, HelpRequest $helpRequest)
    {
        // Vérifie que l'utilisateur est bien l'auteur
        if ($helpRequest->user_id != Auth::id()) {
            abort(403);
        }

        // Mise à jour sécurisée
        $helpRequest->update($request->only(['title', 'description']));

        return redirect()->route('user.help-requests.index')
            ->with('success', 'Demande mise à jour avec succès !');
    }

    public function destroy(HelpRequest $helpRequest)
    {
        if ($helpRequest->user_id != Auth::id()) {
            abort(403);
        }

        $helpRequest->delete();

        return redirect()->route('user.help-requests.index')
            ->with('success', 'Demande supprimée avec succès !');
    }
}
