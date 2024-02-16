<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offre extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'entreprise_id',
        'titre',
        'description',
        'compétences_requises',
        'type_contrat',
        'emplacement',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    // Dans le modèle Offre.php
public function users()
{
    return $this->belongsToMany(User::class);
}

}
