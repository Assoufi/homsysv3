@extends('layouts.front2')

@section('titre')
    Candidat HOMSYS :: {!! $candidat->nom_condidat !!} {!! $candidat->prenom_condidat !!}
@stop

@section('content')
<div class="homsys-main-content">
    <div class="homsys-main-section">
        <div class="container">
            <h2 class="mb-4">Bienvenue {{ $candidat->civilite_candidat }}. {{ $candidat->nom_condidat }}</h2>

            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <a href="{{ url('/offres/') }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                                <i class="fa fa-briefcase fa-2x mb-2"></i>
                                <h5>Offres</h5>
                                <p>Consulter les offres disponibles</p>
                            </a>
                        </div>
                        <div class="col-md-6 mb-4">
                            <a href="{{ url('/candidats/modify', $candidat->id_candidat) }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #1abc9c, #16a085);">
                                <i class="fa fa-info-circle fa-2x mb-2"></i>
                                <h5>Mon compte</h5>
                                <p>Gérer votre profil</p>
                            </a>
                        </div>
                        <div class="col-md-6 mb-4">
                            <a href="{{ url('/candidats/cv/') }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #e67e22, #d35400);">
                                <i class="fa fa-file-text-o fa-2x mb-2"></i>
                                <h5>Mon CV</h5>
                                <p>Gérer votre CV</p>
                            </a>
                        </div>
                        <div class="col-md-6 mb-4">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="homsys-dashboard-card" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                                <i class="fa fa-sign-out fa-2x mb-2"></i>
                                <h5>Déconnexion</h5>
                                <p>Quitter votre espace</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <h5 class="mb-3"><i class="fa fa-clock-o"></i> Dernières offres</h5>
                    <div class="list-group">
                        @if(empty($offres_news))
                            <div class="list-group-item text-muted">Aucune offre</div>
                        @else
                            @foreach($offres_news as $offre)
                                <a href="{{ url('offres', $offre->id_offre) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1" style="font-size:13px;">{{ $offre->titre_offre }}</h6>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fa fa-file-text-o"></i> {{ $offre->type_offre }}
                                        <i class="fa fa-map-marker ml-2"></i> {{ $offre->ville_offre }}
                                    </small>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .homsys-dashboard-card {
        display: block;
        color: #fff;
        border-radius: 10px;
        padding: 24px 20px;
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
        text-align: center;
    }
    .homsys-dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        color: #fff;
        text-decoration: none;
    }
    .homsys-dashboard-card h5 {
        margin: 0 0 4px 0;
        font-weight: 700;
    }
    .homsys-dashboard-card p {
        margin: 0;
        font-size: 13px;
        opacity: 0.85;
    }
</style>
@endpush

@stop
