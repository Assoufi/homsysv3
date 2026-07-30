@extends('layouts.front2')

@section('titre')
    {!! $meta['title'] !!}
@stop

@section('scripts')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org/",
      "@@type": "JobPosting",
      "title": "{{ $offre->titre_offre }}",
      "description": "{!! addslashes(strip_tags($offre->poste . ' ' . $offre->profil . ' ' . $offre->competences)) !!}",
      "datePosted": "{{ $offre->created_at->toIso8601String() }}",
      "validThrough": "{{ $offre->updated_at->addMonths(3)->toIso8601String() }}",
      "employmentType": "{{ match($offre->type_offre) { 'Freelance' => 'CONTRACTOR', 'CDD' => 'TEMPORARY', 'Stage' => 'INTERN', default => 'FULL_TIME' } }}",
      "hiringOrganization": {
        "@@type": "Organization",
        "name": "HOMSYS",
        "sameAs": "https://www.homsys.ma",
        "logo": "{{ URL::asset('img/logo.png') }}"
      },
      "jobLocation": {
        "@@type": "Place",
        "address": {
          "@@type": "PostalAddress",
          "addressLocality": "{{ $offre->ville_offre ?? 'Maroc' }}",
          "addressCountry": "MA"
        }
      }
    }
    </script>

    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BreadcrumbList",
      "itemListElement": [
        {"@@type": "ListItem", "position": 1, "name": "Accueil", "item": "{{ url('/') }}"},
        {"@@type": "ListItem", "position": 2, "name": "Offres", "item": "{{ url('offres') }}"},
        {"@@type": "ListItem", "position": 3, "name": "{{ $offre->titre_offre }}"}
      ]
    }
    </script>
@stop

@section('content')
<style>
    .show-page {
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
    .panel-custom .panel-body ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .panel-custom .panel-body ul li {
        padding: 10px 0;
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        line-height: 1.5;
    }
    .panel-custom .panel-body ul li:last-child {
        border-bottom: none;
    }
    .panel-custom .panel-body ul li i {
        color: #007bff;
        width: 20px;
        text-align: center;
        margin-right: 8px;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        padding: 11px 28px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
        display: inline-block;
        text-decoration: none !important;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
    .show-sticky-cta {
        position: sticky;
        bottom: 0;
        z-index: 10;
        background: #fff;
        padding: 12px 0;
        box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
    }
    .badge-type {
        display: inline-block;
        background: #e8f1ff;
        border: 1px solid #bfd8ff;
        color: #007bff;
        border-radius: 50px;
        padding: .2rem .7rem;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .04em;
        margin-left: 8px;
    }
</style>

<div class="show-page">
    <div class="spontane-header">
        <h3><i class="fa fa-briefcase"></i> {{ $offre->titre_offre }}</h3>
        <p>{{ $offre->type_offre }} @if(!empty($offre->ville_offre)) - {{ $offre->ville_offre }} @endif</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            @if(!empty($offre->poste))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-briefcase"></i> Mission</div>
                <div class="panel-body">{!! $offre->poste !!}</div>
            </div>
            @endif

            @if(!empty($offre->profil))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-user-o"></i> Profil recherché</div>
                <div class="panel-body">{!! $offre->profil !!}</div>
            </div>
            @endif

            @if(!empty($offre->competences))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-cogs"></i> Compétences demandées</div>
                <div class="panel-body">{!! $offre->competences !!}</div>
            </div>
            @endif

            @if(!empty($offre->qualites))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-heart-o"></i> Qualités personnelles</div>
                <div class="panel-body">{!! $offre->qualites !!}</div>
            </div>
            @endif

            @if(!empty($offre->description_offre))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-align-left"></i> Détails</div>
                <div class="panel-body">{!! $offre->description_offre !!}</div>
            </div>
            @endif

            <div class="d-none d-md-block mt-3">
                <a href="{{ url('offres/postule', $offre->id_offre) }}" class="btn btn-submit-blue">
                    <i class="fa fa-paper-plane"></i> Postuler à cette offre
                </a>
                <a href="{{ url('offres') }}" class="btn btn-outline-secondary" style="margin-left: 8px;">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </div>

            <div class="show-sticky-cta d-md-none mt-4">
                <a href="{{ url('offres/postule', $offre->id_offre) }}" class="btn btn-submit-blue btn-block">
                    <i class="fa fa-paper-plane"></i> Postuler
                </a>
            </div>

            <div class="sharethis-inline-share-buttons mt-3"></div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-info-circle"></i> Informations</div>
                <div class="panel-body">
                    <ul>
                        <li><i class="fa fa-id-card-o"></i> Contrat : {{ $offre->type_offre }}</li>
                        @if(!empty($offre->ville_offre))
                            <li><i class="fa fa-map-marker"></i> Localisation : {{ $offre->ville_offre }}</li>
                        @endif
                        @if(!empty($offre->duree))
                            <li><i class="fa fa-clock-o"></i> Durée : {{ $offre->duree }}</li>
                        @endif
                        @if(!empty($offre->date_demarrage))
                            <li><i class="fa fa-calendar"></i> Démarrage : {{ $offre->date_demarrage }}</li>
                        @endif
                        @if(!empty($offre->experience))
                            <li><i class="fa fa-line-chart"></i> Expérience : {{ $offre->experience }} ans</li>
                        @endif
                        @if(!empty($offre->formation))
                            <li><i class="fa fa-graduation-cap"></i> Formation : {{ $offre->formation }}</li>
                        @endif
                        <li><i class="fa fa-calendar"></i> Publiée le : {{ $offre->updated_at->format('d/m/Y') }}</li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-paper-plane"></i> Action</div>
                <div class="panel-body">
                    <a href="{{ url('offres/postule', $offre->id_offre) }}" class="btn btn-submit-blue btn-block">
                        <i class="fa fa-paper-plane"></i> Postuler
                    </a>
                    <hr>
                    <div class="text-center small text-muted">ou partager sur</div>
                    <div class="sharethis-inline-share-buttons mt-2"></div>
                    <hr>
                    <a href="{{ url('offres') }}" class="btn btn-outline-secondary btn-block">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
