@extends('layouts.front2')

@section('titre')
    Nouvelle offre HOMSYS
@stop

@section('content')

<style>
    .create-page {
        width: 100%;
        max-width: 1100px;
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
        min-height: 140px;
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
    .btn-outline-secondary {
        color: #007bff !important;
        border-color: #007bff !important;
    }
    .btn-outline-secondary:hover {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
    }
</style>

<div class="create-page">

    <div class="spontane-header">
        <h3>Nouvelle offre HOMSYS</h3>
        <p>Formulaire de création d&rsquo;une nouvelle offre d&rsquo;emploi</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-plus"></i> Nouvelle offre</div>
        <div class="panel-body">
            <form action="{{ route('offres.store') }}" method="post" id="offre-create-form">
                @csrf

                <div class="form-group">
                    <label for="titre_offre">Titre</label><span class="text-danger">*</span>
                    <input type="text" class="form-control @error('titre_offre') is-invalid @enderror" id="titre_offre" name="titre_offre" value="{{ old('titre_offre') }}" required>
                    @error('titre_offre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ville_offre">Ville</label>
                    <input type="text" class="form-control @error('ville_offre') is-invalid @enderror" id="ville_offre" name="ville_offre" value="{{ old('ville_offre') }}">
                    @error('ville_offre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type_offre">Type</label><span class="text-danger">*</span>
                    <select class="form-control @error('type_offre') is-invalid @enderror" id="type_offre" name="type_offre" required>
                        @foreach($types_offre as $key => $value)
                            <option value="{{ $key }}" {{ old('type_offre', 'Freelance') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('type_offre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <hr>

                <div class="form-group">
                    <label for="date_demarrage">Date D&eacute;marrage</label>
                    <input type="text" class="form-control @error('date_demarrage') is-invalid @enderror" id="date_demarrage" name="date_demarrage" value="{{ old('date_demarrage') }}">
                    @error('date_demarrage')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duree">Dur&eacute;e</label>
                    <input type="text" class="form-control @error('duree') is-invalid @enderror" id="duree" name="duree" value="{{ old('duree') }}">
                    @error('duree')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="experience">Exp&eacute;rience</label>
                    <input type="number" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience') }}">
                    @error('experience')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="formation">Formation</label>
                    <input type="text" class="form-control @error('formation') is-invalid @enderror" id="formation" name="formation" value="{{ old('formation') }}">
                    @error('formation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="client">Client</label>
                    <input type="text" class="form-control @error('client') is-invalid @enderror" id="client" name="client" value="{{ old('client') }}">
                    @error('client')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact') }}">
                    @error('contact')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="poste">Poste</label>
                    <textarea class="form-control @error('poste') is-invalid @enderror" id="poste" name="poste" rows="10">{{ old('poste') }}</textarea>
                    @error('poste')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="profil">Profil</label>
                    <textarea class="form-control @error('profil') is-invalid @enderror" id="profil" name="profil" rows="10">{{ old('profil') }}</textarea>
                    @error('profil')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="competences">Comp&eacute;tences</label>
                    <textarea class="form-control @error('competences') is-invalid @enderror" id="competences" name="competences" rows="10">{{ old('competences') }}</textarea>
                    @error('competences')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="qualites">Qualit&eacute;s</label>
                    <textarea class="form-control @error('qualites') is-invalid @enderror" id="qualites" name="qualites" rows="10">{{ old('qualites') }}</textarea>
                    @error('qualites')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description_offre">D&eacute;tails</label>
                    <textarea class="form-control @error('description_offre') is-invalid @enderror" id="description_offre" name="description_offre" rows="10">{{ old('description_offre') }}</textarea>
                    @error('description_offre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('offres.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-backward"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-submit-blue">
                        <i class="fa fa-floppy-o"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@stop
