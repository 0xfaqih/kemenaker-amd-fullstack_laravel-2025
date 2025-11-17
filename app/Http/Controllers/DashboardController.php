<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Pet;
use App\Models\Checkup;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOwners = Owner::count();
        $totalPets = Pet::count();
        $totalCheckups = Checkup::count();
        $recentCheckups = Checkup::with(['pet.owner', 'treatment'])
            ->orderBy('checkup_date', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard', compact('totalOwners', 'totalPets', 'totalCheckups', 'recentCheckups'));
    }
}
