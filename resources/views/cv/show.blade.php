@extends('layouts.front2')
@section('titre')
    CV - {{ $candidat->nom_condidat }} {{ $candidat->prenom_condidat }}
@stop
@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="d-flex align-items-center">
                <i class="fa fa-file-text mr-2"></i> Mon CV
                <a href="{{ url('/candidats/cv/') }}" class="btn btn-outline-secondary ml-auto">
                    <i class="fa fa-backward" aria-hidden="true"></i> Retour
                </a>
            </h2>
        </div>
    </div>

    @if($cv && ($cv->lien_cv || $cv->live_cv))
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informations du CV</h5>
            </div>
            <div class="card-body">
                @if(!empty($cv->lien_cv))
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p class="mb-1"><strong>Type:</strong> Document {{ strtoupper(pathinfo($cv->lien_cv, PATHINFO_EXTENSION)) }}</p>
                            <p class="mb-0"><strong>Dernière mise à jour:</strong> {{ $cv->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
                        </div>
                        <a href="{{ route('cv.download', $cv->id_cv) }}" class="btn btn-success btn-lg" download>
                            <i class="fa fa-download mr-2"></i> Télécharger le CV
                        </a>
                    </div>
                    <div class="pdf-preview border rounded d-none d-md-block" style="height: 700px;">
                        @php
                            $fileExtension = strtolower(pathinfo($cv->lien_cv, PATHINFO_EXTENSION));
                        @endphp
                        @if($fileExtension === 'pdf')
                        <object data="{{ route('cv.preview', $cv->id_cv) }}" type="application/pdf" width="100%" height="100%">
                            <iframe src="{{ route('cv.preview', $cv->id_cv) }}" style="border: none; width: 100%; height: 100%;" title="Aperçu du CV">
                                <div class="p-4 text-center">
                                    <p class="mb-3">Votre navigateur ne supporte pas l'affichage des PDF intégré.</p>
                                    <a href="{{ route('cv.download', $cv->id_cv) }}" class="btn btn-primary" download>
                                        <i class="fa fa-download mr-2"></i> Télécharger le CV
                                    </a>
                                </div>
                            </iframe>
                        </object>
                        @else
                        <div class="p-5 text-center">
                            <i class="fa fa-file-word-o fa-5x text-primary mb-3"></i>
                            <h4>Document Word détecté</h4>
                            <p class="text-muted">La prévisualisation n'est pas disponible pour les fichiers Word.</p>
                            <a href="{{ route('cv.download', $cv->id_cv) }}" class="btn btn-success btn-lg" download>
                                <i class="fa fa-download mr-2"></i> Télécharger le CV
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="d-md-none p-4 text-center border rounded bg-light">
                        <i class="fa fa-file-pdf-o fa-3x text-danger mb-3"></i>
                        <h5>Aperçu non disponible sur mobile</h5>
                        <p class="text-muted mb-4">Pour consulter ce CV sur votre appareil mobile, veuillez le télécharger.</p>
                        <a href="{{ route('cv.download', $cv->id_cv) }}" class="btn btn-success btn-lg btn-block" download>
                            <i class="fa fa-download mr-2"></i> Télécharger le CV
                        </a>
                    </div>
                @endif

                @if(!empty($cv->live_cv))
                    @php
                        $liveData = json_decode($cv->live_cv, true) ?? [];
                    @endphp
                    
                    <div class="mt-4">
                        <p class="mb-3"><strong>Dernière mise à jour:</strong> {{ $cv->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>

                        @if(!empty($liveData['experiences']))
                        <div class="mb-4">
                            <h4 class="border-bottom pb-2 mb-3">
                                <i class="fa fa-briefcase mr-2"></i> Expériences professionnelles
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-stack">
                                    <thead class="thead-dark">
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
                        </div>
                        @endif

                        @if(!empty($liveData['technologies']))
                        <div class="mb-4">
                            <h4 class="border-bottom pb-2 mb-3">
                                <i class="fa fa-keyboard-o mr-2"></i> Technologies
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-stack">
                                    <thead class="thead-dark">
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
                        </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <i class="fa fa-info-circle mr-2"></i> Aucun CV n'a été uploadé pour le moment.
            <a href="{{ url('/candidats/cv/') }}" class="alert-link">Retournez à l'accueil CV</a> pour en uploader un.
        </div>
    @endif
</div>
@stop