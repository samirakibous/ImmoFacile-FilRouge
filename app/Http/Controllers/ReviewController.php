<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:users,id',
            // 'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
    
        Review::create([
            'user_id' => auth()->id(),
            'agent_id' => $request->agent_id,
            // 'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    
        return back()->with('success', 'Avis ajouté avec succès.');
    }
    
}
