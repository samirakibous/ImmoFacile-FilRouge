<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
       $request->validate([
           'photo' => 'required|image|max:2048',
       ]);

       $user = Auth::user();
       
       // Supprimer l'ancienne photo si elle existe
       if ($user->photo && $user->photo !== 'image.png') {
           Storage::delete('public/images/' . $user->photo);
       }
       
       // Générer un nom unique pour la photo
       $photoName = time() . '.' . $request->photo->extension();
       
       // Enregistrer la nouvelle photo
       $request->photo->storeAs('public/images', $photoName);
       
       // Mettre à jour l'utilisateur
       $user->photo = $photoName;
       $user->save();
       
       return redirect()->route('profile.show')->with('success', 'Photo de profil mise à jour avec succès');
   }
}
