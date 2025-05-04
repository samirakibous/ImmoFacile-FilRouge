<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileAgentController extends Controller
{
    public function showAgent($id, Request $request)
    {
        // Récupérer l'utilisateur (agent)
        $user = User::findOrFail($id);
        
        // Récupérer toutes les catégories
        $categories = Category::all();

        // Créer une requête pour récupérer les propriétés de l'agent
        $propertiesQuery = $user->properties()
            ->with(['images' => function($query) {
                $query->orderBy('is_primary', 'desc');
            }]);

        // Filtrer par catégorie si un filtre est appliqué
        if ($request->has('category') && $request->category != '') {
            $propertiesQuery->where('category_id', $request->category);
        }

        // Exécuter la requête et récupérer les propriétés
        $properties = $propertiesQuery->get();

        // Retourner la vue avec les propriétés filtrées
        return view('profileAgent', compact('user', 'properties', 'categories'));
    }

    public function index(){
        $categories =Category::all();
        // dd($categories);
        $agents = User::where('role_id', 2)->get();
        return view('addAnnonce', compact('agents','categories'));
    }

}
