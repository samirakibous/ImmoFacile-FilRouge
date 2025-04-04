<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $isFirstUser = User::count() === 0;

        if ($isFirstUser) {
            $role = Role::where('name', 'admin')->first();
            $role_id = $role->id;
            $status = 'active';
        } else {
            $role = Role::find($request->role_id);

            if ($request->role_id == 2) {
                $role_id = $role->id;
                $status = 'pending';
            } elseif ($request->role_id == 3) {
                $role_id = $role->id;
                $status = 'active';
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role_id,
            'status' => $status ?? 'active',
        ]);

        // Après la création de l'utilisateur
if ($status == 'active' || $isFirstUser) {
    Auth::login($user);
    
    // Création du token
    $token = $user->createToken('NomDuToken')->plainTextToken;
    return response()->json([
        'success' => true,
        'message' => 'Account created successfully!',
        'token' => $token,
        'redirect' => route('home')
    ]);
} else { // Pour le cas 'pending'
    return response()->json([
        'success' => false,
        'message' => 'Account created successfully! Please wait for admin to activate your account',
        'redirect' => route('login')
    ]);
}
    }



    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt('password'),
                'google_id' => $googleUser->getId(),
                'role_id' => 3,
                'status' => 'active',
            ]);
        }
        Auth::login($user);
        return redirect()->route('home');
    }
    
public function logout(Request $request)
{
    // Vérifie si un utilisateur est authentifié via un token
    if (Auth::check()) {
        // Récupère l'utilisateur authentifié
        $user = $request->user();
        
        // Révoquer tous les tokens de l'utilisateur
        $user->tokens->each(function ($token) {
            $token->delete();
        });
    }

    // Déconnexion de l'utilisateur
    Auth::logout();

    // Rediriger vers la page de connexion (ici pour une API, tu peux renvoyer une réponse JSON)
    return response()->json([
        'message' => 'Logged out successfully'
    ]);
}


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        $token = $user->createToken('NomDuToken')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
                'token' => $token
            ]
        ]);
    }
}
