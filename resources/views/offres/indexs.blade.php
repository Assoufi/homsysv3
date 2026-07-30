@extends('layouts.front2')

@section('titre')
    Liste des offres
@stop

@section('content')
<style>
    .offres-page {
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
    .offre-item {
        padding: 18px 0;
        border-bottom: 1px solid #e2e8f0;
    }
    .offre-item:last-child {
        border-bottom: none;
    }
    .offre-item h4 {
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 8px;
    }
    .offre-item h4 a {
        color: #2c3e50;
        text-decoration: none;
    }
    .offre-item h4 a:hover {
        color: #007bff;
    }
    .offre-item p {
        color: #475569;
        line-height: 1.6;
        margin: 0 0 12px;
        font-size: 0.95rem;
    }
    .btn-outline-offre {
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 5px;
        padding: 8px 18px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s ease;
    }
    .btn-outline-offre:hover {
        background: #007bff;
        color: #fff;
        text-decoration: none;
    }
</style>

<div class="offres-page">
    <div class="spontane-header">
        <h3><i class="fa fa-briefcase"></i> Liste des offres</h3>
        <p>Découvrez toutes nos offres d'emploi</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-list"></i> Offres disponibles</div>
        <div class="panel-body">
            @foreach($offres as $offre)
                <div class="offre-item">
                    <h4><a href="{{ url('offres', ['id' => $offre->id_offre]) }}">{{ $offre->titre_offre }}</a></h4>
                    <p>{{ Str::limit(strip_tags($offre->description_offre), 300) }}</p>
                    <a href="{{ url('offres', ['id' => $offre->id_offre]) }}" class="btn-outline-offre">
                        <i class="fa fa-eye"></i> Découvrir l'offre
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop

