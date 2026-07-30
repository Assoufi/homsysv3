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
    .cv-action-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 24px 18px;
        text-align: center;
        background: #fff;
        transition: box-shadow 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        margin-bottom: 20px;
    }
    .cv-action-card:hover {
        border-color: #bfd8ff;
        box-shadow: 0 6px 16px rgba(0,123,255,0.1);
        transform: translateY(-2px);
    }
    .cv-action-card .card-icon {
        width: 56px;
        height: 56px;
        line-height: 56px;
        margin: 0 auto 14px;
        border-radius: 50%;
        background: #e8f1ff;
        color: #007bff;
        font-size: 1.4rem;
    }
    .cv-action-card .card-icon.icon-green { background: #e6f7ef; color: #28a745; }
    .cv-action-card .card-icon.icon-teal { background: #e0f7fa; color: #17a2b8; }
    .cv-action-card .card-icon.icon-gray { background: #f1f5f9; color: #6c757d; }
    .cv-action-card h4 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        margin: 0 0 10px;
    }
    .cv-action-card p {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.55;
        flex: 1;
        margin: 0 0 16px;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        padding: 10px 18px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
        display: inline-block;
        text-decoration: none !important;
        border: none;
        cursor: pointer;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        color: #ffffff !important;
    }
    .btn-outline-blue {
        display: inline-block;
        background: #fff;
        color: #007bff !important;
        border: 2px solid #007bff;
        font-weight: 700;
        padding: 9px 16px;
        border-radius: 5px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .btn-outline-blue:hover {
        background: #007bff;
        color: #fff !important;
    }
    .btn-outline-gray {
        display: inline-block;
        background: #fff;
        color: #6c757d !important;
        border: 2px solid #cbd5e1;
        font-weight: 700;
        padding: 9px 16px;
        border-radius: 5px;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-outline-gray:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: #fff !important;
    }
    .cv-alert {
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        font-weight: 500;
    }
    .cv-alert-success {
        background: #e6f7ef;
        border-color: #b7e4c7;
        color: #1b7a3d;
    }
    .cv-alert-danger {
        background: #fde8e8;
        border-color: #f5c2c7;
        color: #b02a37;
    }
    #uploadModal .modal-content {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    #uploadModal .modal-header {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        border-left: 5px solid #007bff;
        color: #007bff;
        font-weight: 700;
    }
    #uploadModal .modal-header .close {
        color: #64748b;
        opacity: 1;
    }
    .cv-hint {
        display: block;
        font-weight: 600;
        color: #d9534f;
        font-size: 0.88rem;
        margin-top: 5px;
        margin-bottom: 8px;
    }
</style>

<div class="cv-page">
    <div class="spontane-header">
        <h3><i class="fa fa-folder-open"></i> Espace CV</h3>
        <p>{{ $candidat->nom_condidat }} {{ $candidat->prenom_condidat }}</p>
    </div>

    @if(!empty(Session::get('cv')))
        <div class="cv-alert cv-alert-success">
            <i class="fa fa-check-circle"></i> {{ Session::get('cv') }}
        </div>
    @endif

    @if(!empty(Session::get('extension')))
        <div class="cv-alert cv-alert-danger">
            <i class="fa fa-exclamation-circle"></i> {{ Session::get('extension') }}
        </div>
    @endif

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-file-text"></i> Gérer mon CV</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="cv-action-card">
                        <div class="card-icon"><i class="fa fa-file-text"></i></div>
                        <h4>Mon CV</h4>
                        <p>
                            @if($candidat->cv_candidat)
                                Consultez votre CV existant ou téléchargez-le.
                            @else
                                Aucun CV disponible. Commencez par en uploader un.
                            @endif
                        </p>
                        <a href="{{ url('/candidats/cv/show') }}" class="btn-submit-blue">
                            <i class="fa fa-eye"></i> Voir mon CV
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="cv-action-card">
                        <div class="card-icon icon-green"><i class="fa fa-upload"></i></div>
                        <h4>Uploader un CV</h4>
                        <p>Téléversez votre CV au format PDF, DOC ou DOCX pour le rendre disponible.</p>
                        <button type="button" class="btn-outline-blue" data-toggle="modal" data-target="#uploadModal">
                            <i class="fa fa-upload"></i> Uploader
                        </button>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="cv-action-card">
                        <div class="card-icon icon-teal"><i class="fa fa-keyboard-o"></i></div>
                        <h4>CV en ligne</h4>
                        <p>Créez votre CV directement en ligne en ajoutant vos expériences et compétences.</p>
                        <a href="{{ url('/candidats/cv/live') }}" class="btn-outline-blue">
                            <i class="fa fa-edit"></i> Créer mon CV
                        </a>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="cv-action-card">
                        <div class="card-icon icon-gray"><i class="fa fa-arrow-left"></i></div>
                        <h4>Retour</h4>
                        <p>Retournez à votre espace candidat.</p>
                        <a href="{{ url('/candidats/index') }}" class="btn-outline-gray">
                            <i class="fa fa-home"></i> Espace candidat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel" style="font-weight:700; color:#007bff; margin:0;">
                    <i class="fa fa-upload"></i> Uploader un CV
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">&times;</button>
            </div>
            <form action="{{ url('/candidats/cv/upload') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="padding: 20px;">
                    @csrf
                    <label for="cv" style="font-weight:600; color:#2c3e50;">Joindre votre CV</label>
                    <small class="cv-hint"><i class="fa fa-info-circle"></i> Formats acceptés : PDF, DOC, DOCX</small>
                    <input type="file" name="cv" id="cv" class="form-control" accept=".pdf,.doc,.docx" required>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0; background: #f8fafc;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-submit-blue">
                        <i class="fa fa-upload"></i> Uploader
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
