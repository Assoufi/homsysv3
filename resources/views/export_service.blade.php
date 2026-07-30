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
    .export-intro {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 20px;
    }
    .export-intro-text {
        flex: 1 1 320px;
    }
    .export-intro-text .lead {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1.05rem;
        margin-bottom: 14px;
        display: block;
    }
    .export-intro-thumb {
        flex: 0 1 280px;
        text-align: center;
    }
    .export-intro-thumb img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .countries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 12px;
        margin: 16px 0;
    }
    .country-item {
        background: #007bff;
        color: #fff;
        padding: 14px 10px;
        text-align: center;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.95rem;
    }
    .export-card-grid {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .export-card {
        flex: 1 1 280px;
        margin: 10px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        padding: 22px 20px;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .export-card:hover {
        border-color: #bfd8ff;
        box-shadow: 0 6px 16px rgba(0,123,255,0.1);
    }
    .export-card .card-icon {
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
    .export-card h4 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        margin: 0 0 10px;
    }
    .export-card p, .export-card ul {
        color: #475569;
        line-height: 1.65;
        margin: 0;
        font-size: 0.95rem;
    }
    .export-card ul {
        padding-left: 18px;
        margin-top: 8px;
    }
    .export-card ul li {
        margin-bottom: 6px;
    }
    .benefits-box {
        background: #f8fafc;
        border-left: 4px solid #007bff;
        padding: 18px 20px;
        margin: 16px 0;
        border-radius: 0 6px 6px 0;
    }
    .benefits-box h4 {
        color: #007bff;
        font-size: 1.05rem;
        font-weight: 700;
        margin: 0 0 10px;
    }
    .benefits-box ul {
        margin: 0;
        padding-left: 18px;
    }
    .benefits-box ul li {
        margin-bottom: 6px;
        color: #475569;
        line-height: 1.65;
    }
    .export-why-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
        margin: 16px 0;
    }
    .export-why-item {
        background: #007bff;
        color: #fff;
        padding: 20px 16px;
        border-radius: 8px;
        text-align: center;
    }
    .export-why-item strong {
        display: block;
        font-size: 1rem;
        margin-bottom: 8px;
        font-weight: 700;
    }
    .export-why-item span {
        font-size: 0.9rem;
        opacity: 0.95;
    }
    .export-img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .export-img-wrap {
        text-align: center;
        margin-top: 16px;
    }
    .export-two-col {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: center;
    }
    .export-two-col > .export-text-col {
        flex: 1 1 320px;
    }
    .export-two-col > .export-img-col {
        flex: 0 1 280px;
        text-align: center;
    }
    h3.section-heading {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.15rem;
        margin: 24px 0 12px;
    }
</style>

<div class="about-page">

    <div class="spontane-header">
        <h3>Export de service IT</h3>
        <p>HOMSYS à l'international : des experts IT marocains, chez vous ou à distance</p>
    </div>

    {{-- Introduction / Présence internationale --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-globe"></i> Une présence internationale, une expertise locale</div>
        <div class="panel-body">
            <p>Depuis 2010, HOMSYS accompagne des entreprises en Europe, en Amérique du Nord et en Afrique en exportant ses services IT depuis le Maroc.</p>

            <div class="export-two-col">
                <div class="export-text-col">
                    <p>HOMSYS intervient dans plusieurs pays :</p>
                    <div class="countries-grid">
                        <div class="country-item">France</div>
                        <div class="country-item">Canada</div>
                        <div class="country-item">Espagne</div>
                        <div class="country-item">Royaume-Uni</div>
                        <div class="country-item">Allemagne</div>
                        <div class="country-item">USA</div>
                    </div>
                    <p>Grâce à cette expérience, nous avons construit un modèle d'intervention flexible, sécurisé et adapté aux besoins des entreprises internationales.</p>
                </div>
                <div class="export-img-col">
                    <img src="{{ URL::asset('img/international-world-business.jpg') }}" alt="Présence internationale HOMSYS" class="export-img">
                </div>
            </div>
        </div>
    </div>

    {{-- Intervention en remote --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-laptop"></i> Intervention en remote depuis le Maroc</div>
        <div class="panel-body">
            <div class="export-two-col">
                <div class="export-text-col">
                    <p>Vous profitez de l'expertise de nos consultants IT sans contrainte géographique. Chaque projet démarre depuis nos locaux, puis, après une période d'adaptation, le consultant peut travailler depuis chez lui pour plus de flexibilité.</p>
                    <div class="benefits-box">
                        <h4>Avantages du remote HOMSYS :</h4>
                        <ul>
                            <li>Accès rapide à des profils IT expérimentés (développeurs, data, cloud, devops, etc.).</li>
                            <li>Réduction des coûts de structure et de déplacement.</li>
                            <li>Flexibilité maximale pour adapter les équipes à la charge de travail.</li>
                            <li>Compatibilité totale avec les outils modernes de collaboration (Slack, Teams, Jira, Git, etc.).</li>
                        </ul>
                    </div>
                </div>
                <div class="export-img-col">
                    <img src="{{ URL::asset('img/job_remote.webp') }}" alt="Consultant HOMSYS en remote" class="export-img">
                </div>
            </div>
        </div>
    </div>

    {{-- Offshore Régie --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-handshake-o"></i> Offshore Régie HOMSYS</div>
        <div class="panel-body">
            <p>L'offshore en régie avec HOMSYS vous permet d'enrichir vos équipes avec des consultants IT seniors et confirmés, sans les contraintes du recrutement classique.</p>

            <div class="benefits-box">
                <h4>Pour les entreprises :</h4>
                <ul>
                    <li>Vous sélectionnez les profils dont vous avez besoin.</li>
                    <li>HOMSYS gère tout le volet administratif, juridique et RH.</li>
                    <li>Vous signez un simple bon de commande et réglez les factures.</li>
                    <li>Vous gardez la maîtrise totale de l'organisation et du pilotage des missions.</li>
                </ul>
            </div>

            <p>C'est une solution idéale pour :</p>
            <ul>
                <li>Renforcer vos équipes rapidement.</li>
                <li>Accéder à des compétences pointues.</li>
                <li>Bénéficier d'une grande flexibilité contractuelle.</li>
            </ul>
        </div>
    </div>

    {{-- Détachement --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-plane"></i> Détachement de consultants</div>
        <div class="panel-body">
            <p>Pour répondre à la demande croissante de profils IT, HOMSYS a structuré une offre de détachement de consultants directement au sein de vos équipes.</p>

            <h3 class="section-heading">Principe du dispositif</h3>
            <p>Les consultants restent salariés HOMSYS et sont mis à disposition de votre entreprise pour une durée déterminée, dans le cadre de vos projets. Ils interviennent sous votre supervision opérationnelle, tout en conservant leur lien contractuel avec HOMSYS.</p>

            <div class="export-card-grid">
                <div class="export-card">
                    <div class="card-icon"><i class="fa fa-building"></i></div>
                    <h4>Avantages pour votre entreprise</h4>
                    <ul>
                        <li>Accès à des profils IT qualifiés, pré-validés et opérationnels.</li>
                        <li>Simplification des processus de recrutement et de gestion administrative.</li>
                        <li>Flexibilité pour ajuster les effectifs en fonction de l'activité et des projets.</li>
                        <li>Cadre juridique et contractuel maîtrisé, avec une facturation claire et traçable.</li>
                    </ul>
                </div>
                <div class="export-card">
                    <div class="card-icon"><i class="fa fa-users"></i></div>
                    <h4>Avantages pour les consultants</h4>
                    <ul>
                        <li>Maintien du statut de salarié HOMSYS (même employeur).</li>
                        <li>Accompagnement RH et suivi de carrière par HOMSYS.</li>
                        <li>Exposition à des environnements clients variés et stimulants.</li>
                        <li>Possibilité de missions longues ou courtes, selon les besoins et les profils.</li>
                    </ul>
                </div>
            </div>

            <h3 class="section-heading">Organisation et conditions financières</h3>
            <ul>
                <li>Plusieurs modalités de paiement sont proposées, adaptées à votre trésorerie et à vos process internes : J+15, J+30, J+45 ou J+60.</li>
                <li>Le consultant est réglé sous 48 heures après réception du paiement client.</li>
                <li>Une partie de la rémunération peut être versée sur un compte à l'étranger, selon les besoins du consultant.</li>
                <li>HOMSYS peut prendre en charge l'hébergement et/ou les frais de transport liés à la mission, puis les refacturer au client dans le cadre de la facturation globale.</li>
            </ul>

            <div class="export-img-wrap">
                <img src="{{ URL::asset('img/business-woman.webp') }}" alt="Détachement de consultants HOMSYS" class="export-img" style="max-width: 480px;">
            </div>
        </div>
    </div>

    {{-- Pourquoi choisir HOMSYS --}}
    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-star"></i> Pourquoi choisir HOMSYS ?</div>
        <div class="panel-body">
            <p class="section-subtitle">Experts IT marocains, flexibilité et sécurité juridique</p>
            <div class="export-why-grid">
                <div class="export-why-item">
                    <strong>Expertise IT marocaine reconnue</strong>
                    <span>Développeurs, architectes, data, cloud, devops, QA, etc.</span>
                </div>
                <div class="export-why-item">
                    <strong>Flexibilité</strong>
                    <span>Interventions en remote ou en détachement, avec possibilité de modèles hybrides.</span>
                </div>
                <div class="export-why-item">
                    <strong>Sécurité juridique et administrative</strong>
                    <span>Portage salarial, détachement, facturation claire.</span>
                </div>
                <div class="export-why-item">
                    <strong>Réactivité</strong>
                    <span>Accès rapide à des profils confirmés.</span>
                </div>
                <div class="export-why-item">
                    <strong>Expérience internationale</strong>
                    <span>Projets menés avec succès en Europe, Amérique du Nord et Afrique.</span>
                </div>
            </div>
            <p style="margin-top: 16px;">
                <a href="{{ url('mails/contactus') }}" class="btn btn-submit-blue">
                    <i class="fa fa-paper-plane"></i> Contactez-nous
                </a>
            </p>
        </div>
    </div>

</div>

@endsection
