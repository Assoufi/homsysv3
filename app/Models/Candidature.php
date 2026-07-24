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

    public function offre()
    {
        return $this->belongsTo(Offre::class, 'offre_id', 'id_offre');
    }

    public function cv()
    {
        return $this->belongsTo(Cv::class, 'cv_id', 'id_cv');
    }
}
