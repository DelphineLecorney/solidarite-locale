<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HelpRequest;
use App\Models\HelpCategory;

class DashboardController extends Controller
{
    // Middleware futur pour sécuriser l'accès
    // Seul les utilisateurs connectés pourront accéder plus tard
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $usersCount = User::count();
        $requestsCount = HelpRequest::count();
        $categoriesCount = HelpCategory::count();
        $othersCount = 0;

        $categories = HelpCategory::all();
        $query = HelpRequest::with(['user', 'category', 'address']);
        if ($request->filled('category')) {
            $query->where('help_category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $helpRequests = $query->latest()->paginate(10);

        // Dernières demandes avec relations préchargées
        $helpRequests = HelpRequest::with(['user', 'category', 'address'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'usersCount',
            'requestsCount',
            'categoriesCount',
            'othersCount',
            'helpRequests',
            'categories'
        ));
    }
}
