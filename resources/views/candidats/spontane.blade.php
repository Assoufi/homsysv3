@extends('layouts.front2')

@section('titre')

    {!! $meta['title'] !!}

@stop

@section('content')

    <h3>Référencer votre CV dans notre base de compétences</h3>



    <form action="{{ url('mails/postul') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="id_offre" value="{{$offre->id_offre}}">

        <div class="form-group  {{ $errors->has('nom') ? 'has-error' : '' }}">

            <label for="nom">Votre nom / prénom</label><span class="required">*</span>

            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="form-control" required maxlength="100">

            <span class="text-danger">{{ $errors->first('nom') }}</span>

        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

            <label for="email">Votre adresse mail</label><span class="required">*</span>

            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required maxlength="100">

            <span class="text-danger">{{ $errors->first('email') }}</span>

        </div>

        <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">

            <label for="telephone">Téléphone</label>

            <input type="number" id="telephone" name="telephone" value="{{ old('telephone') }}" class="form-control" maxlength="30">

            <span class="text-danger">{{ $errors->first('telephone') }}</span>

        </div>

        <div class="form-group {{ $errors->has('tjm') ? 'has-error' : '' }}">

            <label for="tjm">Tarif Journalier/Salaire en DH</label><span class="required">*</span>

            <input type="number" id="tjm" name="tjm" value="{{ old('tjm') }}" class="form-control" required maxlength="10">

            <span class="text-danger">{{ $errors->first('tjm') }}</span>

        </div>

        <div class="form-group {{ $errors->has('disponibilite') ? 'has-error' : '' }}">

            <label for="disponibilite">Disponibilité/Préavis</label><span class="required">*</span>

            <input type="text" id="disponibilite" name="disponibilite" value="{{ old('disponibilite') }}" class="form-control" required maxlength="100">

            <span class="text-danger">{{ $errors->first('disponibilite') }}</span>

        </div>

        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">

            <label for="message">Message</label><small class="pull-right">limite de 3000 caractères</small>

            <textarea name="message" id="message" rows="12" cols="54" class="form-control" maxlength="3000">{{ old('message') }}</textarea>

            <span class="text-danger">{{ $errors->first('message') }}</span>

        </div>

        <div class="form-group {{ $errors->has('cv') ? 'has-error' : '' }}">

            <label for="cv">Joindre CV</label><span class="required">*</span>

            <input type="file" name="cv" class="form-control" required accept=".doc, .docx,.pdf"></input>

            <span class="text-danger">{{ $errors->first('cv') }}</span>

        </div>

        <div class="form-group">

            <small>- Le fichier doit peser moins de 1 Mo </small> <br>

            <small>- Extensions autorisées : doc docx pdf </small>

        </div>





        <div class="form-group" align="center">

            <button type="submit" class="btn btn-info">Postuler</button>

            <a href="{{url('offres')}}" class="btn btn-warning"> Retour aux offres</a>

        </div>
    </form>



@stop

