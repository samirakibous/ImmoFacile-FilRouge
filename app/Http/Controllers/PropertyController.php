<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    // public function store(Request $request)
    // {
    //     // dd($request);
    //     // Validation
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'property_type' => 'required|string|max:100',
    //         'transaction_type' => 'required|in:sale,rent',
    //         'price' => 'required|numeric|min:0',
    //         'surface' => 'required|numeric|min:1',
    //         'rooms' => 'nullable|integer|min:0',
    //         'bedrooms' => 'nullable|integer|min:0',
    //         'bathrooms' => 'nullable|integer|min:0',
    //         'year_built' => 'nullable|integer|min:1800|max:' . date('Y'),
    //         'floor' => 'nullable|integer|min:0',
    //         'features' => 'nullable|array',
    //         'features.*' => 'string|in:elevator,parking,garage,balcony,terrace,garden,pool,air_conditioning',
    //         'address' => 'required|string|max:255',
    //         'city' => 'required|string|max:100',
    //         'postal_code' => 'required|string|max:20',
    //         'country' => 'required|string|max:100',
    //         'description' => 'required|string',
    //         'photos' => 'nullable|array',
    //         'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120',
    //         'cover_photo' => 'nullable|string',
    //         'is_published' => 'nullable|boolean',
    //     ]);
    //     dd($validated);
    //     try {
    //         // Création de l'annonce
    //         $property = new Property();
    //         $property->user_id = auth()->user()->id;
    //         $property->title = $validated['title'];
    //         // $property->slug = Str::slug($validated['title']) . '-' . Str::random(6);
    //         $property->category_id = $validated['property_type'];
    //         $property->type_transaction = $validated['transaction_type'];
    //         $property->price = $validated['price'];
    //         $property->surface = $validated['surface'];
    //         $property->pieces = $validated['rooms'] ?? null;
    //         $property->chambres = $validated['bedrooms'] ?? null;
    //         $property->salle_de_bain = $validated['bathrooms'] ?? null;
    //         $property->age = $validated['year_built'] ?? null;
    //         $property->etages = $validated['floor'] ?? null;
    //         $property->equipement = isset($validated['features']) ? json_encode($validated['features']) : json_encode([]);
    //         $property->adresse = $validated['address'];
    //         $property->ville = $validated['city'];
    //         $property->code_postal = $validated['postal_code'];
    //         $property->pays = $validated['country'];
    //         $property->description = $validated['description'];
    //         // $property->is_published = $request->has('is_published') ? true : false;
    //         $property->save();

    //         // Traitement des photos
    //         $coverPhotoId = null;

    //         if ($request->hasFile('photos')) {
    //             foreach ($request->file('photos') as $index => $photo) {
    //                 $path = $photo->store('properties/' . $property->id, 'public');

    //                 $propertyImage = new PropertyImage();
    //                 $propertyImage->property_id = $property->id;
    //                 $propertyImage->image_path = $path;
    //                 $propertyImage->save();

    //                 // Si c'est la première photo ou si elle est sélectionnée comme photo principale
    //                 if ($index === 0 || ($request->has('cover_photo') && $request->cover_photo === 'photo-' . $index)) {
    //                     $coverPhotoId = $propertyImage->id;
    //                 }
    //             }

    //             // Mettre à jour la photo principale
    //             if ($coverPhotoId) {
    //                 $property->cover_image_id = $coverPhotoId;
    //                 $property->save();
    //             }
    //         }

    //         // Réponse JSON pour l'AJAX
    //         if ($request->ajax() || $request->wantsJson()) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Annonce créée avec succès!',
    //                 'property' => $property,
    //                 'redirect' => route('agent.properties.index')
    //             ]);
    //         }

    //         // Redirection standard (non-AJAX)
    //         return redirect()->route('agent.properties.index')
    //             ->with('success', 'Annonce créée avec succès!');

    //     } catch (\Exception $e) {
    //         // Gestion des erreurs
    //         \Log::error('Erreur lors de la création d\'une annonce: ' . $e->getMessage());

    //         if ($request->ajax() || $request->wantsJson()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Une erreur est survenue lors de la création de l\'annonce.',
    //                 'error' => $e->getMessage()
    //             ], 500);
    //         }

    //         return back()->withInput()->withErrors(['error' => 'Une erreur est survenue lors de la création de l\'annonce.']);
    //     }
    // }


    public function store(Request $request)
    {
        // dd($request);
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'property_type' => 'required|string|max:100',
            'transaction_type' => 'required|in:vendre,location',
            'condition' => 'required|string|in:bon_etat,occasion,neuf', // ➔ Ajout de la validation pour la "condition"
            'price' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:1',
            'rooms' => 'nullable|integer|min:0',
            'status' => 'nullable|string|in:disponible,non_disponible',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . date('Y'),
            'floor' => 'nullable|integer|min:0',
            'features' => 'nullable|array',
            'features.*' => 'string|in:elevator,parking,garage,balcony,terrace,garden,pool,air_conditioning',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'description' => 'required|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'cover_photo' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        try {
            // Création de l'annonce avec create()
            $property = Property::create([
                'user_id' => auth()->id(),
                'title' => $validated['title'],
                'category_id' => $validated['property_type'],
                'type_transaction' => $validated['transaction_type'],
                'condition' => $validated['condition'],
                'price' => $validated['price'],
                'surface' => $validated['surface'],
                'pieces' => $validated['rooms'] ?? null,
                'chambres' => $validated['bedrooms'] ?? null,
                'salle_de_bain' => $validated['bathrooms'] ?? null,
                'age' => $validated['year_built'] ?? null,
                'etages' => $validated['floor'] ?? null,
                'equipement' => isset($validated['features']) ? json_encode($validated['features']) : json_encode([]),
                'adresse' => $validated['address'],
                'ville' => $validated['city'],
                'code_postal' => $validated['postal_code'],
                'pays' => $validated['country'],
                'description' => $validated['description'],
                'status' => $validated['status'] ?? 'disponible',
                // 'is_published' => $validated['is_published'] ?? false,
            ]);

            // Traitement des photos
            $coverPhotoId = null;

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $originalName = $photo->getClientOriginalName();
                    $path = $photo->store('properties/' . $property->id, 'public');
            
                    $isPrimary = $request->has('cover_photo') && $request->cover_photo === $originalName;
            
                    $propertyImage = PropertyImage::create([
                        'annonce_id' => $property->id,
                        'image_url' => $path,
                        'is_primary' => $isPrimary,
                    ]);
            
                    if ($isPrimary) {
                        $coverPhotoId = $propertyImage->id;
                    }
                }
            
                // Mise à jour de la photo de couverture
                if (isset($coverPhotoId)) {
                    $property->update([
                        'cover_image_id' => $coverPhotoId,
                    ]);
                }
            }
            
            // if ($request->hasFile('photos')) {
            //     $coverPhotoIndex = $request->input('cover_photo'); // Récupère l'index de la photo de couverture

            //     foreach ($request->file('photos') as $index => $photo) {
            //         $path = $photo->store('profile', 'public'); // Stockage dans storage/app/public/profile

            //         $isPrimary = ($index === 0 && is_null($coverPhotoIndex)) ||
            //             ($coverPhotoIndex === 'photo-' . $index);

            //         $propertyImage = PropertyImage::create([
            //             'annonce_id' => $property->id,
            //             'image_url' => $path, // Stocke juste le nom du fichier
            //             'is_primary' => $isPrimary,
            //             'order' => $index + 1
            //         ]);

            //         if ($isPrimary) {
            //             $property->update(['cover_image_id' => $propertyImage->id]);
            //         }
            //     }
            // }

            // Réponse JSON pour AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Annonce créée avec succès!',
                    'property' => $property,
                    'redirect' => route('agentsList')
                ]);
            }

            // Redirection classique
            return redirect()->route('agentsList')
                ->with('success', 'Annonce créée avec succès!');
        } catch (\Exception $e) {
            log::error('Erreur lors de la création d\'une annonce: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue lors de la création de l\'annonce.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withInput()->withErrors(['error' => 'Une erreur est survenue lors de la création de l\'annonce.']);
        }
    }
    public function show($id)
    {
        $property = Property::with('images')->findOrFail($id);
        // dd($property);
        return view('properties.show', compact('property'));
    }

    public function update(Request $request, Property $property)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'property_type' => 'required|string|max:100',
        'transaction_type' => 'required|in:vendre,location',
        'condition' => 'required|string|in:bon_etat,occasion,neuf',
        'price' => 'required|numeric|min:0',
        'surface' => 'required|numeric|min:1',
        'rooms' => 'nullable|integer|min:0',
        'status' => 'nullable|string|in:disponible,non_disponible',
        'bedrooms' => 'nullable|integer|min:0',
        'bathrooms' => 'nullable|integer|min:0',
        'year_built' => 'nullable|integer|min:1800|max:' . date('Y'),
        'floor' => 'nullable|integer|min:0',
        'features' => 'nullable|array',
        'features.*' => 'string|in:elevator,parking,garage,balcony,terrace,garden,pool,air_conditioning',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
        'postal_code' => 'required|string|max:20',
        'country' => 'required|string|max:100',
        'description' => 'required|string',
        'photos' => 'nullable|array',
        'photos.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        'cover_photo' => 'nullable|string',
        'is_published' => 'nullable|boolean',
    ]);

    try {
        $property->update([
            'title' => $validated['title'],
            'category_id' => $validated['property_type'],
            'type_transaction' => $validated['transaction_type'],
            'condition' => $validated['condition'],
            'price' => $validated['price'],
            'surface' => $validated['surface'],
            'pieces' => $validated['rooms'] ?? null,
            'chambres' => $validated['bedrooms'] ?? null,
            'salle_de_bain' => $validated['bathrooms'] ?? null,
            'age' => $validated['year_built'] ?? null,
            'etages' => $validated['floor'] ?? null,
            'equipement' => isset($validated['features']) ? json_encode($validated['features']) : json_encode([]),
            'adresse' => $validated['address'],
            'ville' => $validated['city'],
            'code_postal' => $validated['postal_code'],
            'pays' => $validated['country'],
            'description' => $validated['description'],
            'status' => $validated['status'] ?? 'disponible',
        ]);

        $coverPhotoId = null;

        if ($request->hasFile('photos')) {
            // $property->images()->delete();

            foreach ($request->file('photos') as $photo) {
                $originalName = $photo->getClientOriginalName();
                $path = $photo->store('properties/' . $property->id, 'public');

                $isPrimary = $request->has('cover_photo') && $request->cover_photo === $originalName;

                $image = PropertyImage::create([
                    'annonce_id' => $property->id,
                    'image_url' => $path,
                    'is_primary' => $isPrimary,
                ]);

                if ($isPrimary) {
                    $coverPhotoId = $image->id;
                }
            }
            if ($coverPhotoId) {
                $property->images()->update(['is_primary' => false]);
                PropertyImage::where('id', $coverPhotoId)->update(['is_primary' => true]);

                
                $property->update(['cover_image_id' => $coverPhotoId]);
            }
        }

        return redirect()->route('agentsList')->with('success', 'Annonce mise à jour avec succès !');

    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
    }
}

