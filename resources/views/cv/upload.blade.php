@extends('layouts.front2')
@section('titre')
    CV - Upload
@stop
@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="d-flex align-items-center">
                <i class="fa fa-upload mr-2"></i> Uploader un CV
                <a href="{{ url('/candidats/cv/') }}" class="btn btn-outline-secondary ml-auto">
                    <i class="fa fa-backward"></i> Retour
                </a>
            </h2>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ url('/candidats/cv/upload') }}" method="post" enctype="multipart/form-data" id="cv-upload-form">
                @csrf
                <p class="text-muted mb-3">Formats acceptés : PDF, DOC, DOCX (méthode recommandée pour les candidats).</p>
                
                <div class="form-group">
                    <label for="cv-file" class="font-weight-bold">Sélectionner votre fichier CV :</label>
                    <input type="file" name="cv" id="cv-file" class="form-control-file" accept=".pdf,.doc,.docx" required>
                    <small class="form-text text-muted">Taille maximale : 10 Mo</small>
                </div>

                <div class="alert alert-info">
                    <i class="fa fa-info-circle mr-2"></i> Après l'upload, votre CV sera visible dans la section "Mon CV" et pourra être téléchargé facilement.
                </div>

                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fa fa-upload mr-2"></i> Uploader le CV
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('cv-upload-form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('cv-file');
    if (!fileInput.files.length) {
        e.preventDefault();
        alert('Veuillez sélectionner un fichier.');
        return;
    }
    
    const file = fileInput.files[0];
    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    
    if (!allowedTypes.includes(file.type)) {
        e.preventDefault();
        alert('Format de fichier invalide. Seuls les fichiers PDF, DOC et DOCX sont acceptés.');
        return;
    }
});
</script>
@stop