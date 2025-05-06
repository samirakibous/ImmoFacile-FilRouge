<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileAgentController extends Controller
{
    public function showAgent($id, Request $request){
        $user = User::findOrFail($id);
        $categories = Category::all();
        $profile = $user->agentProfile;
        $agent = User::findOrFail($id);
        $countReviews=$agent->receivedReviews()->count();
        $reviews = $agent->receivedReviews;
        $propertiesQuery = $user->properties()
            ->with(['images' => function ($query) {
                $query->orderBy('is_primary', 'desc');
            }]);

        if ($request->has('category') && $request->category != '') {
            $propertiesQuery->where('category_id', $request->category);
        }

        $properties = $propertiesQuery->get();

        return view('profileAgent', compact('user', 'properties', 'categories','profile','reviews','countReviews','agent'));
    }

    public function index(){
        $categories = Category::all();
        // dd($categories);
      
        $agents = User::where('role_id', 2)->get();
        return view('addAnnonce', compact('agents', 'categories'));
    }

    public function saveOrUpdate(Request $request)
    {
        $user = auth()->user();
    
        $validated = $request->validate([
            'adresse' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'a_propos' => 'nullable|string',
            'website' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'x' => 'nullable|string|max:255',
        ]);
    
        // Mise à jour ou création
        $user->agentProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );
    
        return back()->with('success', 'Profil mis à jour avec succès.');
    }
    

}
