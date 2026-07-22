@extends('layouts.front2')

@section('titre')

    {!! $meta['title'] !!}

@stop

@section('content')



    <form action="{{ url('candidats/update') }}" method="POST">
        @csrf

        <input type="hidden" name="id_candidat" value="{{ $candidat->id_candidat }}">
        <input type="hidden" name="mode" value="{{ $mode }}">

        <div class="container" align="left" style="width: 100%;">

            <h3>Référencer votre profil dans notre base de compétences</h3>

            <div class="panel panel-default">

                <div class="panel-heading">Informations Personnelles</div>

                <div class="panel-body">

                    <div class="form-group  {{ $errors->has('civilite_candidat') ? 'has-error' : '' }}">

                        <label for="civilite_candidat">Civilité</label>

                        <select name="civilite_candidat" id="civilite_candidat" class="form-control">
                            <option value="Mr" {{ old('civilite_candidat', $candidat->civilite_candidat ?? '') == 'Mr' ? 'selected' : '' }}>Mr</option>
                            <option value="Mme" {{ old('civilite_candidat', $candidat->civilite_candidat ?? '') == 'Mme' ? 'selected' : '' }}>Mme/Mlle</option>
                        </select>

                        <span class="text-danger">{{ $errors->first('civilite_candidat') }}</span>

                    </div>

                    <div class="form-group  {{ $errors->has('nom_condidat') ? 'has-error' : '' }}">

                        <label for="nom_condidat">Nom</label><span class="required">*</span>

                        <input type="text" id="nom_condidat" name="nom_condidat" value="{{ old('nom_condidat', $candidat->nom_condidat ?? '') }}" class="form-control" required maxlength="100">

                        <span class="text-danger">{{ $errors->first('nom_condidat') }}</span>

                    </div>

                    <div class="form-group  {{ $errors->has('prenom_condidat') ? 'has-error' : '' }}">

                        <label for="prenom_condidat">Prénom</label><span class="required">*</span>

                        <input type="text" id="prenom_condidat" name="prenom_condidat" value="{{ old('prenom_condidat', $candidat->prenom_condidat ?? '') }}" class="form-control" required maxlength="100">

                        <span class="text-danger">{{ $errors->first('prenom_condidat') }}</span>

                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                        <label for="email">Email</label>

                        <input type="email" id="email" name="email" value="{{ old('email', $candidat->email ?? '') }}" class="form-control" readonly maxlength="60">

                        <span class="text-danger">{{ $errors->first('email') }}</span>

                    </div>

                     <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">

                        <label for="telephone">Téléphone</label><span class="required">*</span>

                        <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $candidat->telephone ?? '') }}" class="form-control" required maxlength="30">

                        <span class="text-danger">{{ $errors->first('telephone') }}</span>

                    </div>

                </div>

            </div>



            <div class="panel panel-default">

                <div class="panel-heading">Informations Professionnelles</div>

                <div class="panel-body">

                    <div class="form-group  {{ $errors->has('niveau') ? 'has-error' : '' }}">

                        <label for="niveau">Niveau d'études</label>

                        <select name="niveau" id="niveau" class="form-control">
                            <option value="Bac+2" {{ old('niveau', $candidat->niveau ?? '') == 'Bac+2' ? 'selected' : '' }}>Bac+2</option>
                            <option value="Bac+3" {{ old('niveau', $candidat->niveau ?? '') == 'Bac+3' ? 'selected' : '' }}>Bac+3</option>
                            <option value="Bac+4" {{ old('niveau', $candidat->niveau ?? '') == 'Bac+4' ? 'selected' : '' }}>Bac+4</option>
                            <option value="Bac+5 et plus" {{ old('niveau', $candidat->niveau ?? '') == 'Bac+5 et plus' ? 'selected' : '' }}>Bac+5 et plus</option>
                        </select>

                        <span class="text-danger">{{ $errors->first('niveau') }}</span>

                    </div>

                     <div class="form-group  {{ $errors->has('experience') ? 'has-error' : '' }}">

                        <label for="experience">Expérience</label>

                        <select name="experience" id="experience" class="form-control">
                            <option value="0_1" {{ old('experience', $candidat->experience ?? '') == '0_1' ? 'selected' : '' }}>Moins de 1 an</option>
                            <option value="1_3" {{ old('experience', $candidat->experience ?? '') == '1_3' ? 'selected' : '' }}>De 1 à 3 ans</option>
                            <option value="3_5" {{ old('experience', $candidat->experience ?? '') == '3_5' ? 'selected' : '' }}>De 3 à 5 ans</option>
                            <option value="5_10" {{ old('experience', $candidat->experience ?? '') == '5_10' ? 'selected' : '' }}>De 5 à 10 ans</option>
                            <option value="10_30" {{ old('experience', $candidat->experience ?? '') == '10_30' ? 'selected' : '' }}>Plus de 10 ans</option>
                        </select>

                        <span class="text-danger">{{ $errors->first('experience') }}</span>

                    </div>





                    <div class="form-group">

                        <label for="fonction_candidat">Fonction actuelle</label>

                        <input type="text" id="fonction_candidat" name="fonction_candidat" value="{{ old('fonction_candidat', $candidat->fonction_candidat ?? '') }}" class="form-control" maxlength="100">

                    </div>

                    <div class="form-group">

                        <label for="entreprise_candidat">Entreprise actuelle</label>

                        <input type="text" id="entreprise_candidat" name="entreprise_candidat" value="{{ old('entreprise_candidat', $candidat->entreprise_candidat ?? '') }}" class="form-control" maxlength="100">

                    </div>

                    <div class="form-group {{ $errors->has('commentaire') ? 'has-error' : '' }}">

                        <label for="commentaire">Commentaire (facultatif)</label><small class="pull-right">limite de 2000 caractères</small>

                        <textarea name="commentaire" id="commentaire" rows="12" cols="54" class="form-control" maxlength="2000">{{ old('commentaire', $candidat->commentaire ?? '') }}</textarea>

                        <span class="text-danger">{{ $errors->first('commentaire') }}</span>

                    </div>

                </div>

            </div>



            <div class="form-group">

                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button>

                <a href="{{url('/candidats/show/'.$candidat->id_candidat)}}"  class="btn btn-info" align="right"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Retour</a>                

            </div>

        </form>



        </div>











@stop

