<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Notifications\AccountActivated;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $pendingUsers = User::where('status', 'pending')->count();
        $suspendedUsers = User::where('status', 'suspended')->count();
        
        // Statistiques par rôle - version corrigée
        $usersByRole = Role::withCount('users')->get();
        
        // Nouvelles inscriptions au fil du temps (30 derniers jours)
        $last30Days = collect(range(0, 29))->map(function ($i) {
            $date = now()->subDays($i)->format('Y-m-d');
            $count = User::whereDate('created_at', $date)->count();
            return [
                'date' => $date,
                'count' => $count
            ];
        })->reverse()->values();
    
    return view('admin.index', compact(
        'totalUsers', 
        'activeUsers', 
        'pendingUsers', 
        'suspendedUsers', 
        'usersByRole', 
        'last30Days'
    ));
    }

    public function demandes()
    {
        $users = User::all();
        // $demandes = User::where('role_id', 2)->get();
        $demandes = User::where('status', 'pending')->get();
        // dd($demandes);
        $totalDemandes = User::where('role_id', 2)->where('status', 'pending')->count();
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
        //    dd($user);

        $user->notify(new AccountActivated($user));
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
        // $users = User::paginate(4);
        $users = User::whereHas('role', function ($query) {
            $query->where('name', '!=', 'admin');
        })->with('role')->paginate(4);
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

        if ($user->status === 'active') {
            $user->notify(new AccountActivated($user));
        }

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

    public function AddProduct() {}
}
