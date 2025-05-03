<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'user_id',
        'annonce_id',
        'stripe_payment_id',
        'amount',
        'currency',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function annonce()
    {
        return $this->belongsTo(Property::class, 'annonce_id');
    }
    
}

