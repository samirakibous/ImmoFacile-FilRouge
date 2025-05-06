<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // dd($user);
        return view('profile', compact('user'));
    }

    public function updatePhoto(Request $request)
    {
        // dd($request);    
        $request->validate([
            'profile_picture' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        if ($user->role->name == 'agent') {
            return redirect()->route('profile.agent', ['id' => $user->id])->with('success', 'Photo de profil mise à jour avec succès');
        }
        return redirect()->route('profile.index')->with('success', 'Photo de profil mise à jour avec succès');
    }

    // public function favoris()
    // {
    //     $paiements = auth()->user()->paiements()->with('annonce')->get();
    //     return view('favoris', compact('paiements'));
    // }

    public function achats()
    {
        $paiements = Paiement::with('annonce')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(5);
        // dd($paiements);
        $properties = Property::with(['images' => function ($query) {
            $query->orderBy('is_primary', 'desc');
        }])->get();

        return view('achats', compact('paiements', 'properties'));
    }
    
    public function compte()
    {
        $user = auth()->user();
        return view('compte', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Mot de passe mis à jour avec succès.');
    }

    public function desactivate(Request $request)
    {
        $user = auth()->user();
        $user->is_desactivated = true;
        $user->save();

        auth()->logout();

        return redirect()->route('login')->with('status', 'Votre compte est désactivé pendant 30 jours.');
    }

    public function reactivate(Request $request)
    {
        $email = session('email_attempt');
        $password = session('password_attempt');

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return redirect()->route('login')->withErrors(['email' => 'Session expirée ou identifiants invalides.']);
        }

        $user->is_desactivated = false;
        $user->save();

        Auth::login($user);

        session()->forget(['email_attempt', 'password_attempt']);

        return redirect()->route('home')->with('status', 'Bienvenue de retour ! Votre compte est réactivé.');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        return redirect()->route('home')->with('success', 'Votre compte a été supprimé.');
    }
}
