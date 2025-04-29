<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileAgentController extends Controller
{
    public function showAgent($id){
        $user = User::findOrFail($id);
        return view('profileAgent',compact('user'));
    }

    public function index(){
        $categories =Category::all();
        // dd($categories);
        $agents = User::where('role_id', 2)->get();
        return view('addAnnonce', compact('agents','categories'));
    }

}
