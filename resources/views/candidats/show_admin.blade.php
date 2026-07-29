@extends('layouts.front2')
@section('titre')
    {!! $meta['title'] !!}
@stop
@section('content')

<style>
    .spontane-header {
        margin-bottom: 25px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }
    .spontane-header h3 {
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }
    .panel-custom {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        background: #ffffff;
    }
    .panel-custom .panel-heading {
        font-weight: 700;
        font-size: 1.1rem;
        color: #007bff;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        border-left: 5px solid #007bff;
        padding: 12px 18px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .panel-custom .panel-body {
        padding: 20px;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        padding: 12px 35px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
</style>

<div class="container" align="left" style="width: 100%; max-width: 900px; margin: 0 auto;">
    <div class="spontane-header">
        <h3>Consultation Candidat (Espace Admin)</h3>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-user"></i> Informations Personnelles</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="civilite_candidat">Civilité</label>
                    <select name="civilite_candidat" id="civilite_candidat" class="form-control" disabled>
                        <option value="Mr" {{ $candidat->civilite_candidat == 'Mr' ? 'selected' : '' }}>Mr</option>
                        <option value="Mme" {{ $candidat->civilite_candidat == 'Mme' ? 'selected' : '' }}>Mme/Mlle</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="nom_condidat">Nom</label>
                    <input type="text" name="nom_condidat" id="nom_condidat" value="{{ $candidat->nom_condidat }}" class="form-control" disabled maxlength="100">
                </div>
                <div class="col-md-4 form-group">
                    <label for="prenom_condidat">Prénom</label>
                    <input type="text" name="prenom_condidat" id="prenom_condidat" value="{{ $candidat->prenom_condidat }}" class="form-control" disabled maxlength="100">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ $candidat->email }}" class="form-control" disabled maxlength="60">
                </div>
                <div class="col-md-6 form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" value="{{ $candidat->telephone }}" class="form-control" disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-briefcase"></i> Informations Professionnelles</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="niveau">Niveau d'études</label>
                    <select name="niveau" id="niveau" class="form-control" disabled>
                        @foreach(['Bac+2' => 'Bac+2', 'Bac+3' => 'Bac+3', 'Bac+4' => 'Bac+4', 'Bac+5' => 'Bac+5 et plus'] as $key => $value)
                            <option value="{{ $key }}" {{ $candidat->niveau == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="experience">Expérience</label>
                    <select name="experience" id="experience" class="form-control" disabled>
                        @foreach(['0_1' => 'Moins de 1 an', '1_3' => 'De 1 à 3 ans', '3_5' => 'De 3 à 5 ans', '5_10' => 'De 5 à 10 ans', '10_30' => 'Plus de 10 ans'] as $key => $value)
                            <option value="{{ $key }}" {{ $candidat->experience == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="fonction_candidat">Fonction actuelle</label>
                    <input type="text" name="fonction_candidat" id="fonction_candidat" value="{{ $candidat->fonction_candidat }}" class="form-control" disabled>
                </div>
                <div class="col-md-6 form-group">
                    <label for="entreprise_candidat">Entreprise actuelle</label>
                    <input type="text" name="entreprise_candidat" id="entreprise_candidat" value="{{ $candidat->entreprise_candidat }}" class="form-control" disabled>
                </div>
            </div>

            <div class="form-group">
                <label for="commentaire">Commentaire (facultatif)</label>
                <textarea name="commentaire" id="commentaire" rows="5" class="form-control" disabled>{{ $candidat->commentaire }}</textarea>
            </div>
        </div>
    </div>

    <div class="form-group text-center" style="margin-top: 30px; margin-bottom: 40px;">
        <a href="{{url('candidats/delete',['id'=>$candidat->id_candidat])}}" class="btn btn-danger" style="padding: 12px 25px; font-weight: bold;"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</a>
        <a href="{{url('candidats')}}" class="btn btn-default" style="margin-left: 10px; padding: 12px 25px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Liste des candidats</a>
    </div>
</div>

@stop


