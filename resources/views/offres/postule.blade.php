@extends('layouts.front2')

@section('titre')
   {!! $meta['title'] !!}
@stop

@section('content')
    <div class="homsys-main-content">
        <div class="homsys-main-section">
            <div class="container">
                <div class="row">
                    <div class="homsys-column-12">
                        <div class="homsys-typo-wrap">
                            <div class="homsys-jobdetail-content homsys-apply-form-container">
                                <div class="homsys-content-title">
                                    <h2>Postuler à l'offre : {{$offre->titre_offre}}</h2>
                                    <p class="homsys-form-subtitle">Complétez le formulaire ci-dessous pour soumettre votre candidature.</p>
                                </div>

                                <form action="{{ url('mails/postul') }}" method="POST" enctype="multipart/form-data" class="homsys-modern-form">
                                    @csrf
                                    <input type="hidden" name="id_offre" value="{{$offre->id_offre}}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
                                                <label for="nom" class="required">Votre nom et prénom</label>
                                                <div class="homsys-input-wrap">
                                                    <i class="fa fa-user"></i>
                                                    <input type="text" name="nom" id="nom" class="form-control" required maxlength="100" value="{{ Request::old('nom') }}" placeholder="Ex: Jean Dupont">
                                                </div>
                                                <span class="text-danger small">{{ $errors->first('nom') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                <label for="email" class="required">Votre adresse e-mail</label>
                                                <div class="homsys-input-wrap">
                                                    <i class="fa fa-envelope"></i>
                                                    <input type="email" name="email" id="email" class="form-control" required maxlength="100" value="{{ Request::old('email') }}" placeholder="jean.dupont@email.com">
                                                </div>
                                                <span class="text-danger small">{{ $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                                <label for="telephone">Téléphone</label>
                                                <div class="homsys-input-wrap">
                                                    <i class="fa fa-phone"></i>
                                                    <input type="tel" name="telephone" id="telephone" class="form-control" maxlength="30" value="{{ Request::old('telephone') }}" placeholder="Ex: 06 12 34 56 78">
                                                </div>
                                                <span class="text-danger small">{{ $errors->first('telephone') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('tjm') ? 'has-error' : '' }}">
                                                <label for="tjm" class="required">{{ $offre->type_offre == 'Freelance' ? 'Tarif Journalier (TJM) en DH' : 'Salaire souhaité en DH' }}</label>
                                                <div class="homsys-input-wrap">
                                                    <i class="fa fa-money"></i>
                                                    <input type="number" name="tjm" id="tjm" class="form-control" required maxlength="10" value="{{ Request::old('tjm') }}" placeholder="Ex: 500">
                                                </div>
                                                <span class="text-danger small">{{ $errors->first('tjm') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('disponibilite') ? 'has-error' : '' }}">
                                                <label for="disponibilite" class="required">Disponibilité / Préavis</label>
                                                <div class="homsys-input-wrap">
                                                    <i class="fa fa-clock-o"></i>
                                                    <select name="disponibilite" id="disponibilite" class="form-control" required>
                                                        <option value="Immédiate" {{ old('disponibilite') == 'Immédiate' ? 'selected' : '' }}>Immédiate</option>
                                                        <option value="2 semaines" {{ old('disponibilite') == '2 semaines' ? 'selected' : '' }}>2 semaines</option>
                                                        <option value="1 Mois" {{ old('disponibilite') == '1 Mois' ? 'selected' : '' }}>1 Mois</option>
                                                        <option value="2 Mois" {{ old('disponibilite') == '2 Mois' ? 'selected' : '' }}>2 Mois</option>
                                                        <option value="3 Mois" {{ old('disponibilite') == '3 Mois' ? 'selected' : '' }}>3 Mois</option>
                                                    </select>
                                                </div>
                                                <span class="text-danger small">{{ $errors->first('disponibilite') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('cv') ? 'has-error' : '' }}">
                                                <label for="cv" class="required">Joindre votre CV (PDF, DOC, DOCX)</label>
                                                <div class="homsys-file-input">
                                                    <input type="file" name="cv" id="cv" class="form-control" required accept=".doc, .docx, .pdf">
                                                    <small class="text-muted">Max: 1 Mo. Extensions: .pdf, .doc, .docx</small>
                                                </div>
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

                                    <div class="homsys-form-actions">
                                        <button type="submit" class="homsys-applyjob-btn">Envoyer ma candidature</button>
                                        <a href="{{ url('offres') }}" class="homsys-sendmessage-btn">Annuler</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
    });
</script>
@stop