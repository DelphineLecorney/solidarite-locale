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

    public function index()
    {
        $usersCount = User::count();
        $requestsCount = HelpRequest::count();
        $categoriesCount = HelpCategory::count();
        $othersCount = 0;

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
            'helpRequests'
        ));
    }
}
