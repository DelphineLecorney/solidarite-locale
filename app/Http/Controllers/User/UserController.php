<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\HelpRequest;


class UserController extends Controller
{

    public function dashboard()
    {
        $helpRequests = HelpRequest::with(['user', 'category', 'address'])
            ->latest()
            ->paginate(10);

        $myRequestsCount = HelpRequest::where('user_id', Auth::id())->count();

        return view('user.dashboard', compact('helpRequests', 'myRequestsCount'));
    }
}
