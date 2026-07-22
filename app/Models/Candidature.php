<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'disponibilite',
        'tjm',
        'message',
        'offre_id',
        'cv_id',
    ];
}
