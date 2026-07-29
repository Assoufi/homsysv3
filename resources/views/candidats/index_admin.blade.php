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
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .spontane-header h3 {
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        padding: 10px 20px !important;
        border-radius: 5px !important;
        text-decoration: none !important;
        display: inline-block !important;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
</style>

<div class="container" align="left" style="width: 100%; max-width: 1100px; margin: 0 auto; padding-top: 10px; padding-bottom: 40px;">
    <div class="spontane-header">
        <h3>Gestion des candidats</h3>
        <a class="btn btn-submit-blue" href="{{url('/candidats/create')}}">
            <i class="fa fa-plus" aria-hidden="true"></i> Ajouter Candidat
        </a>
    </div>

    <livewire:search-candidats />
</div>

@stop

