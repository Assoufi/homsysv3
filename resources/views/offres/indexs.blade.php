@extends('template')
@section('titre')
    Liste des offres
    @stop
@section('main')
    <h3>Liste des offres</h3>

    <p>nom : <input type="text" class="form-control" ng-model="name"></p>
    <p ng-bind="name"></p>
    @foreach($offres as $offre)
        <article>
            <h2>{{$offre->titre_offre}}</h2></a>
            <p align="justify">{{$offre->description_offre}}</p>

            <a href="{{url('offres',['id'=>$offre->id_offre])}}" class="btn btn-warning"> <h5>Découvrez l'offre{{$offre->id_offre}}</h5></a>
        </article>
        <br><br>
    @endforeach
	@stop

