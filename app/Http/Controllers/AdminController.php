<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        $totalUsers = User::count();
        return view('admin.index', compact('users', 'totalUsers'));
    }

    public function demandes(){
        $users = User::all();
        $demandes = User::where('role_id', 2)->get();
        $totalDemandes = User::where('role_id', 2)->count();
        $totalUsers = User::count();
        // dd($totalDemandes);
        // dd($demandes);
        return view('admin.demandes', compact('demandes', 'totalDemandes', 'users', 'totalUsers'));
    }

    public function accepter($id)
    {
        $user = User::findOrFail($id);
        // dd($user->role_id);
        $user->role_id = 3;
        // dd($user->role_id);
        $user->status = 'active';
        $user->save();
        // dd($user);

        return redirect()->route('admin.demandes')->with('success', 'Demande acceptée avec succès.');
    }
    public function refuser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.demandes')->with('success', 'Demande refusée avec succès.');
    }

    public function users()
    {
        $users = User::paginate(4); ;
        $totalUsers = User::count();
        $roles =Role::all();
        return view('admin.users', compact('users', 'totalUsers', 'roles'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès.');
    }   

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
