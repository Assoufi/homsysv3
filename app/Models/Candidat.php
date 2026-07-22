<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $fillable = ['id_candidat', 'cv_candidat', 'civilite_candidat', 
    'nom_condidat', 'prenom_condidat', 'ddn_candidat', 'email', 'telephone', 'niveau', 'experience', 'commentaire', 
    'entreprise_candidat','techno_candidat','fonction_candidat','techno_candidat' ];

    protected $primaryKey = 'id_candidat';
}
