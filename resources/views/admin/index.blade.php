@extends('layouts.front2')

@section('titre')
   HOMSYS :: {{ $admin->username }}
@stop

@section('content')

<style>
    .admin-page {
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
    .homsys-dashboard-card {
        display: block;
        color: #fff !important;
        border-radius: 8px;
        padding: 28px 20px;
        text-decoration: none !important;
        transition: transform 0.2s, box-shadow 0.2s;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }
    .homsys-dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        color: #fff !important;
        text-decoration: none !important;
    }
    .homsys-dashboard-card i {
        display: block;
        margin-bottom: 12px;
    }
    .homsys-dashboard-card h5 {
        margin: 0 0 4px 0;
        font-weight: 700;
        font-size: 1.1rem;
        color: #fff;
    }
    .homsys-dashboard-card p {
        margin: 0;
        font-size: 13px;
        opacity: 0.9;
        color: #fff;
    }
    .admin-graph-wrap {
        min-height: 80px;
    }
</style>

<div class="admin-page">
    <div class="spontane-header">
        <h3>Bienvenue {{ $admin->username }}</h3>
        <p>Tableau de bord administrateur</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-th-large"></i> Accès rapides</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ url('/offres/') }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #007bff, #0056b3);">
                        <i class="fa fa-briefcase fa-2x"></i>
                        <h5>Offres</h5>
                        <p>Gérer les offres d’emploi</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('/candidats/') }}" class="homsys-dashboard-card" style="background: linear-gradient(135deg, #17a2b8, #117a8b);">
                        <i class="fa fa-users fa-2x"></i>
                        <h5>Candidats</h5>
                        <p>Gestion des candidats</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="homsys-dashboard-card" style="background: linear-gradient(135deg, #dc3545, #bd2130);">
                        <i class="fa fa-sign-out fa-2x"></i>
                        <h5>Déconnexion</h5>
                        <p>Quitter la session admin</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-line-chart"></i> Statistiques de visite</div>
        <div class="panel-body">
            <div class="admin-graph-wrap">
                @include('graphs.visites_jour')
            </div>
            <div class="admin-graph-wrap" style="margin-top: 20px;">
                @include('graphs.visites_offres')
            </div>
        </div>
    </div>
</div>

@stop
