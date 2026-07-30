@extends('layouts.front2')

@section('titre')
    Faites le choix d'un partenaire fiable
@stop

@section('content')

<style>
    .home-page {
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
    .home-offer {
        display: block;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 18px 18px 16px;
        margin-bottom: 14px;
        text-decoration: none !important;
        transition: box-shadow 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        background: #fff;
    }
    .home-offer:hover {
        border-color: #bfd8ff;
        box-shadow: 0 6px 16px rgba(0,123,255,0.1);
        transform: translateY(-2px);
    }
    .home-offer h4 {
        margin: 0 0 10px;
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        line-height: 1.4;
    }
    .home-offer:hover h4 {
        color: #007bff;
    }
    .home-offer-meta {
        list-style: none;
        padding: 0;
        margin: 0 0 12px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px 18px;
        color: #64748b;
        font-size: 0.9rem;
    }
    .home-offer-meta li i {
        color: #007bff;
        margin-right: 5px;
    }
    .home-offer-type {
        display: inline-block;
        background: #e8f1ff;
        color: #007bff;
        font-weight: 700;
        font-size: 0.8rem;
        padding: 4px 10px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .home-empty {
        text-align: center;
        color: #64748b;
        padding: 30px 10px;
    }
    .home-stats {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .home-stat {
        flex: 1 1 180px;
        margin: 10px;
        text-align: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 22px 16px;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }
    .home-stat:hover {
        box-shadow: 0 6px 16px rgba(0,123,255,0.12);
        transform: translateY(-2px);
    }
    .home-stat .stat-icon {
        width: 48px;
        height: 48px;
        line-height: 48px;
        margin: 0 auto 12px;
        border-radius: 50%;
        background: #e8f1ff;
        color: #007bff;
        font-size: 1.25rem;
    }
    .home-stat .stat-number {
        display: block;
        font-size: 1.75rem;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1.2;
    }
    .home-stat .stat-label {
        display: block;
        margin-top: 4px;
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .home-news-grid {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .home-news-card {
        flex: 1 1 280px;
        margin: 10px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .home-news-card:hover {
        border-color: #bfd8ff;
        box-shadow: 0 6px 16px rgba(0,123,255,0.1);
    }
    .home-news-card figure {
        margin: 0;
        height: 160px;
        overflow: hidden;
        background: #f1f5f9;
    }
    .home-news-card figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .home-news-body {
        padding: 16px 18px 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .home-news-body h4 {
        margin: 0 0 10px;
        font-weight: 700;
        font-size: 1rem;
        line-height: 1.4;
    }
    .home-news-body h4 a {
        color: #2c3e50;
        text-decoration: none;
    }
    .home-news-body h4 a:hover {
        color: #007bff;
    }
    .home-news-body p {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0 0 14px;
        flex: 1;
    }
    .home-refs {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 24px;
    }
    .home-refs-text {
        flex: 1 1 300px;
    }
    .home-refs-text p {
        color: #475569;
        line-height: 1.7;
        margin-bottom: 18px;
    }
    .home-refs-img {
        flex: 0 1 320px;
        text-align: center;
    }
    .home-refs-img img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
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
        border: none;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
    .btn-outline-blue {
        display: inline-block;
        background: #fff;
        color: #007bff !important;
        border: 2px solid #007bff;
        font-weight: 700;
        padding: 10px 24px;
        border-radius: 5px;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-outline-blue:hover {
        background: #007bff;
        color: #fff !important;
    }
</style>

<div class="home-page">

    {{-- Dernières offres --}}
    <div class="spontane-header">
        <h3>Dernières offres publiées</h3>
        <p>Retrouvez ici les dernières offres publiées</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-briefcase"></i> Offres d’emploi</div>
        <div class="panel-body">
            @if(empty($lastest_offres))
                <div class="home-empty">
                    <i class="fa fa-inbox fa-2x" style="color:#94a3b8; margin-bottom:10px;"></i>
                    <p>Aucune offre disponible pour le moment.</p>
                </div>
            @else
                <div class="row">
                    @foreach($lastest_offres as $offre)
                        <div class="col-md-6">
                            <a class="home-offer" href="{{ url('offres', ['id' => $offre->id_offre.'-'.strtolower(str_replace(str_split("'\\/:*?|+%."), '_', $offre->titre_offre))]) }}">
                                <h4>{{ $offre->titre_offre }}</h4>
                                <ul class="home-offer-meta">
                                    <li><i class="fa fa-map-marker"></i> {{ $offre->ville_offre }}, Maroc</li>
                                    <li><i class="fa fa-calendar"></i> {{ $offre->duree }}</li>
                                </ul>
                                <span class="home-offer-type">{{ $offre->type_offre }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="text-center" style="margin-top: 16px;">
                <a href="{{ url('offres') }}" class="btn-outline-blue">
                    <i class="fa fa-list"></i> Voir toutes les offres
                </a>
            </div>
        </div>
    </div>

    {{-- Statistiques --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-bar-chart"></i> HOMSYS en chiffres</div>
        <div class="panel-body">
            <div class="home-stats">
                <div class="home-stat">
                    <div class="stat-icon"><i class="fa fa-file-text-o"></i></div>
                    <span class="stat-number word-counter">{{ $nb_offres }}</span>
                    <span class="stat-label">Offres publiées</span>
                </div>
                <div class="home-stat">
                    <div class="stat-icon"><i class="fa fa-users"></i></div>
                    <span class="stat-number word-counter">{{ $nb_cv }}</span>
                    <span class="stat-label">Candidatures reçues</span>
                </div>
                <div class="home-stat">
                    <div class="stat-icon"><i class="fa fa-briefcase"></i></div>
                    <span class="stat-number word-counter">{{ $nb_clients }}</span>
                    <span class="stat-label">Clients servis</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Actualités --}}
    <div class="spontane-header" id="actualites" style="margin-top: 10px;">
        <h3>Actualités</h3>
        <p>Conseils et tendances du recrutement</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-newspaper-o"></i> Articles récents</div>
        <div class="panel-body">
            <div class="home-news-grid">
                <article class="home-news-card">
                    <figure>
                        <a href="{{ url('/article1') }}">
                            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="IA et recrutement">
                        </a>
                    </figure>
                    <div class="home-news-body">
                        <h4><a href="{{ url('/article1') }}">L'intelligence artificielle dans le recrutement : comment adapter sa candidature en 2026 ?</a></h4>
                        <p>Les outils d'intelligence artificielle trient désormais la majorité des CV et organisent des pré-entretiens vidéo automatisés. Comprendre leur fonctionnement est devenu indispensable.</p>
                        <a href="{{ url('/article1') }}" class="btn-outline-blue" style="align-self: flex-start; padding: 7px 16px; font-size: 0.9rem;">Lire la suite</a>
                    </div>
                </article>

                <article class="home-news-card">
                    <figure>
                        <a href="{{ url('/article2') }}">
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40" alt="Télétravail hybride">
                        </a>
                    </figure>
                    <div class="home-news-body">
                        <h4><a href="{{ url('/article2') }}">Télétravail hybride : les nouvelles règles pour négocier sa flexibilité professionnelle</a></h4>
                        <p>Le travail hybride s'est imposé comme un standard. Savoir présenter ses arguments pour obtenir le rythme adapté est une compétence clé.</p>
                        <a href="{{ url('/article2') }}" class="btn-outline-blue" style="align-self: flex-start; padding: 7px 16px; font-size: 0.9rem;">Lire la suite</a>
                    </div>
                </article>

                <article class="home-news-card">
                    <figure>
                        <a href="{{ url('/article3') }}">
                            <img src="{{ URL::asset('img/mode_travail_freelance.jpg') }}" alt="Reconversion professionnelle">
                        </a>
                    </figure>
                    <div class="home-news-body">
                        <h4><a href="{{ url('/article3') }}">Reconversion professionnelle à 30, 40 ou 50 ans : les stratégies qui fonctionnent</a></h4>
                        <p>Les transitions de carrière sont de plus en plus fréquentes. Bilan de compétences, formations ciblées et valorisation de l'expérience pour réussir.</p>
                        <a href="{{ url('/article3') }}" class="btn-outline-blue" style="align-self: flex-start; padding: 7px 16px; font-size: 0.9rem;">Lire la suite</a>
                    </div>
                </article>
            </div>
        </div>
    </div>

    {{-- Références --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-thumbs-up"></i> Nos références</div>
        <div class="panel-body">
            <div class="home-refs">
                <div class="home-refs-text">
                    <p>Depuis 2009, les plus grands acteurs du marché ont fait confiance à HOMSYS et sont devenus des clients fidèles. Voici une liste non exhaustive de nos clients :</p>
                    <a href="{{ url('mails/contactus') }}" class="btn btn-submit-blue">
                        <i class="fa fa-envelope"></i> Contactez-nous
                    </a>
                </div>
                <div class="home-refs-img">
                    <img src="{{ URL::asset('img/references.jpg') }}" alt="Références HOMSYS">
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
