<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\HelpRequest;
use App\Models\HelpCategory;

class UserController extends Controller
{
    public function dashboard()
    {
        $categories = HelpCategory::all();
        $helpRequests = HelpRequest::where('user_id', Auth::id())
                                    ->with(['category', 'address'])
                                    ->latest()
                                    ->paginate(5);

        return view('user.dashboard', compact('categories', 'helpRequests'));
    }
}
