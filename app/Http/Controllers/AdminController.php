<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        // Récupérer tous les utilisateurs
        $users = User::all();
        $totalUsers = User::count();
        

        // Retourner la vue avec les utilisateurs
        return view('admin.index', compact('users', 'totalUsers'));
    }

    public function demandes(){
        $demandes = User::where('role_id', 2)->get();
        $totalDemandes = User::where('role_id', 2)->count();
        // Retourner la vue avec les demandes
        return view('admin.demandes', compact('demandes', 'totalDemandes'));
    }
}
