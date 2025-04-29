<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;
    protected $table = 'annonces';

    protected $fillable = [
        'user_id',
        'title',
        // 'slug',
        'property_type',
        'type_transaction',
        'category_id',
        'location',
        'status',
        'price',
        'surface',
        'pieces',
        'chambres',
        'salons',
        'salle_de_bain',
        'equipement',
        'status',
        'age',
        'etages',
        'features',
        'adresse',
        'ville',
        'code_postal',
        'pays',
        'description',
        'cover_image_id',
        // 'is_published'
        'condition',
    ];

    protected $casts = [
        'is_primary' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'annonce_id');
    }

    // public function coverImage()
    // {
    //     return $this->belongsTo(PropertyImage::class, 'cover_image_id');
    // }

    public function coverImage()
    {
        return $this->hasOne(PropertyImage::class, 'annonce_id')->where('is_primary', true);
    }

    // public function getFirstImageUrl()
    // {
    //     // Prend la première image disponible (primaire ou non)
    //     $image = $this->images->sortByDesc('is_primary')->first();

    //     if ($image && $image->image_url) {
    //         // Vérifiez le chemin exact de stockage
    //         return Storage::exists("public/profile/{$image->image_url}") 
    //                ? asset("storage/profile/{$image->image_url}")
    //                : asset('images/default-property.jpg');
    //     }

    //     return asset('images/default-property.jpg');
    // }

    public function getFirstImageUrl()
    {
        if ($this->coverImage) {
            return asset("storage/{$this->coverImage->image_url}");
        }

        $image = $this->images->first();
        return $image ? asset("storage/{$image->image_url}")
            : asset('images/default-property.jpg');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
