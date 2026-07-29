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
    .cv-hint {
        display: block;
        font-weight: 600;
        color: #d9534f;
        font-size: 0.88rem;
        margin-top: 5px;
        margin-bottom: 8px;
    }
    .btn-submit-custom {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-size: 1.1rem !important;
        font-weight: 700 !important;
        padding: 12px 35px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
    }
    .btn-submit-custom:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
</style>

    <form method="POST" action="{{ url('candidats/store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_candidat" value="{{ $id_user }}">
    <input type="hidden" name="mode" value="{{ $mode }}">
    
    <div class="container" align="left" style="width: 100%; max-width: 900px; margin: 0 auto;">
        <div class="spontane-header">
            <h3>Référencer votre profil dans notre base de compétences</h3>
        </div>

        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-user"></i> Informations Personnelles</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 form-group {{ $errors->has('civilite_candidat') ? 'has-error' : '' }}">
                        <label for="civilite_candidat">Civilité</label>
                        <select name="civilite_candidat" class="form-control">
                            <option value="Mr" {{ old('civilite_candidat', @$candidat->civilite_candidat) == 'Mr' ? 'selected' : '' }}>Mr</option>
                            <option value="Mme" {{ old('civilite_candidat', @$candidat->civilite_candidat) == 'Mme' ? 'selected' : '' }}>Mme/Mlle</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('civilite_candidat') }}</span>
                    </div>
                    <div class="col-md-4 form-group {{ $errors->has('nom_condidat') ? 'has-error' : '' }}">
                        <label for="nom_condidat">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom_condidat" value="{{ old('nom_condidat', @$candidat->nom_condidat) }}" class="form-control" required maxlength="100" placeholder="Ex: Dupont">
                        <span class="text-danger">{{ $errors->first('nom_condidat') }}</span>
                    </div>
                    <div class="col-md-4 form-group {{ $errors->has('prenom_condidat') ? 'has-error' : '' }}">
                        <label for="prenom_condidat">Prénom <span class="text-danger">*</span></label>
                        <input type="text" name="prenom_condidat" value="{{ old('prenom_condidat', @$candidat->prenom_condidat) }}" class="form-control" required maxlength="100" placeholder="Ex: Jean">
                        <span class="text-danger">{{ $errors->first('prenom_condidat') }}</span>
                    </div>
                </div>

                <div class="row">
                    @if ($mode == 'spontane')
                    <div class="col-md-6 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email', @$candidat->email) }}" class="form-control" required maxlength="60" placeholder="Ex: jean.dupont@example.com">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    @endif
                    <div class="col-md-6 form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                        <label for="telephone">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="telephone" value="{{ old('telephone', @$candidat->telephone) }}" class="form-control" maxlength="30" required placeholder="Ex: 0612345678">
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-file-text"></i> Déposer votre CV</div>
            <div class="panel-body">
                <div class="form-group {{ $errors->has('cv') ? 'has-error' : '' }}">
                    <label for="cv">Joindre CV <span class="text-danger">*</span></label>
                    <small class="cv-hint"><i class="fa fa-info-circle"></i> Le fichier doit peser moins de 1 Mo. Extensions autorisées : doc, docx, pdf</small>
                    <input type="file" name="cv" class="form-control" required accept=".doc,.docx,.pdf">
                    <span class="text-danger">{{ $errors->first('cv') }}</span>
                </div>
            </div>
        </div>

        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-briefcase"></i> Informations Professionnelles</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 form-group {{ $errors->has('niveau') ? 'has-error' : '' }}">
                        <label for="niveau">Niveau d'études</label>
                        <select name="niveau" class="form-control">
                            <option value="Bac+2" {{ old('niveau', @$candidat->niveau) == 'Bac+2' ? 'selected' : '' }}>Bac+2</option>
                            <option value="Bac+3" {{ old('niveau', @$candidat->niveau) == 'Bac+3' ? 'selected' : '' }}>Bac+3</option>
                            <option value="Bac+4" {{ old('niveau', @$candidat->niveau) == 'Bac+4' ? 'selected' : '' }}>Bac+4</option>
                            <option value="Bac+5" {{ old('niveau', @$candidat->niveau) == 'Bac+5' ? 'selected' : '' }}>Bac+5 et plus</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('niveau') }}</span>
                    </div>
                    <div class="col-md-6 form-group {{ $errors->has('experience') ? 'has-error' : '' }}">
                        <label for="experience">Expérience</label>
                        <select name="experience" class="form-control">
                            <option value="0_1" {{ old('experience', @$candidat->experience) == '0_1' ? 'selected' : '' }}>Moins de 1 an</option>
                            <option value="1_3" {{ old('experience', @$candidat->experience) == '1_3' ? 'selected' : '' }}>De 1 à 3 ans</option>
                            <option value="3_5" {{ old('experience', @$candidat->experience) == '3_5' ? 'selected' : '' }}>De 3 à 5 ans</option>
                            <option value="5_10" {{ old('experience', @$candidat->experience) == '5_10' ? 'selected' : '' }}>De 5 à 10 ans</option>
                            <option value="10_30" {{ old('experience', @$candidat->experience) == '10_30' ? 'selected' : '' }}>Plus de 10 ans</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('experience') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="fonction_candidat">Fonction actuelle</label>
                        <input type="text" name="fonction_candidat" value="{{ old('fonction_candidat', @$candidat->fonction_candidat) }}" class="form-control" maxlength="100" placeholder="Ex: Développeur Fullstack">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="entreprise_candidat">Entreprise actuelle</label>
                        <input type="text" name="entreprise_candidat" value="{{ old('entreprise_candidat', @$candidat->entreprise_candidat) }}" class="form-control" maxlength="100" placeholder="Ex: HOMSYS">
                    </div>
                </div>

                <div class="form-group {{ $errors->has('commentaire') ? 'has-error' : '' }}">
                    <label for="commentaire">Commentaire (facultatif)</label><small class="pull-right text-muted">Limite : 2000 caractères</small>
                    <textarea name="commentaire" id="commentaire" rows="6" class="form-control" maxlength="2000" placeholder="Décrivez succinctement votre projet professionnel ou vos motivations...">{{ old('commentaire', @$candidat->commentaire) }}</textarea>
                    <span class="text-danger">{{ $errors->first('commentaire') }}</span>
                </div>
            </div>
        </div>

        <div class="form-group text-center" style="margin-top: 30px; margin-bottom: 40px;">
            <button type="submit" class="btn btn-primary btn-submit-custom" style="background-color: #007bff !important; border-color: #007bff !important; color: #ffffff !important; font-size: 1.1rem !important; font-weight: 700 !important; padding: 12px 35px !important; border-radius: 5px !important; display: inline-block !important;"><i class="fa fa-paper-plane"></i> Enregistrer ma candidature</button>
        </div>
    </div>

    </form>

@stop