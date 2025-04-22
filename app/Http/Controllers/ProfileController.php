<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