public function destroy($id)
{
    // dd(auth()->user()->role);
    $property = Property::findOrFail($id);

    if ($property->photos) {
        $photos = json_decode($property->photos, true);
        foreach ($photos as $photo) {
            $filePath = public_path('uploads/' . $photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
    $property->delete();
    if (auth()->user()->role->name === 'admin') {
      
        return redirect()->back()->with('success', 'Annonce supprimée avec succès.');
    } else {
        return redirect()->route('profile.agent', ['id' => auth()->id()])
                         ->with('success', 'Annonce supprimée avec succès.');
    }
    
}

public function search(Request $request)
{
    $query = Property::query();

    // Filtrer par type de bien (catégorie)
    if ($request->filled('property_type')) {
        $query->where('category_id', $request->input('property_type'));
    }

    // Filtrer par ville
    if ($request->filled('city')) {
        $query->where('ville', 'like', '%' . $request->input('city') . '%');
    }

    // Filtrer par prix maximum
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->input('max_price'));
    }

    // Ajouter d'autres filtres si nécessaire (surface min, chambres, etc.)

    // Obtenir les résultats paginés
    $properties = $query->latest()->paginate(10);

    // Passer les catégories pour les afficher dans la recherche
    $categories = Category::all();

    return view('home', compact('properties', 'categories'));
}

public function showAnnonces(){
    $properties = Property::with('coverImage')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    // dd($properties);
    return view('admin.annonces', compact('properties'));
}

}
