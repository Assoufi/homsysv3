@extends('layouts.front2')

@section('titre')
   {!! $meta['title'] !!}
@stop

@section('content')
<style>
    .postule-page {
        width: 100%;
        max-width: 900px;
        margin: 0 auto 50px;
        padding: 0 15px;
    }
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
    .spontane-header p {
        color: #64748b;
        margin: 8px 0 0;
        font-size: 0.95rem;
    }
    .panel-custom {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        background: #ffffff;
        overflow: hidden;
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
    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 6px;
        display: block;
    }
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        box-shadow: none;
        height: auto;
        padding: 10px 12px;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.12);
    }
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        padding: 11px 28px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
        display: inline-block;
        text-decoration: none !important;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
</style>

<div class="postule-page">
    <div class="spontane-header">
        <h3><i class="fa fa-paper-plane"></i> Postuler à l'offre</h3>
        <p>{{ $offre->titre_offre }}</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-user"></i> Formulaire de candidature</div>
        <div class="panel-body">
            <form action="{{ url('mails/postul') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_offre" value="{{$offre->id_offre}}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
                            <label for="nom">Votre nom et prénom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" id="nom" class="form-control" required maxlength="100" value="{{ Request::old('nom') }}" placeholder="Ex: Jean Dupont">
                            <span class="text-danger small">{{ $errors->first('nom') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Votre adresse e-mail <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required maxlength="100" value="{{ Request::old('email') }}" placeholder="jean.dupont@email.com">
                            <span class="text-danger small">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" name="telephone" id="telephone" class="form-control" maxlength="30" value="{{ Request::old('telephone') }}" placeholder="Ex: 06 12 34 56 78">
                            <span class="text-danger small">{{ $errors->first('telephone') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('tjm') ? 'has-error' : '' }}">
                            <label for="tjm">{{ $offre->type_offre == 'Freelance' ? 'Tarif Journalier (TJM) en DH' : 'Salaire souhaité en DH' }} <span class="text-danger">*</span></label>
                            <input type="number" name="tjm" id="tjm" class="form-control" required maxlength="10" value="{{ Request::old('tjm') }}" placeholder="Ex: 500">
                            <span class="text-danger small">{{ $errors->first('tjm') }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('disponibilite') ? 'has-error' : '' }}">
                            <label for="disponibilite">Disponibilité / Préavis <span class="text-danger">*</span></label>
                            <select name="disponibilite" id="disponibilite" class="form-control" required>
                                <option value="Immédiate" {{ old('disponibilite') == 'Immédiate' ? 'selected' : '' }}>Immédiate</option>
                                <option value="2 semaines" {{ old('disponibilite') == '2 semaines' ? 'selected' : '' }}>2 semaines</option>
                                <option value="1 Mois" {{ old('disponibilite') == '1 Mois' ? 'selected' : '' }}>1 Mois</option>
                                <option value="2 Mois" {{ old('disponibilite') == '2 Mois' ? 'selected' : '' }}>2 Mois</option>
                                <option value="3 Mois" {{ old('disponibilite') == '3 Mois' ? 'selected' : '' }}>3 Mois</option>
                            </select>
                            <span class="text-danger small">{{ $errors->first('disponibilite') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('cv') ? 'has-error' : '' }}">
                            <label for="cv">Joindre votre CV (PDF, DOC, DOCX) <span class="text-danger">*</span></label>
                            <input type="file" name="cv" id="cv" class="form-control" required accept=".doc, .docx, .pdf">
                            <small class="text-muted">Max: 1 Mo. Extensions: .pdf, .doc, .docx</small>
                            <span class="text-danger small">{{ $errors->first('cv') }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                    <label for="message">Message de motivation (Optionnel)</label>
                    <textarea name="message" id="message" rows="5" class="form-control" maxlength="3000" placeholder="Parlez-nous brièvement de votre expérience pour ce poste...">{{ old('message') }}</textarea>
                    <div class="text-right"><small id="charCount" class="text-muted">3000 caractères restants</small></div>
                    <span class="text-danger small">{{ $errors->first('message') }}</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ url('offres') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-submit-blue">
                        <i class="fa fa-paper-plane"></i> Envoyer ma candidature
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(document).ready(function() {
        $('#message').on('input', function() {
            var maxLength = 3000;
            var currentLength = $(this).val().length;
            $('#charCount').text((maxLength - currentLength) + ' caractères restants');
        });

        if ($.fn.fileinput) {
            $("#cv").fileinput({
                showUpload: false,
                maxFileSize: 1024,
                allowedFileTypes: ['pdf', 'doc', 'docx'],
                theme: 'fa',
                language: 'fr',
                browseClass: 'btn btn-outline-secondary',
                removeClass: 'btn btn-outline-danger',
                browseLabel: 'Parcourir',
                removeLabel: 'Retirer'
            });
        }

        $('form').on('submit', function() {
            var $btn = $(this).find('button[type="submit"]');
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Envoi en cours...');
        });
    });
</script>
@stop