<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HelpCategory;
use App\Models\HelpRequest;

class HomeController extends Controller
{
    public function home()
    {
        // Statistiques globales
        $categories = HelpCategory::all();
        $usersCount = User::count();
        $requestsCount = HelpRequest::count();
        $categoriesCount = $categories->count();
        $othersCount = 0;

        return view('home', compact('usersCount', 'requestsCount', 'categoriesCount', 'othersCount'));
    }
}
