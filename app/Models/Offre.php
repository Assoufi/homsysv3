<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = ['titre_offre', 
    'ville_offre', 
    'type_offre', 
    'date_demarrage', 
    'date_fin', 
    'duree', 
    'description_offre', 
    'exp_offre', 
    'poste', 
    'profil', 
    'competences', 
    'qualites',
    'client',
    'contact'];

    protected $primaryKey = 'id_offre';

    public function getDatePublication()
    {
        return isset($this->attributes['created_at']) ? Carbon::parse($this->attributes['created_at'])->format('d/m/Y') : 'N/A';
    }
}
