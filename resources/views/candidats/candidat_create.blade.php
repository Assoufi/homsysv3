@extends('layouts.front2')
@section('titre')
    {!! $meta['title'] !!}
@stop

@push('styles')
<style>
    /* ── Panel heading: bold + high-visibility colour ─────────────────────── */
    .panel-heading {
        font-weight: 700;
        font-size: 1.05rem;
        color: #1a4f8a;            /* deep accessible blue — WCAG AA on light bg */
        letter-spacing: 0.02em;
        border-left: 4px solid #1a4f8a;
        padding-left: 10px;
    }

    /* ── CV file-constraint hint: bold + red + left-aligned ───────────────── */
    .cv-hint {
        display: block;            /* own line, full width */
        font-weight: 700;
        color: #c0392b;            /* red, passes WCAG AA against white */
        font-size: 0.85rem;
        text-align: left;
        margin-top: 4px;
    }

    /* ── Responsive: keep readability on small screens ────────────────────── */
    @media (max-width: 576px) {
        .panel-heading {
            font-size: 0.97rem;
        }
        .cv-hint {
            font-size: 0.80rem;
        }
    }
</style>
@endpush

@section('content')


    <form method="POST" action="{{ url('candidats/store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_candidat" value="{{ $id_user }}">
    <input type="hidden" name="mode" value="{{ $mode }}">
    <div class="container" align="left" style="width: 100%;">
      <h3>Référencer votre profil dans notre base de compétences</h3>
        <div class="panel panel-default">
            <div class="panel-heading">Informations Personnelles</div>
            <div class="panel-body">
                <div class="form-group  {{ $errors->has('civilite_candidat') ? 'has-error' : '' }}">
                    <label for="civilite_candidat">Civilité</label>
                    <select name="civilite_candidat" class="form-control">
                        <option value="Mr" {{ old('civilite_candidat', @$candidat->civilite_candidat) == 'Mr' ? 'selected' : '' }}>Mr</option>
                        <option value="Mme" {{ old('civilite_candidat', @$candidat->civilite_candidat) == 'Mme' ? 'selected' : '' }}>Mme/Mlle</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('civilite_candidat') }}</span>
                </div>
                <div class="form-group  {{ $errors->has('nom_condidat') ? 'has-error' : '' }}">
                    <label for="nom_condidat">Nom</label><font color="red"> *</font>
                    <input type="text" name="nom_condidat" value="{{ old('nom_condidat', @$candidat->nom_condidat) }}" class="form-control" required maxlength="100">
                    <span class="text-danger">{{ $errors->first('nom_condidat') }}</span>
                </div>
                <div class="form-group  {{ $errors->has('prenom_condidat') ? 'has-error' : '' }}">
                    <label for="prenom_condidat">Prénom</label><font color="red"> *</font>
                    <input type="text" name="prenom_condidat" value="{{ old('prenom_condidat', @$candidat->prenom_condidat) }}" class="form-control" required maxlength="100">
                    <span class="text-danger">{{ $errors->first('prenom_condidat') }}</span>
                </div>
                @if ($mode == 'spontane')
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Email</label><font color="red"> *</font>
                    <input type="email" name="email" value="{{ old('email', @$candidat->email) }}" class="form-control" required maxlength="60">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                @endif
                 <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                    <label for="telephone">Téléphone</label><font color="red"> *</font>
                    <input type="number" name="telephone" value="{{ old('telephone', @$candidat->telephone) }}" class="form-control" maxlength="30" required>
                    <span class="text-danger">{{ $errors->first('telephone') }}</span>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Déposer votre CV</div>
            <div class="panel-body">
                <div class="form-group {{ $errors->has('cv') ? 'has-error' : '' }}">
                    <label for="cv">Joindre CV</label><font color="red"> *</font>
                    <small class="cv-hint">Le fichier doit peser moins de 1 Mo, les extensions autorisées : doc docx pdf</small>
                    <input type="file" name="cv" class="form-control" required accept=".doc, .docx,.pdf">
                    <span class="text-danger">{{ $errors->first('cv') }}</span>
                </div>
                <div class="form-group">

                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Informations Professionnelles</div>
            <div class="panel-body">
                <div class="form-group  {{ $errors->has('niveau') ? 'has-error' : '' }}">
                    <label for="niveau">Niveau d'études</label>
                    <select name="niveau" class="form-control">
                        <option value="Bac+2" {{ old('niveau', @$candidat->niveau) == 'Bac+2' ? 'selected' : '' }}>Bac+2</option>
                        <option value="Bac+3" {{ old('niveau', @$candidat->niveau) == 'Bac+3' ? 'selected' : '' }}>Bac+3</option>
                        <option value="Bac+4" {{ old('niveau', @$candidat->niveau) == 'Bac+4' ? 'selected' : '' }}>Bac+4</option>
                        <option value="Bac+5" {{ old('niveau', @$candidat->niveau) == 'Bac+5' ? 'selected' : '' }}>Bac+5 et plus</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('niveau') }}</span>
                </div>
                 <div class="form-group  {{ $errors->has('experience') ? 'has-error' : '' }}">
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


                <div class="form-group">
                    <label for="fonction_candidat">Fonction actuelle</label>
                    <input type="text" name="fonction_candidat" value="{{ old('fonction_candidat', @$candidat->fonction_candidat) }}" class="form-control" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="entreprise_candidat">Entreprise actuelle</label>
                    <input type="text" name="entreprise_candidat" value="{{ old('entreprise_candidat', @$candidat->entreprise_candidat) }}" class="form-control" maxlength="100">
                </div>
                <div class="form-group {{ $errors->has('commentaire') ? 'has-error' : '' }}">
                    <label for="commentaire">Commentaire (facultatif)</label><small class="pull-right">limite de 2000 caractères</small>
                    <textarea name="commentaire" id="commentaire" rows="12" cols="54" class="form-control" maxlength="2000">{{ old('commentaire', @$candidat->commentaire) }}</textarea>
                    <span class="text-danger">{{ $errors->first('commentaire') }}</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </div>

    </form>

    @stop