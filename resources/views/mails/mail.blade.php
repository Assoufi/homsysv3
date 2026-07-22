@extends('template')
@section('titre')

@stop
@section('main')

    <h2>Mail</h2>
    <div>
        <form method="POST" action="{{ url('mails/send') }}">
        @csrf
    <div>

        <label for="email">email</label>
        <input type="text" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="objet">objet</label>
        <input type="text" name="objet" class="form-control">
    </div>
    <div class="form-group">
        <label for="sujet">sujet</label>
        <textarea name="sujet" class="form-control"></textarea>
    </div>
    <div class="form-group" align="center">
        <button type="submit" class="btn btn-info">Envoyer</button>
    </div>
    </form>
    </div>
@stop