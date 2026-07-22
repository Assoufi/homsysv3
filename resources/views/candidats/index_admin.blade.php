@extends('layouts.front2')
@section('titre')
    {!! $meta['title'] !!}
@stop
@section('content')

    <section>
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <h3 style="margin: 0;">Liste des candidats</h3>
            <a class="btn btn-info" href="{{url('/candidats/create')}}">
                <i class="fa fa-plus" aria-hidden="true"></i> Ajouter Candidat
            </a>
        </div>
        
        <livewire:search-candidats />
    </section>

@stop
