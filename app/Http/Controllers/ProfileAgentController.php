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

        $propertiesQuery = $user->properties()
            ->with(['images' => function ($query) {
                $query->orderBy('is_primary', 'desc');
            }]);

        if ($request->has('category') && $request->category != '') {
            $propertiesQuery->where('category_id', $request->category);
        }

        $properties = $propertiesQuery->get();

        return view('profileAgent', compact('user', 'properties', 'categories'));
    }

    public function index(){
        $categories = Category::all();
        // dd($categories);
        $agents = User::where('role_id', 2)->get();
        return view('addAnnonce', compact('agents', 'categories'));
    }
}
