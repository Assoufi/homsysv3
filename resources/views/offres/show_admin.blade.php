@extends('layouts.front2')

@section('titre')
    Offre : {{ $offre->titre_offre }}
@stop

@push('styles')
<style>
    .sa-page {
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
    .panel-custom .panel-heading .badge-type {
        display: inline-block;
        background: #e8f1ff;
        border: 1px solid #bfd8ff;
        color: #007bff;
        border-radius: 50px;
        padding: .2rem .7rem;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .04em;
        margin-left: 8px;
    }
    .panel-custom .panel-heading .badge-status-active {
        background: #d4edda;
        color: #155724;
        border-radius: 50px;
        padding: .2rem .7rem;
        font-size: .78rem;
        font-weight: 600;
        margin-left: 4px;
    }
    .panel-custom .panel-heading .badge-status-expired {
        background: #f8d7da;
        color: #721c24;
        border-radius: 50px;
        padding: .2rem .7rem;
        font-size: .78rem;
        font-weight: 600;
        margin-left: 4px;
    }
    .panel-custom .panel-body {
        padding: 20px;
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
        color: #2c3e50;
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
    .sa-chart-toggle {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        padding: 8px 14px;
        color: #007bff;
        font-size: .85rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        transition: all .2s;
    }
    .sa-chart-toggle:hover {
        background: #e8f1ff;
        border-color: #007bff;
        color: #0056b3;
    }
    #btn-edit-mode { transition: all .2s; }
    #btn-view-mode { transition: all .2s; }
    .sa-edit-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,.07);
    }
    .sa-edit-body { padding: 1.5rem; }
    .sa-edit-body .form-group label {
        font-weight: 600;
        font-size: .82rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #475569;
        margin-bottom: .35rem;
    }
    .sa-edit-body .form-control {
        border-radius: 5px;
        border: 1px solid #e2e8f0;
        font-size: .93rem;
    }
    .sa-edit-body .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.12);
    }
    .sa-edit-body textarea.form-control { resize: vertical; }
    .btn-delete-confirm { display: none; }
    .btn-delete-confirm.visible { display: inline-block; }
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
    @media (max-width: 576px) {
        .about-stat .stat-number { font-size: 1.3rem; }
    }
</style>
@endpush

