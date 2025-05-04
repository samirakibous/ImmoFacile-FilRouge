<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileAgent extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'email',
        'adresse',
        'a_propos',
        'website',
        'facebook',
        'instagram',
        'x',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
