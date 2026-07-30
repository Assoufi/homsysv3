@extends('layouts.front2')

@section('titre')
    Candidat HOMSYS :: {!! $candidat->nom_condidat !!} {!! $candidat->prenom_condidat !!}
@stop

@section('content')
<style>
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
    .homsys-dashboard-card {
        display: block;
        color: #fff;
        border-radius: 8px;
        padding: 24px 20px;
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .homsys-dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        color: #fff;
        text-decoration: none;
    }
    .homsys-dashboard-card h5 {
        margin: 0 0 4px 0;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .homsys-dashboard-card p {
        margin: 0;
        font-size: 13px;
        opacity: 0.9;
    }
    .panel-custom {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        background: #ffffff;
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
</style>

<div class="container" align="left" style="width: 100%; max-width: 1100px; margin: 0 auto; padding-top: 10px; padding-bottom: 40px;">
    <div class="spontane-header">
        <h3>Bienvenue {{ $candidat->civilite_candidat }}. {{ $candidat->nom_condidat }} {{ $candidat->prenom_condidat }}</h3>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-6 style="margin-bottom: 20px;">
                    <a href="{{ url('/offres/') }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #007bff, #0056b3);">
                        <i class="fa fa-briefcase fa-2x mb-2" style="margin-bottom: 10px;"></i>
                        <h5>Offres d'emploi</h5>
                        <p>Consulter les offres disponibles</p>
                    </a>
                </div>

                <div class="col-md-6 style="margin-bottom: 20px;">
                    <a href="{{ url('/candidats/modify', $candidat->id_candidat) }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #17a2b8, #117a8b);">
                        <i class="fa fa-user fa-2x mb-2" style="margin-bottom: 10px;"></i>
                        <h5>Mon compte</h5>
                        <p>Gérer votre profil et vos informations</p>
                    </a>
                </div>

                <div class="col-md-6 style="margin-bottom: 20px; margin-top: 20px;">
                    <a href="{{ url('/candidats/cv/') }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #6c757d, #495057);">
                        <i class="fa fa-file-text-o fa-2x mb-2" style="margin-bottom: 10px;"></i>
                        <h5>Mon CV</h5>
                        <p>Gérer et mettre à jour votre CV</p>
                    </a>
                </div>

                <div class="col-md-6 style="margin-bottom: 20px; margin-top: 20px;">
                    <a href="{{ url('password/change') }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #ffc107, #e0a800);">
                        <i class="fa fa-key fa-2x mb-2" style="margin-bottom: 10px;"></i>
                        <h5>Mot de passe</h5>
                        <p>Modifier votre mot de passe</p>
                    </a>
                </div>

                <div class="col-md-6 style="margin-bottom: 20px; margin-top: 20px;">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="homsys-dashboard-card" style="background: linear-gradient(135deg, #dc3545, #bd2130);">
                        <i class="fa fa-sign-out fa-2x mb-2" style="margin-bottom: 10px;"></i>
                        <h5>Déconnexion</h5>
                        <p>Quitter votre espace personnel</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-clock-o"></i> Dernières offres</div>
                <div class="panel-body" style="padding: 10px 15px;">
                    <div class="list-group" style="margin-bottom: 0;">
                        @if(empty($offres_news) || count($offres_news) == 0)
                            <div class="list-group-item text-muted text-center">Aucune offre récente</div>
                        @else
                            @foreach($offres_news as $offre)
                                <a href="{{ url('offres', $offre->id_offre) }}" class="list-group-item list-group-item-action" style="padding: 10px 12px;">
                                    <h6 style="font-size:13px; font-weight:700; color:#2c3e50; margin-bottom: 4px;">{{ $offre->titre_offre }}</h6>
                                    <small class="text-muted">
                                        <i class="fa fa-file-text-o"></i> {{ $offre->type_offre }}
                                        <span style="margin-left: 10px;"><i class="fa fa-map-marker"></i> {{ $offre->ville_offre }}</span>
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
@stop

