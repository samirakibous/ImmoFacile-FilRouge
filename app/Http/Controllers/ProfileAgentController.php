<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileAgentController extends Controller
{
    public function showAgent($id){
        $user = User::findOrFail($id);
        // $properties = $user->properties()->with('coverImage')->get();
        $properties = $user->properties()
                  ->with(['images' => function($query) {
                      $query->orderBy('is_primary', 'desc');
                  }])
                  ->get();
        //  dd($properties);
        return view('profileAgent',compact('user','properties'));
    }

    public function index(){
        $categories =Category::all();
        // dd($categories);
        $agents = User::where('role_id', 2)->get();
        return view('addAnnonce', compact('agents','categories'));
    }

}
