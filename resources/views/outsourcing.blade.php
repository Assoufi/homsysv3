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
    .panel-custom .panel-body p {
        color: #475569;
        line-height: 1.7;
        margin-bottom: 12px;
    }
    .panel-custom .panel-body ul {
        margin: 12px 0;
        padding-left: 24px;
    }
    .panel-custom .panel-body ul li {
        color: #475569;
        line-height: 1.7;
        margin-bottom: 8px;
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
    .out-intro {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 20px;
    }
    .out-intro-text {
        flex: 1 1 320px;
    }
    .out-intro-text .lead {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1.05rem;
        margin-bottom: 14px;
        display: block;
    }
    .out-intro-thumb {
        flex: 0 1 280px;
        text-align: center;
    }
    .out-intro-thumb img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .out-card-grid {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .out-card {
        flex: 1 1 280px;
        margin: 10px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 22px 20px;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .out-card:hover {
        border-color: #bfd8ff;
        box-shadow: 0 6px 16px rgba(0,123,255,0.1);
    }
    .out-card .card-icon {
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
    .out-card h4 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        margin: 0 0 10px;
    }
    .out-card p {
        color: #475569;
        line-height: 1.65;
        margin: 0;
        font-size: 0.95rem;
    }
    .out-feat-grid {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .out-feat {
        flex: 1 1 230px;
        margin: 10px;
        text-align: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 22px 16px;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }
    .out-feat:hover {
        box-shadow: 0 6px 16px rgba(0,123,255,0.12);
        transform: translateY(-2px);
    }
    .out-feat .feat-icon {
        width: 48px;
        height: 48px;
        line-height: 48px;
        margin: 0 auto 12px;
        border-radius: 50%;
        background: #e8f1ff;
        color: #007bff;
        font-size: 1.25rem;
    }
    .out-feat h4 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1rem;
        margin: 0 0 10px;
    }
    .out-feat p {
        color: #475569;
        line-height: 1.6;
        margin: 0;
        font-size: 0.9rem;
    }
    .out-two-col {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: center;
    }
    .out-two-col > .out-text-col {
        flex: 1 1 320px;
    }
    .out-two-col > .out-img-col {
        flex: 0 1 280px;
        text-align: center;
    }
    .out-img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
</style>

<div class="about-page">

    <div class="spontane-header">
        <h3>Outsourcing de Freelances IT</h3>
        <p>Des talents IT indépendants, une expertise reconnue</p>
    </div>

    {{-- Introduction --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-briefcase"></i> Qui sommes-nous</div>
        <div class="panel-body">
            <div class="out-intro">
                <div class="out-intro-text">
                    <span class="lead">HOMSYS est aujourd'hui reconnu au Maroc comme un fournisseur de référence de talents IT indépendants, alliant expertise et compétitivité.</span>
                    <p>Depuis plus de 10 ans, nous cultivons des relations durables avec des clients prestigieux et avons développé une maîtrise approfondie du recrutement IT.</p>
                    <p>Fort de cette expérience, nous avons su tisser des partenariats solides avec des entreprises leaders et acquérir une expertise pointue dans le recrutement de profils IT, que ce soit en freelance, CDI ou CDD.</p>
                    <a href="{{ url('mails/contactus') }}" class="btn btn-submit-blue" style="margin-top: 8px;">
                        <i class="fa fa-paper-plane"></i> Contactez-nous
                    </a>
                </div>
                <div class="out-intro-thumb">
                    <img src="{{ URL::asset('img/about-us-thumb.png') }}" alt="HOMSYS - Outsourcing IT">
                </div>
            </div>
        </div>
    </div>

    {{-- Pourquoi choisir HOMSYS --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-star"></i> Pourquoi choisir HOMSYS pour vos missions de consulting IT</div>
        <div class="panel-body">
            <p class="section-subtitle">Des avantages concrets pour vos projets IT</p>
            <div class="out-card-grid">
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-clock-o"></i></div>
                    <h4>Réactivité record</h4>
                    <p>Recevez les premières candidatures qualifiées en moins de 48 heures.</p>
                </div>
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-line-chart"></i></div>
                    <h4>Compétitivité & transparence</h4>
                    <p>Des profils d'excellence à des conditions avantageuses, sans surprise.</p>
                </div>
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-users"></i></div>
                    <h4>Équipe experte</h4>
                    <p>Une équipe dynamique de 10 cadres, dont 5 ingénieurs en informatique, dédiée à votre succès.</p>
                </div>
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-database"></i></div>
                    <h4>Plus grande CVthèque IT du Maroc</h4>
                    <p>Accès à plus de 15 000 profils de consultants IT, soigneusement qualifiés.</p>
                </div>
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-id-card"></i></div>
                    <h4>Portage attractif</h4>
                    <p>Nos conditions de portage séduisent les meilleurs consultants, garantissant un vivier de talents de haut niveau.</p>
                </div>
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-handshake-o"></i></div>
                    <h4>Partenariat gagnant-gagnant</h4>
                    <p>Contrat cadre, période d'essai offerte, garantie de remplacement, remise de fin d'année et tarifs préférentiels.</p>
                </div>
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-desktop"></i></div>
                    <h4>Sourcing digitalisé</h4>
                    <p>Base de données intelligente (parsing, enrichissement, recherche avancée). Suivi automatisé des entretiens et feedbacks semi-automatisés (SMS / Email).</p>
                </div>
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-building"></i></div>
                    <h4>Références solides</h4>
                    <p>Des leaders du secteur (Capgemini, Atos, Sofrecom, CGI, GFI, Sopra…) nous font confiance depuis des années.</p>
                </div>
                <div class="out-card">
                    <div class="card-icon"><i class="fa fa-cogs"></i></div>
                    <h4>Polyvalence technologique</h4>
                    <p>Expertise couvrant un large spectre de technologies (Cloud, Data, IA, DevOps, Cyber, ERP, etc.) et de profils métiers.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Maîtrise du recrutement IT --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-graduation-cap"></i> Une maîtrise aboutie du recrutement IT</div>
        <div class="panel-body">
            <div class="out-two-col">
                <div class="out-text-col">
                    <p>Fort de plus de 10 ans d'expérience dans le sourcing et le headhunting de consultants IT, HOMSYS a construit un processus éprouvé, agile et efficient.</p>
                    <p>Notre approche s'appuie sur des leviers clés :</p>
                </div>
                <div class="out-img-col">
                    <img src="{{ URL::asset('img/career.png') }}" alt="Recrutement IT HOMSYS" class="out-img">
                </div>
            </div>

            <div class="out-feat-grid">
                <div class="out-feat">
                    <div class="feat-icon"><i class="fa fa-database"></i></div>
                    <h4>CVthèque augmentée</h4>
                    <p>Plus de 15 000 ingénieurs expérimentés, taggés par compétences (Skill Tags) pour un ciblage précis – y compris les candidats passifs.</p>
                </div>
                <div class="out-feat">
                    <div class="feat-icon"><i class="fa fa-share-alt"></i></div>
                    <h4>Canaux multicibles</h4>
                    <p>Site HOMSYS, mailing list (50 000+ abonnés), LinkedIn, job boards, réseaux écoles d'ingénieurs – pour toucher les talents actifs.</p>
                </div>
                <div class="out-feat">
                    <div class="feat-icon"><i class="fa fa-check-circle"></i></div>
                    <h4>Pré-qualification rigoureuse</h4>
                    <p>Chaque CV est analysé par nos équipes et validé par la Direction avant transmission au client.</p>
                </div>
                <div class="out-feat">
                    <div class="feat-icon"><i class="fa fa-phone"></i></div>
                    <h4>Entretien téléphonique</h4>
                    <p>Vérification systématique des compétences et de l'adéquation avec le besoin avant de proposer un candidat.</p>
                </div>
                <div class="out-feat">
                    <div class="feat-icon"><i class="fa fa-laptop"></i></div>
                    <h4>Entretien technique</h4>
                    <p>Réalisé dans nos locaux ou à distance, sur demande du client ou pour des profils complexes.</p>
                </div>
                <div class="out-feat">
                    <div class="feat-icon"><i class="fa fa-ban"></i></div>
                    <h4>Black List (exclus)</h4>
                    <p>Recensement des consultants ayant causé des incidents, mis à jour en continu grâce aux retours clients et terrain.</p>
                </div>
                <div class="out-feat">
                    <div class="feat-icon"><i class="fa fa-thumbs-up"></i></div>
                    <h4>Gold List (talents d'exception)</h4>
                    <p>Nos consultants plébiscités par nos clients pour leur professionnalisme et leurs compétences – priorisés dans chaque mission.</p>
                </div>
                <div class="out-feat">
                    <div class="feat-icon"><i class="fa fa-code"></i></div>
                    <h4>Coding Game & tests</h4>
                    <p>Pour les technologies nécessitant un niveau de développement avancé (PHP, J2EE, .NET, etc.), nous organisons des Coding Games et partageons les résultats avec vous.</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
