@extends('layouts.front2')
@section('titre')
    {!! $meta['title'] !!}
@stop
@section('content')

<style>
    .candidats-page {
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

<div class="candidats-page">

    <div class="spontane-header">
        <h3>Gestion des candidats</h3>
        <p>Consultez, ajoutez et gérez les candidats inscrits</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-users"></i> Liste des candidats</div>
        <div class="panel-body">
            <a class="btn btn-submit-blue" href="{{url('/candidats/create')}}">
                <i class="fa fa-plus" aria-hidden="true"></i> Ajouter Candidat
            </a>
            <livewire:search-candidats />
        </div>
    </div>

</div>

@stop

