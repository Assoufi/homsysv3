@extends('layouts.front2')
@section('titre')
    {!! $meta['title'] !!} Infos personnels
@stop
@section('content')

    <h3>Mon compte</h3>

<div ng-app="">
    <div ng-hide="showme">
        <div class="container" align="left" style="width: 100%;">
            <div class="panel panel-default">
                <div class="panel-heading">Informations Personnelles</div>
                <div class="panel-body">
                    <div class="form-group  {{ $errors->has('civilite_candidat') ? 'has-error' : '' }}">
                        <label for="civilite_candidat">Civilité</label>
                        <select name="civilite_candidat" id="civilite_candidat" class="form-control" disabled="disabled">
                            <option value="Mr" {{ $candidat->civilite_candidat == 'Mr' ? 'selected' : '' }}>Mr</option>
                            <option value="Mme" {{ $candidat->civilite_candidat == 'Mme' ? 'selected' : '' }}>Mme/Mlle</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('civilite_candidat') }}</span>
                    </div>
                    <div class="form-group  {{ $errors->has('nom_condidat') ? 'has-error' : '' }}">
                        <label for="nom_condidat">Nom</label>
                        <input type="text" name="nom_condidat" id="nom_condidat" value="{{ $candidat->nom_condidat }}" class="form-control" disabled="disabled" maxlength="100">
                        <span class="text-danger">{{ $errors->first('nom_condidat') }}</span>
                    </div>
                    <div class="form-group  {{ $errors->has('prenom_condidat') ? 'has-error' : '' }}">
                        <label for="prenom_condidat">Prénom</label>
                        <input type="text" name="prenom_condidat" id="prenom_condidat" value="{{ $candidat->prenom_condidat }}" class="form-control" disabled="disabled" maxlength="100">
                        <span class="text-danger">{{ $errors->first('prenom_condidat') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ $candidat->email }}" class="form-control" disabled="disabled" maxlength="60">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                     <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                        <label for="telephone">Téléphone</label>
                        <input type="number" name="telephone" id="telephone" value="{{ $candidat->telephone }}" class="form-control" disabled="disabled">
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Informations Professionnelles</div>
                <div class="panel-body">
                    <div class="form-group  {{ $errors->has('niveau') ? 'has-error' : '' }}">
                        <label for="niveau">Niveau d'études</label>
                        <select name="niveau" id="niveau" class="form-control" disabled="disabled">
                            @foreach(['Bac+2' => 'Bac+2', 'Bac+3' => 'Bac+3', 'Bac+4' => 'Bac+4', 'Bac+5' => 'Bac+5 et plus'] as $key => $value)
                                <option value="{{ $key }}" {{ $candidat->niveau == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('niveau') }}</span>
                    </div>
                     <div class="form-group  {{ $errors->has('experience') ? 'has-error' : '' }}">
                        <label for="experience">Expérience</label>
                        <select name="experience" id="experience" class="form-control" disabled="disabled">
                            @foreach(['0_1' => 'Moins de 1 an', '1_3' => 'De 1 à 3 ans', '3_5' => 'De 3 à 5 ans', '5_10' => 'De 5 à 10 ans', '10_30' => 'Plus de 10 ans'] as $key => $value)
                                <option value="{{ $key }}" {{ $candidat->experience == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('experience') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="fonction_candidat">Fonction actuelle</label>
                        <input type="text" name="fonction_candidat" id="fonction_candidat" value="{{ $candidat->fonction_candidat }}" class="form-control" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="entreprise_candidat">Entreprise actuelle</label>
                        <input type="text" name="entreprise_candidat" id="entreprise_candidat" value="{{ $candidat->entreprise_candidat }}" class="form-control" disabled="disabled">
                    </div>
                    <div class="form-group {{ $errors->has('commentaire') ? 'has-error' : '' }}">
                        <label for="commentaire">Commentaire (facultatif)</label>
                        <textarea name="commentaire" id="commentaire" class="form-control" disabled="disabled">{{ $candidat->commentaire }}</textarea>
                        <span class="text-danger">{{ $errors->first('commentaire') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="date_creation">Date Création</label>
                        <input type="text" name="date_creation" id="date_creation" value="{{ $candidat->created_at }}" class="form-control" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="derniere_modification">Dernière Modification</label>
                        <input type="text" name="derniere_modification" id="derniere_modification" value="{{ $candidat->updated_at }}" class="form-control" disabled="disabled">
                    </div>
                    <a href="{{url('/candidats/modify',['id'=>$candidat->id_candidat])}}" class="btn btn-success" align="right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editer</a>
                </div>
            </div>
        </div>

    </div>


</div>

    @stop
