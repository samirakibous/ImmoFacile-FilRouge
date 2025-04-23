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
        //  dd($request);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
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
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role_id,
            'status' => $status ?? 'active',
        ]);
        if ($status == 'active' || $isFirstUser) {
            Auth::login($user);
            $token = $user->createToken('NomDuToken')->plainTextToken;
            if($user->role->name === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('home');
            }
        } else { 
           return redirect()->route('login');
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
        if (Auth::check()) {
            $user = $request->user();
            $user->tokens->each(function ($token) {
                $token->delete();
            });
        }
        Auth::logout();
        return redirect()->route('login')->with('success', 'Vous êtes déconnecté avec succès.');
    }


    // public function login(Request $request)
    // {
    //     // dd($request->all());
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response()->json(['error' => 'Invalid credentials'], 401);
    //     }
    //     $token = $user->createToken('NomDuToken')->plainTextToken;
    //     if ($user->role->name === 'admin') {
    //         return response()->json([
    //             'message' => 'Login successful',
    //             'user' => [
    //                 'id' => $user->id,
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'roles' => $user->role->name,
    //                 'status' => $user->status,
    //                 'token' => $token,
    //                 'redirect' => route('admin.index')
    //             ]
    //         ]);
    //     }
    //     return response()->json([
    //         'message' => 'Login successful',
    //         'user' => [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'roles' => $user->role->name,
    //             'status' => $user->status,
    //             'token' => $token,
    //             'redirect' => route('home')
    //         ]
    //     ]);
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Identifiants incorrects.'])->withInput();
        }
        
        if ($user->is_desactivated) {
            session([
                'email_attempt' => $request->email,
                'password_attempt' => $request->password,
                'show_reactivation_popup' => true
            ]);
    
            return redirect()->route('login');
        }

        Auth::login($user);
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('home');
        }
    }
}
