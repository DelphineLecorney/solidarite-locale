<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HelpRequest;
use App\Models\HelpCategory;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = HelpCategory::all();
        $usersCount = User::count();
        $requestsCount = HelpRequest::count();
        $categoriesCount = $categories->count();
        $othersCount = 0;

        // Requête principale
        $query = HelpRequest::with(['user', 'category', 'address'])->latest();

        // Filtrer pour les utilisateurs non-admin
        if (!Auth::user()->is_admin) {
            $query->where('user_id', Auth::id());
        }

        // Filtres optionnels
        if ($request->filled('category')) {
            $query->where('help_category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $helpRequests = HelpRequest::with(['user', 'category', 'address'])
            ->latest()
            ->paginate(10);


        // Choisir la vue selon le rôle
        $view = Auth::user()->is_admin ? 'admin.dashboard' : 'user.dashboard';

        return view($view, compact(
            'usersCount',
            'requestsCount',
            'categoriesCount',
            'othersCount',
            'helpRequests',
            'categories'
        ));
    }
}
