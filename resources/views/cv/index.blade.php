@extends('layouts.front2')
@section('titre')
    CV - {{ $candidat->nom_condidat }} {{ $candidat->prenom_condidat }}
@stop
@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="d-flex align-items-center">
                <i class="fa fa-folder-open mr-2"></i> Espace CV
            </h2>
        </div>
    </div>

    @if(!empty(Session::get('cv')))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle mr-2"></i> {{ Session::get('cv') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">&times;</button>
        </div>
    @endif

    @if(!empty(Session::get('extension')))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle mr-2"></i> {{ Session::get('extension') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">&times;</button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <div class="mb-3">
                        <i class="fa fa-file-text fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Mon CV</h5>
                    <p class="card-text text-muted flex-grow-1">
                        @if($candidat->cv_candidat)
                            Consultez votre CV existant ou téléchargez-le.
                        @else
                            Aucun CV disponible. Commencez par en uploader un.
                        @endif
                    </p>
                    <a href="{{ url('/candidats/cv/show') }}" class="btn btn-primary mt-auto">
                        <i class="fa fa-eye mr-1"></i> Voir mon CV
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <div class="mb-3">
                        <i class="fa fa-upload fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title">Uploader un CV</h5>
                    <p class="card-text text-muted flex-grow-1">
                        Téléversez votre CV au format PDF, DOC ou DOCX pour le rendre disponible.
                    </p>
                    <button type="button" class="btn btn-success mt-auto" data-toggle="modal" data-target="#uploadModal">
                        <i class="fa fa-upload mr-1"></i> Uploader maintenant
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <div class="mb-3">
                        <i class="fa fa-keyboard-o fa-3x text-info"></i>
                    </div>
                    <h5 class="card-title">CV en ligne</h5>
                    <p class="card-text text-muted flex-grow-1">
                        Créez votre CV directement en ligne en ajoutant vos expériences et compétences.
                    </p>
                    <a href="{{ url('/candidats/cv/live') }}" class="btn btn-info mt-auto">
                        <i class="fa fa-edit mr-1"></i> Créer mon CV
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column">
                    <div class="mb-3">
                        <i class="fa fa-backward fa-3x text-secondary"></i>
                    </div>
                    <h5 class="card-title">Retour</h5>
                    <p class="card-text text-muted flex-grow-1">
                        Retournez à votre espace candidat.
                    </p>
                    <a href="{{ url('/candidats/index') }}" class="btn btn-secondary mt-auto">
                        <i class="fa fa-arrow-left mr-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="uploadModalLabel">
                    <i class="fa fa-upload mr-2"></i> Uploader un CV
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">&times;</button>
            </div>
            <form action="{{ url('/candidats/cv/upload') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <p class="text-muted mb-3">Seuls les fichiers PDF, DOC et DOCX sont acceptés.</p>
                    <div class="form-group">
                        <input type="file" name="cv" id="cv" class="form-control-file" accept=".pdf,.doc,.docx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-upload mr-1"></i> Uploader
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop