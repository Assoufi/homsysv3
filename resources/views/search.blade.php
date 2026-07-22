@extends('template')
@section('main')
    <h3>Holla</h3>
    @if (count($articles) === 0)
        ... html showing no articles found
    @elseif (count($articles) >= 1)
        ... print out results
        @foreach($articles as $article)
            <article>
                <h2>{{$article->titre_offre}}</h2></a>
                <p align="justify">{{$article->description_offre}}</p>

                <a href="{{url('offres',['id'=>$article->id_offre])}}" class="btn btn-warning"> <h5>Découvrez l'offre{{$article->id_offre}}</h5></a>
            </article>
            <br><br>
        @endforeach
    @endif

	@stop

