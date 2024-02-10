<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

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
}
