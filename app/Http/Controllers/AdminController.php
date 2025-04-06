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
        $users = User::all();
        $demandes = User::where('role_id', 2)->get();
        $totalDemandes = User::where('role_id', 2)->count();
        $totalUsers = User::count();
        // dd($totalDemandes);
        // dd($demandes);

        // Retourner la vue avec les demandes
        return view('admin.demandes', compact('demandes', 'totalDemandes', 'users', 'totalUsers'));
    }

    public function accepter($id)
    {
        $user = User::findOrFail($id);
        // dd($user->role_id);
        $user->role_id = 3; // Changer le rôle de l'utilisateur
        // dd($user->role_id);
        $user->status = 'active';
        $user->save();
        // dd($user);

        return redirect()->route('admin.demandes')->with('success', 'Demande acceptée avec succès.');
    }
    public function refuser($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Supprimer l'utilisateur

        return redirect()->route('admin.demandes')->with('success', 'Demande refusée avec succès.');
    }
}
