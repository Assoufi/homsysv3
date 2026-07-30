@extends('layouts.front2')

@section('titre')
    {!! $meta['title'] !!}
@stop

@section('content')

<style>
    .about-page {
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
    .about-intro {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 20px;
    }
    .about-intro-text {
        flex: 1 1 320px;
    }
    .about-intro-text .lead {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1.05rem;
        margin-bottom: 14px;
        display: block;
    }
    .about-intro-text p {
        color: #475569;
        line-height: 1.7;
        margin-bottom: 12px;
    }
    .about-intro-thumb {
        flex: 0 1 280px;
        text-align: center;
    }
    .about-intro-thumb img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .about-stats {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .about-stat {
        flex: 1 1 180px;
        margin: 10px;
        text-align: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 22px 16px;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }
    .about-stat:hover {
        box-shadow: 0 6px 16px rgba(0,123,255,0.12);
        transform: translateY(-2px);
    }
    .about-stat .stat-icon {
        width: 48px;
        height: 48px;
        line-height: 48px;
        margin: 0 auto 12px;
        border-radius: 50%;
        background: #e8f1ff;
        color: #007bff;
        font-size: 1.25rem;
    }
    .about-stat .stat-number {
        display: block;
        font-size: 1.75rem;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1.2;
    }
    .about-stat .stat-label {
        display: block;
        margin-top: 4px;
        color: #64748b;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .about-card-grid {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .about-card {
        flex: 1 1 280px;
        margin: 10px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 22px 20px;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .about-card:hover {
        border-color: #bfd8ff;
        box-shadow: 0 6px 16px rgba(0,123,255,0.1);
    }
    .about-card .card-icon {
        width: 44px;
        height: 44px;
        line-height: 44px;
        text-align: center;
        border-radius: 8px;
        background: #e8f1ff;
        color: #007bff;
        font-size: 1.15rem;
        margin-bottom: 14px;
    }
    .about-card h4 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        margin: 0 0 10px;
    }
    .about-card p {
        color: #475569;
        line-height: 1.65;
        margin: 0;
        font-size: 0.95rem;
    }
    .about-method-step {
        display: flex;
        gap: 16px;
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 1px solid #e2e8f0;
    }
    .about-method-step:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    .about-method-num {
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        line-height: 42px;
        text-align: center;
        border-radius: 50%;
        background: #007bff;
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
    }
    .about-method-body h4 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        margin: 4px 0 8px;
    }
    .about-method-body p {
        color: #475569;
        line-height: 1.65;
        margin: 0;
        font-size: 0.95rem;
    }
    .about-toggle {
        color: #007bff;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        white-space: nowrap;
    }
    .about-toggle:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    .about-refs {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 24px;
    }
    .about-refs-text {
        flex: 1 1 300px;
    }
    .about-refs-text p {
        color: #475569;
        line-height: 1.7;
        margin-bottom: 18px;
    }
    .about-refs-img {
        flex: 0 1 320px;
        text-align: center;
    }
    .about-refs-img img {
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
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
    .section-subtitle {
        color: #64748b;
        margin: -8px 0 18px;
        font-size: 0.95rem;
    }
</style>

<div class="about-page">

    <div class="spontane-header">
        <h3>À propos de HOMSYS</h3>
        <p>Formation, conseil et placement de ressources qualifiées</p>
    </div>

    {{-- Introduction --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-building"></i> Qui sommes-nous</div>
        <div class="panel-body">
            <div class="about-intro">
                <div class="about-intro-text">
                    <span class="lead">HOMSYS est une société de formation et de conseil en placement des ressources.</span>
                    <p>Nous nous adressons aux entreprises ayant besoin de ressources qualifiées et opérationnelles immédiatement.</p>
                    <p>En effet, nous prenons en charge le filtrage, la sélection et l’évaluation des profils répondant à vos besoins et exigences.</p>
                    <p>HOMSYS vous offre une gamme complète de solutions de recrutement personnalisées, en plus de l’expertise et de l’attention que vous méritez.</p>
                    <a href="{{ url('mails/contactus') }}" class="btn btn-submit-blue" style="margin-top: 8px;">
                        <i class="fa fa-envelope"></i> Contactez-nous
                    </a>
                </div>
                <div class="about-intro-thumb">
                    <img src="{{ URL::asset('img/about-us-thumb.png') }}" alt="HOMSYS - À propos">
                </div>
            </div>
        </div>
    </div>

    {{-- Statistiques --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-bar-chart"></i> En chiffres</div>
        <div class="panel-body">
            <div class="about-stats">
                <div class="about-stat">
                    <div class="stat-icon"><i class="fa fa-file-text-o"></i></div>
                    <span class="stat-number word-counter">{{ $nb_offres }}</span>
                    <span class="stat-label">Offres</span>
                </div>
                <div class="about-stat">
                    <div class="stat-icon"><i class="fa fa-users"></i></div>
                    <span class="stat-number word-counter">{{ $nb_cv }}</span>
                    <span class="stat-label">Candidats</span>
                </div>
                <div class="about-stat">
                    <div class="stat-icon"><i class="fa fa-briefcase"></i></div>
                    <span class="stat-number word-counter">{{ $nb_clients }}</span>
                    <span class="stat-label">Clients</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Passion / Différenciateurs --}}
    <div class="panel panel-custom" id="service">
        <div class="panel-heading"><i class="fa fa-star"></i> Le recrutement, c’est notre passion</div>
        <div class="panel-body">
            <p class="section-subtitle">Ce qui nous distingue par rapport aux autres</p>
            <div class="about-card-grid">
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-trophy"></i></div>
                    <h4>Notre expérience</h4>
                    <p>Nous sommes reconnus pour notre expertise et notre réseau de contacts, mais également pour notre accompagnement et notre approche personnalisés, ainsi que pour notre créativité et notre ténacité pour cibler les bonnes personnes.</p>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-sitemap"></i></div>
                    <h4>Notre vaste réseau de contacts</h4>
                    <p>Notre vaste réseau de contacts nous permet d’accélérer le temps consacré à recruter, à sélectionner et à embaucher un candidat pour nos clients — un grand avantage, puisque le temps est toujours un enjeu d’affaires important pour ceux-ci.</p>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-lightbulb-o"></i></div>
                    <h4>Notre créativité</h4>
                    <p>Nous innovons constamment pour cibler, sélectionner et recruter la bonne personne. Nous sortons des sentiers battus ou conventionnels pour dénicher le profil idéal.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Valeurs --}}
    <div class="panel panel-custom" id="valeurs">
        <div class="panel-heading"><i class="fa fa-heart"></i> Nos valeurs</div>
        <div class="panel-body">
            <div class="about-card-grid">
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-graduation-cap"></i></div>
                    <h4>Expertise et accompagnement</h4>
                    <p>Fort de l’expérience et de l’expertise de ses équipes, HOMSYS apporte à ses clients un accompagnement global de leurs projets. Nous adaptons notre accompagnement à votre structure et à votre métier, pour répondre à vos besoins et pour faire face à l’accroissement des exigences réglementaires, comptables, fiscales et technologiques. HOMSYS vous conseille et vous assiste dans vos réflexions jusqu’à la mise en œuvre de vos projets d’évolution et/ou d’amélioration de la performance de votre organisation ou de votre système d’information.</p>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-eye"></i></div>
                    <h4>La transparence</h4>
                    <p>La transparence nous amène à agir et à décider ouvertement. Elle assure le respect éthique et déontologique à ceux qui nous font confiance.</p>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-fire"></i></div>
                    <h4>La passion</h4>
                    <p>Notre passion donne un sens aux actions et nos actions contribuent à atteindre l’excellence dans chacun de nos mandats.</p>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-handshake-o"></i></div>
                    <h4>L’esprit d’équipe</h4>
                    <p>L’écoute, le dialogue, la confrontation des analyses pour cultiver la diversité des talents et des cultures. C’est la force de l’entreprise : être encore plus efficace ensemble.</p>
                </div>
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-exchange"></i></div>
                    <h4>La flexibilité</h4>
                    <p>Nous comprenons les contraintes de chaque client ou employé, et nous nous efforçons de nous adapter, de les rencontrer à mi-chemin pour solutionner une situation.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Méthodologie --}}
    <div class="panel panel-custom" id="methodologie">
        <div class="panel-heading"><i class="fa fa-cogs"></i> Notre méthodologie</div>
        <div class="panel-body">
            <div class="about-method-step">
                <div class="about-method-num">1</div>
                <div class="about-method-body">
                    <h4>Écouter et conseiller</h4>
                    <p>Notre première approche consiste à analyser votre contexte interne (projets, équipe en place, technologies, environnements…). Nous vous conseillons sur l’attitude à adopter sur le marché.</p>
                </div>
            </div>
            <div class="about-method-step">
                <div class="about-method-num">2</div>
                <div class="about-method-body">
                    <h4>Chercher sur mesure</h4>
                    <p id="mesure-less">
                        Chaque recherche est différente. Nous adaptons donc notre communication autour de trois grands axes en fonction de votre besoin. Communiquer : nous diffusons votre offre à un large panel sur la toile…
                        <a href="javascript:void(0)" id="btn_more_mesure" class="about-toggle">En savoir plus</a>
                    </p>
                    <p id="mesure-more" style="display: none;">
                        Chaque recherche est différente. Nous adaptons donc notre communication autour de trois grands axes en fonction de votre besoin.
                        <br><br>
                        <strong>Communiquer :</strong> nous diffusons votre offre à un large panel sur la toile (annonce rédigée sur mesure en fonction de votre besoin) ;
                        <br>
                        <strong>« Réseauter » :</strong> étant spécialisés sur votre métier, notre réseau est exclusivement composé de profils travaillant dans ce domaine. Nous faisons donc appel à notre propre réseau via notre base de données, mais aussi à nos connexions sur les réseaux sociaux ;
                        <br>
                        <strong>Chasser :</strong> en fonction des profils recherchés, nous travaillons par approche directe pour une recherche plus ciblée.
                        <a href="javascript:void(0)" id="btn_less_mesure" class="about-toggle">En savoir moins</a>
                    </p>
                </div>
            </div>
            <div class="about-method-step">
                <div class="about-method-num">3</div>
                <div class="about-method-body">
                    <h4>Proposer et recommander</h4>
                    <p id="proposer-less">
                        Après une approche globale sur le marché du recrutement, notre objectif est de vous proposer plusieurs candidats ciblés. Dans cet objectif, nous qualifions dans le détail les candidats pour s’assurer…
                        <a href="javascript:void(0)" id="btn_more_proposer" class="about-toggle">En savoir plus</a>
                    </p>
                    <p id="proposer-more" style="display: none;">
                        Après une approche globale sur le marché du recrutement, notre objectif est de vous proposer plusieurs candidats ciblés.
                        Dans cet objectif, nous qualifions dans le détail les candidats pour s’assurer de leurs compétences, de leur motivation, de leurs contraintes et de l’adéquation avec votre offre.
                        <a href="javascript:void(0)" id="btn_less_proposer" class="about-toggle">En savoir moins</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Références --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-thumbs-up"></i> Nos références</div>
        <div class="panel-body">
            <div class="about-refs">
                <div class="about-refs-text">
                    <p>Depuis 2009, les plus grands acteurs du marché ont fait confiance à HOMSYS et sont devenus des clients fidèles. Voici une liste non exhaustive de nos clients :</p>
                    <a href="{{ url('mails/contactus') }}" class="btn btn-submit-blue">
                        <i class="fa fa-paper-plane"></i> Contactez-nous
                    </a>
                </div>
                <div class="about-refs-img">
                    <img src="{{ URL::asset('img/references.jpg') }}" alt="Références HOMSYS">
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn_more_proposer').click(function () {
            $('#proposer-less').hide();
            $('#proposer-more').show();
        });
        $('#btn_less_proposer').click(function () {
            $('#proposer-less').show();
            $('#proposer-more').hide();
        });
        $('#btn_more_mesure').click(function () {
            $('#mesure-less').hide();
            $('#mesure-more').show();
        });
        $('#btn_less_mesure').click(function () {
            $('#mesure-less').show();
            $('#mesure-more').hide();
        });
    });
</script>
@stop
