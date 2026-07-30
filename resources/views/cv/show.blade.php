@extends('layouts.front2')

@section('titre')
    CV - {{ $candidat->nom_condidat }} {{ $candidat->prenom_condidat }}
@stop

@section('content')

<style>
    .cv-page {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto 50px;
        padding: 0 15px;
    }
    .spontane-header {
        margin-bottom: 25px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .spontane-header h3 {
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
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
        transition: all 0.2s ease-in-out;
        display: inline-block;
        text-decoration: none !important;
        border: none;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        color: #ffffff !important;
    }
    .btn-outline-gray {
        display: inline-block;
        background: #fff;
        color: #6c757d !important;
        border: 2px solid #cbd5e1;
        font-weight: 700;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-outline-gray:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: #fff !important;
    }
    .btn-success-custom {
        display: inline-block;
        background: #28a745 !important;
        color: #fff !important;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none !important;
        border: none;
    }
    .btn-success-custom:hover {
        background: #1e7e34 !important;
        color: #fff !important;
    }
    .cv-meta {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
        padding: 14px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }
    .cv-meta p {
        margin: 0 0 4px;
        color: #475569;
    }
    .cv-meta p strong {
        color: #2c3e50;
    }
    .pdf-preview {
        height: 700px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        background: #f8fafc;
    }
    .cv-preview-fallback {
        text-align: center;
        padding: 40px 20px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #f8fafc;
    }
    .cv-preview-fallback i {
        color: #007bff;
        margin-bottom: 12px;
    }
    .cv-section-title {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        margin: 0 0 14px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e2e8f0;
    }
    .cv-section-title i {
        color: #007bff;
        margin-right: 6px;
    }
    .cv-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .cv-table thead th {
        background: #f8fafc;
        color: #2c3e50;
        font-weight: 700;
        padding: 10px 12px;
        border-bottom: 2px solid #e2e8f0;
        text-align: left;
        font-size: 0.9rem;
    }
    .cv-table tbody td {
        padding: 10px 12px;
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        font-size: 0.92rem;
    }
    .cv-table tbody tr:hover {
        background: #f8fafc;
    }
    .cv-alert-info {
        border-radius: 8px;
        padding: 16px 18px;
        background: #e8f1ff;
        border: 1px solid #bfd8ff;
        color: #004085;
    }
    .cv-alert-info a {
        color: #007bff;
        font-weight: 700;
    }
    @media (max-width: 767px) {
        .pdf-preview { display: none; }
        .cv-table thead { display: none; }
        .cv-table tbody tr {
            display: block;
            margin-bottom: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px;
        }
        .cv-table tbody td {
            display: block;
            border: none;
            padding: 6px 8px;
        }
        .cv-table tbody td::before {
            content: attr(data-label) " : ";
            font-weight: 700;
            color: #2c3e50;
        }
    }
</style>

<div class="cv-page">
    <div class="spontane-header">
        <h3><i class="fa fa-file-text"></i> Mon CV</h3>
        <a href="{{ url('/candidats/cv/') }}" class="btn-outline-gray">
            <i class="fa fa-arrow-left"></i> Retour
        </a>
    </div>

    @if($cv && ($cv->lien_cv || $cv->live_cv))
        <div class="panel panel-custom">
            <div class="panel-heading"><i class="fa fa-info-circle"></i> Informations du CV</div>
            <div class="panel-body">
                @if(!empty($cv->lien_cv))
                    <div class="cv-meta">
                        <div>
                            <p><strong>Type :</strong> Document {{ strtoupper(pathinfo($cv->lien_cv, PATHINFO_EXTENSION)) }}</p>
                            <p><strong>Dernière mise à jour :</strong> {{ $cv->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
                        </div>
                        <a href="{{ route('cv.download', $cv->id_cv) }}" class="btn-success-custom" download>
                            <i class="fa fa-download"></i> Télécharger le CV
                        </a>
                    </div>

                    @php
                        $fileExtension = strtolower(pathinfo($cv->lien_cv, PATHINFO_EXTENSION));
                    @endphp

                    @if($fileExtension === 'pdf')
                        <div class="pdf-preview hidden-xs">
                            <object data="{{ route('cv.preview', $cv->id_cv) }}" type="application/pdf" width="100%" height="100%">
                                <iframe src="{{ route('cv.preview', $cv->id_cv) }}" style="border: none; width: 100%; height: 100%;" title="Aperçu du CV">
                                    <div class="cv-preview-fallback">
                                        <p>Votre navigateur ne supporte pas l'affichage PDF intégré.</p>
                                        <a href="{{ route('cv.download', $cv->id_cv) }}" class="btn-submit-blue" download>
                                            <i class="fa fa-download"></i> Télécharger le CV
                                        </a>
                                    </div>
                                </iframe>
                            </object>
                        </div>
                        <div class="cv-preview-fallback visible-xs-block" style="display:none;">
                            <i class="fa fa-file-pdf-o fa-3x"></i>
                            <h4 style="color:#2c3e50; font-weight:700;">Aperçu non disponible sur mobile</h4>
                            <p style="color:#64748b;">Pour consulter ce CV sur votre appareil mobile, veuillez le télécharger.</p>
                            <a href="{{ route('cv.download', $cv->id_cv) }}" class="btn-success-custom" download>
                                <i class="fa fa-download"></i> Télécharger le CV
                            </a>
                        </div>
                    @else
                        <div class="cv-preview-fallback">
                            <i class="fa fa-file-word-o fa-4x"></i>
                            <h4 style="color:#2c3e50; font-weight:700;">Document Word détecté</h4>
                            <p style="color:#64748b;">La prévisualisation n'est pas disponible pour les fichiers Word.</p>
                            <a href="{{ route('cv.download', $cv->id_cv) }}" class="btn-success-custom" download>
                                <i class="fa fa-download"></i> Télécharger le CV
                            </a>
                        </div>
                    @endif
                @endif

                @if(!empty($cv->live_cv))
                    @php
                        $liveData = json_decode($cv->live_cv, true) ?? [];
                    @endphp

                    <div style="margin-top: 24px;">
                        <p style="color:#64748b; margin-bottom: 18px;">
                            <strong style="color:#2c3e50;">Dernière mise à jour :</strong>
                            {{ $cv->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}
                        </p>

                        @if(!empty($liveData['experiences']))
                            <h4 class="cv-section-title"><i class="fa fa-briefcase"></i> Expériences professionnelles</h4>
                            <div class="table-responsive">
                                <table class="cv-table">
                                    <thead>
                                        <tr>
                                            <th>Expérience</th>
                                            <th>Organisme</th>
                                            <th>Période</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($liveData['experiences'] as $experience)
                                            <tr>
                                                <td data-label="Expérience">{{ $experience['titre'] ?? '' }}</td>
                                                <td data-label="Organisme">{{ $experience['organisme'] ?? '' }}</td>
                                                <td data-label="Période">{{ $experience['date'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        @if(!empty($liveData['technologies']))
                            <h4 class="cv-section-title"><i class="fa fa-keyboard-o"></i> Technologies</h4>
                            <div class="table-responsive">
                                <table class="cv-table">
                                    <thead>
                                        <tr>
                                            <th>Technologie</th>
                                            <th>Projet</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($liveData['technologies'] as $technologie)
                                            <tr>
                                                <td data-label="Technologie">{{ $technologie['titre'] ?? '' }}</td>
                                                <td data-label="Projet">{{ $technologie['projet'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="cv-alert-info">
            <i class="fa fa-info-circle"></i> Aucun CV n'a été uploadé pour le moment.
            <a href="{{ url('/candidats/cv/') }}">Retournez à l'accueil CV</a> pour en uploader un.
        </div>
    @endif
</div>

@stop
