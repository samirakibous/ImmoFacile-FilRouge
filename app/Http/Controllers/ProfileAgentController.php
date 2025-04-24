<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileAgentController extends Controller
{
    public function showAgent(){
        $user = auth()->user();
        return view('profileAgent',compact('user'));
    }
}
