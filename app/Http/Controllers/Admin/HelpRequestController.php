<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpRequest;
use Illuminate\Http\Request;

class HelpRequestController extends Controller
{
    public function index()
    {
        $helpRequests = HelpRequest::all();
        return view('admin.helpRequests.index', compact('helpRequests'));
    }

    public function show(HelpRequest $helpRequest)
    {
        return view('admin.helpRequests.show', compact('helpRequest'));
    }

    public function edit(HelpRequest $helpRequest)
    {
        return view('admin.helpRequests.edit', compact('helpRequest'));
    }

    public function update(Request $request, HelpRequest $helpRequest)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $helpRequest->update($data);

        return redirect()->route('admin.help-requests.index')->with('success', 'Demande mise à jour');
    }

    public function destroy(HelpRequest $helpRequest)
    {
        $helpRequest->delete();

        return redirect()->route('admin.help-requests.index')->with('success', 'Demande supprimée');
    }
}
