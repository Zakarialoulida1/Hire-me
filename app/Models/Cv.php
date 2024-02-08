<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
    ];

    public function cursuses()
    {
        return $this->hasMany(Cursus::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }
}

