<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function show()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Catégorie créée avec succès.');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Catégory supprimé avec succès.');
    }

    public function update(Request $request,$id) {

        // dd('hi');
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category=Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.categories')
        ->with('success', 'Catégorie mise à jour avec succès.');
    }
}