@section('content')
<div class="sa-page">

    {{-- ══════════════════════════════════════════
         SPONTANE HEADER (like about/contact)
    ══════════════════════════════════════════ --}}
    <div class="spontane-header">
        <h3><i class="fa fa-briefcase mr-1"></i> {{ $offre->titre_offre }}</h3>
        <div class="d-flex gap-2 flex-wrap mt-2">
            <a href="{{ url('offres') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Retour
            </a>
            <button id="btn-edit-mode" onclick="toggleMode('edit')" class="btn btn-warning btn-sm">
                <i class="fa fa-pencil-square-o"></i> Modifier
            </button>
            <button id="btn-view-mode" onclick="toggleMode('view')" class="btn btn-secondary btn-sm" style="display:none;">
                <i class="fa fa-eye"></i> Vue
            </button>
            <button onclick="linkedinModal({{ $offre->id_offre }})" class="btn btn-info btn-sm">
                <i class="fa fa-linkedin-square"></i> Publier sur LinkedIn
            </button>
            <button id="btn-delete-1" class="btn btn-outline-danger btn-sm" onclick="document.getElementById('btn-delete-1').style.display='none';document.getElementById('btn-delete-2').style.display='inline-block';">
                <i class="fa fa-trash-o"></i> Supprimer
            </button>
            <a href="{{ url('offres/delete', ['id' => $offre->id_offre]) }}"
               id="btn-delete-2"
               class="btn btn-danger btn-sm"
               style="display:none;"
               onclick="return confirm('Supprimer définitivement cette offre ?')">
                <i class="fa fa-exclamation-triangle"></i> Confirmer
            </a>
        </div>
    </div>

    <div class="container sa-page">

        {{-- ══════════════════════════════════════════
             VIEW MODE
        ══════════════════════════════════════════ --}}
        <div id="view-panel">

            {{-- Hero / Info Panel --}}
            <div class="panel panel-custom">
                <div class="panel-heading">
                    <i class="fa fa-briefcase"></i> {{ $offre->titre_offre }}
                    <span class="badge-type">{{ $offre->type_offre }}</span>
                    &nbsp;
                    @if($offre->exp_offre == 1)
                        <span class="badge-status-expired"><i class="fa fa-times-circle"></i> Cl&ocirc;tur&eacute;e</span>
                    @else
                        <span class="badge-status-active"><i class="fa fa-check-circle"></i> Active</span>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="about-stats">
                        <div class="about-stat">
                            <div class="stat-icon"><i class="fa fa-eye"></i></div>
                            <span class="stat-number">{{ $visite_offres_nb }}</span>
                            <span class="stat-label">Vues</span>
                        </div>
                        <div class="about-stat">
                            <div class="stat-icon"><i class="fa fa-users"></i></div>
                            <span class="stat-number">{{ $candidatures }}</span>
                            <span class="stat-label">Candidatures</span>
                        </div>
                        @if(!empty($offre->ville_offre))
                        <div class="about-stat">
                            <div class="stat-icon"><i class="fa fa-map-marker"></i></div>
                            <span class="stat-number">{{ $offre->ville_offre }}</span>
                            <span class="stat-label">Ville</span>
                        </div>
                        @endif
                        @if(!empty($offre->date_demarrage))
                        <div class="about-stat">
                            <div class="stat-icon"><i class="fa fa-calendar"></i></div>
                            <span class="stat-number">{{ $offre->date_demarrage }}</span>
                            <span class="stat-label">D&eacute;marrage</span>
                        </div>
                        @endif
                    </div>

                    <div class="about-refs mt-3">
                        <button class="sa-chart-toggle" data-toggle="collapse" data-target="#chartCollapse" aria-expanded="false">
                            <i class="fa fa-bar-chart"></i> Statistiques visites
                        </button>
                    </div>
                </div>
            </div>

            {{-- Chart (collapsed by default) --}}
            <div class="collapse mb-3" id="chartCollapse">
                <div class="panel panel-custom">
                    <div class="panel-heading"><i class="fa fa-bar-chart"></i> Visites par jour</div>
                    <div class="panel-body">
                        @include('graphs.visite_offre_jour')
                    </div>
                </div>
            </div>

            {{-- Meta grid --}}
            <div class="about-card-grid">
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-calendar-o"></i></div>
                    <h4>Publi&eacute; le</h4>
                    <p>{{ $offre->updated_at?->format('d/m/Y') ?? 'N/A' }}</p>
                </div>
                @if(!empty($offre->duree))
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-clock-o"></i></div>
                    <h4>Dur&eacute;e</h4>
                    <p>{{ $offre->duree }}</p>
                </div>
                @endif
                @if(!empty($offre->experience))
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-star-o"></i></div>
                    <h4>Exp&eacute;rience</h4>
                    <p>{{ $offre->experience }} an(s)</p>
                </div>
                @endif
                @if(!empty($offre->formation))
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-graduation-cap"></i></div>
                    <h4>Formation</h4>
                    <p>{{ $offre->formation }}</p>
                </div>
                @endif
                @if(!empty($offre->client))
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-university"></i></div>
                    <h4>Client</h4>
                    <p>{{ $offre->client }}</p>
                </div>
                @endif
                @if(!empty($offre->contact))
                <div class="about-card">
                    <div class="card-icon"><i class="fa fa-address-card-o"></i></div>
                    <h4>Contact</h4>
                    <p>{{ $offre->contact }}</p>
                </div>
                @endif
            </div>

            {{-- Content sections --}}
            @if(!empty($offre->poste))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-briefcase"></i> Poste</div>
                <div class="panel-body">{!! $offre->poste !!}</div>
            </div>
            @endif

            @if(!empty($offre->profil))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-user-o"></i> Profil recherch&eacute;</div>
                <div class="panel-body">{!! $offre->profil !!}</div>
            </div>
            @endif

            @if(!empty($offre->competences))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-cogs"></i> Comp&eacute;tences demand&eacute;es</div>
                <div class="panel-body">{!! $offre->competences !!}</div>
            </div>
            @endif

            @if(!empty($offre->qualites))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-heart-o"></i> Qualit&eacute;s personnelles</div>
                <div class="panel-body">{!! $offre->qualites !!}</div>
            </div>
            @endif

            @if(!empty($offre->description_offre))
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-align-left"></i> D&eacute;tails de l&rsquo;offre</div>
                <div class="panel-body">{!! $offre->description_offre !!}</div>
            </div>
            @endif

            <div class="d-flex gap-2 mt-3 flex-wrap">
                <a href="{{ url('offres') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i> Retour aux offres
                </a>
                <button onclick="toggleMode('edit')" class="btn btn-warning">
                    <i class="fa fa-pencil-square-o"></i> Modifier cette offre
                </button>
            </div>
        </div>{{-- /view-panel --}}


        {{-- ══════════════════════════════════════════
             LINKEDIN MODAL
        ══════════════════════════════════════════ --}}
        <div class="modal fade" id="linkedinModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background:linear-gradient(135deg,#0077b5,#00a0dc);color:#fff;">
                        <h5 class="modal-title">
                            <i class="fa fa-linkedin-square"></i> Aperçu du post LinkedIn
                        </h5>
                        <button type="button" class="close text-white" onclick="closeLinkedinModal()" aria-label="Fermer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="linkedin-loading" class="text-center py-4">
                            <i class="fa fa-spinner fa-spin fa-2x"></i>
                            <p class="mt-2">Génération du post...</p>
                        </div>
                        <div id="linkedin-content" style="display:none;">
                            <div style="background:#f0f4f8;border:1px solid #d1d9e6;border-radius:8px;padding:1.25rem;margin-bottom:1rem;white-space:pre-wrap;font-family:sans-serif;font-size:.95rem;line-height:1.6;color:#1a3a5c;max-height:400px;overflow-y:auto;">
                                <div id="linkedin-post-text"></div>
                            </div>
                            <div class="alert alert-info small">
                                <i class="fa fa-info-circle"></i>
                                Ce post a été généré automatiquement à partir des données de l'offre.
                                Vous pouvez le modifier avant de le publier.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="closeLinkedinModal()">
                            <i class="fa fa-times"></i> Fermer
                        </button>
                        <div class="d-flex gap-2 flex-wrap">
                            <button onclick="copyLinkedinPost()" class="btn btn-outline-primary">
                                <i class="fa fa-clipboard"></i> Copier le texte
                            </button>
                            <a id="linkedin-share-btn" href="#" target="_blank" class="btn btn-primary" style="background:#0077b5;border-color:#0077b5;">
                                <i class="fa fa-linkedin-square"></i> Publier sur LinkedIn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- ══════════════════════════════════════════
             EDIT MODE
        ══════════════════════════════════════════ --}}
        <div id="edit-panel" style="display:none;">
            <div class="panel panel-custom">
                <div class="panel-heading"><i class="fa fa-pencil-square-o"></i> Modification : {{ $offre->titre_offre }}</div>
                <div class="panel-body">
                    <form action="{{ url('offres/update/'.$offre->id_offre) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="titre_offre">Titre</label>
                                    <input type="text" id="titre_offre" name="titre_offre"
                                           value="{{ $offre->titre_offre }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type_offre">Type</label>
                                    <select name="type_offre" id="type_offre" class="form-control">
                                        @foreach($types_offre as $key => $value)
                                            <option value="{{ $key }}" {{ $offre->type_offre == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ville_offre">Ville</label>
                                    <input type="text" id="ville_offre" name="ville_offre"
                                           value="{{ $offre->ville_offre }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_demarrage">Date D&eacute;marrage</label>
                                    <input type="text" id="date_demarrage" name="date_demarrage"
                                           value="{{ $offre->date_demarrage }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duree">Dur&eacute;e</label>
                                    <input type="text" id="duree" name="duree"
                                           value="{{ $offre->duree }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="experience">Exp&eacute;rience (ans)</label>
                                    <input type="number" id="experience" name="experience"
                                           value="{{ $offre->experience }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formation">Formation</label>
                                    <input type="text" id="formation" name="formation"
                                           value="{{ $offre->formation }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client">Client</label>
                                    <input type="text" id="client" name="client"
                                           value="{{ $offre->client }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="text" id="contact" name="contact"
                                           value="{{ $offre->contact }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>&Eacute;tat de l&rsquo;offre</label><br>
                            <input name="exp_offre"
                                   data-onstyle="warning" data-offstyle="success"
                                   @if($offre->exp_offre == 1) checked @endif
                                   data-toggle="toggle" value="1"
                                   data-on="Cl&ocirc;tur&eacute;e" data-off="Active"
                                   data-width="140"
                                   type="checkbox">
                        </div>

                        <hr class="my-3">

                        <div class="form-group">
                            <label for="poste">Poste</label>
                            <textarea name="poste" id="poste" rows="10"
                                      class="form-control">{{ $offre->poste }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="profil">Profil</label>
                            <textarea name="profil" id="profil" rows="10"
                                      class="form-control">{{ $offre->profil }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="competences">Comp&eacute;tences</label>
                            <textarea name="competences" id="competences" rows="10"
                                      class="form-control">{!! $offre->competences !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="qualites">Qualit&eacute;s</label>
                            <textarea name="qualites" id="qualites" rows="10"
                                      class="form-control">{!! $offre->qualites !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description_offre">Description / D&eacute;tails</label>
                            <textarea name="description_offre" id="description_offre" rows="10"
                                      class="form-control">{!! $offre->description_offre !!}</textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <button type="button" onclick="toggleMode('view')" class="btn btn-outline-secondary">
                                <i class="fa fa-times"></i> Annuler
                            </button>
                            <button type="submit" class="btn btn-submit-blue">
                                <i class="fa fa-floppy-o"></i> Enregistrer les modifications
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>{{-- /edit-panel --}}

    </div>
</div>
@stop

@section('scripts')
<script>
    function toggleMode(mode) {
        var viewPanel = document.getElementById('view-panel');
        var editPanel = document.getElementById('edit-panel');
        var btnEdit   = document.getElementById('btn-edit-mode');
        var btnView   = document.getElementById('btn-view-mode');

        if (mode === 'edit') {
            viewPanel.style.display = 'none';
            editPanel.style.display = 'block';
            btnEdit.style.display   = 'none';
            btnView.style.display   = 'inline-block';
            editPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
            editPanel.style.display = 'none';
            viewPanel.style.display = 'block';
            btnEdit.style.display   = 'inline-block';
            btnView.style.display   = 'none';
            viewPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // Auto-switch to edit mode if there are validation errors
    @if($errors->any())
        toggleMode('edit');
    @endif

    /* ══════════════════════════════════════════
       LINKEDIN POST — vanilla JS
    ══════════════════════════════════════════ */
    function linkedinModal(id) {
        var modal = document.getElementById('linkedinModal');
        if (!modal) return;

        modal.style.display = 'block';
        modal.classList.add('show');
        document.body.classList.add('modal-open');

        var backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        document.body.appendChild(backdrop);

        document.getElementById('linkedin-loading').style.display = 'block';
        document.getElementById('linkedin-content').style.display = 'none';

        fetch('{{ url("offres/linkedin-post") }}/' + id)
            .then(function(r) { return r.json(); })
            .then(function(data) {
                document.getElementById('linkedin-loading').style.display = 'none';
                document.getElementById('linkedin-content').style.display = 'block';
                document.getElementById('linkedin-post-text').textContent = data.post;
                document.getElementById('linkedin-share-btn').href = data.shareUrl;
            })
            .catch(function() {
                document.getElementById('linkedin-loading').innerHTML =
                    '<i class="fa fa-exclamation-triangle text-danger fa-2x"></i>' +
                    '<p class="mt-2 text-danger">Erreur lors de la g\u00e9n\u00e9ration du post.</p>';
            });
    }

    function closeLinkedinModal() {
        var modal = document.getElementById('linkedinModal');
        if (!modal) return;
        modal.style.display = 'none';
        modal.classList.remove('show');
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(function(b) { b.remove(); });
    }

    function copyLinkedinPost() {
        var text = document.getElementById('linkedin-post-text').textContent;
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Post copié dans le presse-papiers !');
            });
        } else {
            var ta = document.createElement('textarea');
            ta.value = text;
            ta.style.position = 'fixed';
            ta.style.left = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            document.execCommand('copy');
            document.body.removeChild(ta);
            alert('Post copié dans le presse-papiers !');
        }
    }
</script>
@stop
