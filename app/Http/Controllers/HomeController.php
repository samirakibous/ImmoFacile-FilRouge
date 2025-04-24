<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function agentsList()
    {
        $agents = User::where('role_id', 2)->get(); 
        //  dd($agents);
        return view('agents',compact('agents'));
    }
}
