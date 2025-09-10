<?php

namespace App\Http\Controllers;

use App\Models\HelpRequest;
use Illuminate\Http\Request;

class HelpRequestController extends Controller
{

    public function show(HelpRequest $request)
    {
        return view('requests.show', compact('request'));
    }

    public function edit(HelpRequest $request)
    {
        return view('requests.edit', compact('request'));
    }

    public function update(Request $request, HelpRequest $helpRequest)
    {
        $helpRequest->update($request->all());
        return redirect()->route('dashboard');
    }

    public function destroy(HelpRequest $request)
    {
        $request->delete();
        return redirect()->route('dashboard');
    }
}
