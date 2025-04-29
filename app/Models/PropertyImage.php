<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyImage extends Model
{
    use HasFactory;
    protected $table = 'annonce_images';

    protected $fillable = [
        'annonce_id',
        'image_url',
        'order'
    ];

   
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
