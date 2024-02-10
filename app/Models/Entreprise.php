<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'logo',
        'slogan',
        'industrie',
        'description',
    ];

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
