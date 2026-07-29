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
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-size: 1.1rem !important;
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
        <h3>Référencer votre CV dans notre base de compétences</h3>
    </div>

    <form action="{{ url('mails/postul') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($offre))
        <input type="hidden" name="id_offre" value="{{$offre->id_offre}}">
        @endif

        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-user"></i> Informations Candidat</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
                        <label for="nom">Votre nom / prénom <span class="text-danger">*</span></label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="form-control" required maxlength="100" placeholder="Ex: Jean Dupont">
                        <span class="text-danger">{{ $errors->first('nom') }}</span>
                    </div>

                    <div class="col-md-6 form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Votre adresse mail <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required maxlength="100" placeholder="Ex: jean.dupont@example.com">
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                        <label for="telephone">Téléphone</label>
                        <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" class="form-control" maxlength="30" placeholder="Ex: 0612345678">
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    </div>

                    <div class="col-md-4 form-group {{ $errors->has('tjm') ? 'has-error' : '' }}">
                        <label for="tjm">Tarif Journalier / Salaire (DH) <span class="text-danger">*</span></label>
                        <input type="number" id="tjm" name="tjm" value="{{ old('tjm') }}" class="form-control" required maxlength="10" placeholder="Ex: 3500">
                        <span class="text-danger">{{ $errors->first('tjm') }}</span>
                    </div>

                    <div class="col-md-4 form-group {{ $errors->has('disponibilite') ? 'has-error' : '' }}">
                        <label for="disponibilite">Disponibilité / Préavis <span class="text-danger">*</span></label>
                        <input type="text" id="disponibilite" name="disponibilite" value="{{ old('disponibilite') }}" class="form-control" required maxlength="100" placeholder="Ex: Immédiate">
                        <span class="text-danger">{{ $errors->first('disponibilite') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-file-text"></i> Pièce Jointe</div>
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
            <div class="panel-heading"><i class="fa fa-comment"></i> Informations Complémentaires</div>
            <div class="panel-body">
                <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                    <label for="message">Message</label><small class="pull-right text-muted">Limite : 3000 caractères</small>
                    <textarea name="message" id="message" rows="6" class="form-control" maxlength="3000" placeholder="Décrivez votre expérience ou votre recherche de mission...">{{ old('message') }}</textarea>
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                </div>
            </div>
        </div>

        <div class="form-group text-center" style="margin-top: 30px; margin-bottom: 40px;">
            <button type="submit" class="btn btn-submit-blue" style="background-color: #007bff !important; border-color: #007bff !important; color: #ffffff !important; font-size: 1.1rem !important; font-weight: 700 !important; padding: 12px 35px !important; border-radius: 5px !important;"><i class="fa fa-paper-plane"></i> Enregistrer ma candidature</button>
            <a href="{{url('offres')}}" class="btn btn-default" style="margin-left: 10px; padding: 12px 25px;">Retour aux offres</a>
        </div>
    </form>
</div>

@stop


