<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalUsers = User::count();
        return view('admin.index', compact('users', 'totalUsers'));
    }

    public function demandes()
    {
        $users = User::all();
        // $demandes = User::where('role_id', 2)->get();
        $demandes=User::where('status','pending')->get();
        // dd($demandes);
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
        $user->role_id = 2;
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
        $users = User::paginate(4);
        $totalUsers = User::count();
        $roles = Role::all();
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

        $allowedFields = ['name', 'email', 'status'];

        foreach ($allowedFields as $field) {
            if ($request->has($field)) {
                $user->$field = $request->input($field);
            }
        }

        $user->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,pending,suspended',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur ajouté avec succès.');
    }
}
