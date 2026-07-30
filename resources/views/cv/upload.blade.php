@extends('layouts.front2')

@section('titre')
    CV - Upload
@stop

@section('content')

<style>
    .cv-page {
        width: 100%;
        max-width: 700px;
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
        font-size: 1.05rem !important;
        font-weight: 700 !important;
        padding: 12px 28px !important;
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
    .cv-hint {
        display: block;
        font-weight: 600;
        color: #d9534f;
        font-size: 0.88rem;
        margin-top: 5px;
        margin-bottom: 8px;
    }
    .upload-info {
        background: #e8f1ff;
        border: 1px solid #bfd8ff;
        border-radius: 8px;
        padding: 14px 16px;
        color: #004085;
        margin-bottom: 18px;
        font-size: 0.92rem;
        line-height: 1.5;
    }
    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 6px;
        display: block;
    }
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        box-shadow: none;
        height: auto;
        padding: 10px 12px;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.12);
    }
</style>

<div class="cv-page">
    <div class="spontane-header">
        <h3><i class="fa fa-upload"></i> Uploader un CV</h3>
        <a href="{{ url('/candidats/cv/') }}" class="btn-outline-gray">
            <i class="fa fa-arrow-left"></i> Retour
        </a>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-file-text"></i> Fichier CV</div>
        <div class="panel-body">
            <form action="{{ url('/candidats/cv/upload') }}" method="post" enctype="multipart/form-data" id="cv-upload-form">
                @csrf

                <div class="upload-info">
                    <i class="fa fa-info-circle"></i>
                    Après l'upload, votre CV sera visible dans la section « Mon CV » et pourra être téléchargé facilement.
                </div>

                <div class="form-group">
                    <label for="cv-file">Sélectionner votre fichier CV <span class="text-danger">*</span></label>
                    <small class="cv-hint">
                        <i class="fa fa-info-circle"></i> Formats acceptés : PDF, DOC, DOCX — Taille max. recommandée : 10 Mo
                    </small>
                    <input type="file" name="cv" id="cv-file" class="form-control" accept=".pdf,.doc,.docx" required>
                </div>

                <div class="text-center" style="margin-top: 24px;">
                    <button type="submit" class="btn btn-submit-blue">
                        <i class="fa fa-upload"></i> Uploader le CV
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('cv-upload-form').addEventListener('submit', function (e) {
    const fileInput = document.getElementById('cv-file');
    if (!fileInput.files.length) {
        e.preventDefault();
        alert('Veuillez sélectionner un fichier.');
        return;
    }

    const file = fileInput.files[0];
    const allowedTypes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if (file.type && !allowedTypes.includes(file.type)) {
        e.preventDefault();
        alert('Format de fichier invalide. Seuls les fichiers PDF, DOC et DOCX sont acceptés.');
    }
});
</script>

@stop
