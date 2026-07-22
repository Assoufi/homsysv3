@extends('layouts.front2')

@section('titre')
    Nouvelle offre HOMSYS
@stop

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="d-flex align-items-center">
                <i class="fa fa-plus mr-2"></i> Nouvelle offre
                <a href="{{ route('offres.index') }}" class="btn btn-outline-secondary ml-auto">
                    <i class="fa fa-backward"></i> Retour
                </a>
            </h2>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
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
                    <label for="date_demarrage">Date Démarrage</label>
                    <input type="text" class="form-control @error('date_demarrage') is-invalid @enderror" id="date_demarrage" name="date_demarrage" value="{{ old('date_demarrage') }}">
                    @error('date_demarrage')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duree">Durée</label>
                    <input type="text" class="form-control @error('duree') is-invalid @enderror" id="duree" name="duree" value="{{ old('duree') }}">
                    @error('duree')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="experience">Expérience</label>
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
                    <label for="competences">Compétences</label>
                    <textarea class="form-control @error('competences') is-invalid @enderror" id="competences" name="competences" rows="10">{{ old('competences') }}</textarea>
                    @error('competences')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="qualites">Qualités</label>
                    <textarea class="form-control @error('qualites') is-invalid @enderror" id="qualites" name="qualites" rows="10">{{ old('qualites') }}</textarea>
                    @error('qualites')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description_offre">Détails</label>
                    <textarea class="form-control @error('description_offre') is-invalid @enderror" id="description_offre" name="description_offre" rows="10">{{ old('description_offre') }}</textarea>
                    @error('description_offre')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('offres.index') }}" class="btn btn-secondary">
                        <i class="fa fa-caret-square-o-left" aria-hidden="true"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
