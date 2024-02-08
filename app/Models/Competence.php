<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    public function cv()
    {
        return $this->belongsTo(CV::class);
    }
}
