<?php

namespace App\Http\Controllers;

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
     
       
       return redirect()->route('profile.index')->with('success', 'Photo de profil mise à jour avec succès');
   }

   public function favoris()
   {
       return view('favoris');
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

}
