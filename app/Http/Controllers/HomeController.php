<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories =Category::all();
        $properties = Property::with(['images' => function($query) {
            $query->orderBy('is_primary', 'desc');
        }])->get();
        return view('home',compact('categories','properties'));
    }
    public function agentsList()
    {
        $agents = User::where('role_id', 2)->get(); 
        //  dd($agents);
        return view('agents',compact('agents'));
    }

    public function vendre()
    {
        $properties = Property::with(['images' => fn($q) => $q->orderByDesc('is_primary')])
        ->where('type_transaction', 'vendre')
        ->get();
        return view('vendre',compact('properties'));
    }

    public function louer()
    {
        $properties = Property::with(['images' => fn($q) => $q->orderByDesc('is_primary')])
        ->where('type_transaction', 'location')
        ->get();
        return view('location',compact('properties'));
    }
}
