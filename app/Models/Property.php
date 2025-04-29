<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    // public function coverImage()
    // {
    //     return $this->belongsTo(PropertyImage::class, 'cover_image_id');
    // }

    public function coverImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }
    
}
