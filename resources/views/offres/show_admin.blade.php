@extends('layouts.front2')

@section('titre')
    Offre : {{ $offre->titre_offre }}
@stop

@push('styles')
<style>
    /* ── Page wrapper ───────────────────────────────────────── */
    .sa-page { padding: 2rem 0 4rem; }

    /* ── Sticky top action bar ──────────────────────────────── */
    .sa-topbar {
        position: sticky;
        top: 0;
        z-index: 999;
        background: #fff;
        border-bottom: 2px solid #e9ecef;
        padding: .75rem 1.5rem;
        display: flex;
        align-items: center;
        gap: .6rem;
        flex-wrap: wrap;
        box-shadow: 0 2px 8px rgba(0,0,0,.07);
    }
    .sa-topbar .sa-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1a3a5c;
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ── Hero card ──────────────────────────────────────────── */
    .sa-hero {
        background: linear-gradient(135deg, #1a3a5c 0%, #2563a8 100%);
        color: #fff;
        border-radius: 12px;
        padding: 2rem 2rem 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .sa-hero::after {
        content: '';
        position: absolute;
        right: -60px; top: -60px;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }
    .sa-hero h1 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: .5rem;
    }
    .sa-hero .badge-type {
        display: inline-block;
        background: rgba(255,255,255,.2);
        border: 1px solid rgba(255,255,255,.3);
        color: #fff;
        border-radius: 50px;
        padding: .3rem .9rem;
        font-size: .8rem;
        font-weight: 600;
        letter-spacing: .04em;
    }
    .sa-hero .badge-status-active {
        background: #28a745; color: #fff;
        border-radius: 50px; padding: .3rem .9rem;
        font-size: .8rem; font-weight: 600;
    }
    .sa-hero .badge-status-expired {
        background: #dc3545; color: #fff;
        border-radius: 50px; padding: .3rem .9rem;
        font-size: .8rem; font-weight: 600;
    }

    /* ── Stat chips ─────────────────────────────────────────── */
    .sa-stats { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem; }
    .sa-stat-chip {
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 8px;
        padding: .5rem 1.1rem;
        display: flex; align-items: center; gap: .5rem;
        font-size: .9rem;
    }
    .sa-stat-chip i { font-size: 1rem; opacity: .85; }
    .sa-stat-chip strong { font-size: 1.2rem; font-weight: 700; }

    /* ── Meta info grid ─────────────────────────────────────── */
    .sa-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: .75rem;
        margin-bottom: 1.5rem;
    }
    .sa-meta-item {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: .75rem 1rem;
        display: flex; align-items: flex-start; gap: .6rem;
    }
    .sa-meta-item i {
        color: #2563a8;
        font-size: 1rem;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .sa-meta-item .sa-meta-label {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 2px;
    }
    .sa-meta-item .sa-meta-value {
        font-size: .92rem;
        color: #1a3a5c;
        font-weight: 500;
    }

    /* ── Section cards ──────────────────────────────────────── */
    .sa-section {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        margin-bottom: 1.25rem;
        overflow: hidden;
    }
    .sa-section-header {
        background: linear-gradient(90deg, #1a3a5c, #2563a8);
        color: #fff;
        padding: .65rem 1.1rem;
        display: flex; align-items: center; gap: .5rem;
        font-weight: 600;
        font-size: .92rem;
        letter-spacing: .03em;
    }
    .sa-section-header i { font-size: 1rem; opacity: .9; }
    .sa-section-body {
        padding: 1.1rem 1.25rem;
        color: #2d3748;
        line-height: 1.75;
        font-size: .95rem;
    }

    /* ── Chart collapse ─────────────────────────────────────── */
    .sa-chart-toggle {
        background: none; border: none; padding: 0;
        color: rgba(255,255,255,.8);
        font-size: .85rem;
        cursor: pointer;
        display: flex; align-items: center; gap: .3rem;
        transition: color .2s;
    }
    .sa-chart-toggle:hover { color: #fff; }

    /* ── Edit / View toggle button ──────────────────────────── */
    #btn-edit-mode  { transition: all .2s; }
    #btn-view-mode  { transition: all .2s; }

    /* ── Edit form card ─────────────────────────────────────── */
    .sa-edit-card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,.07);
    }
    .sa-edit-header {
        background: linear-gradient(135deg, #1a3a5c, #2563a8);
        color: #fff;
        padding: 1rem 1.5rem;
        font-size: 1.05rem;
        font-weight: 700;
        display: flex; align-items: center; gap: .5rem;
    }
    .sa-edit-body { padding: 1.5rem; }
    .sa-edit-body .form-group label {
        font-weight: 600;
        font-size: .82rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #4a5568;
        margin-bottom: .35rem;
    }
    .sa-edit-body .form-control {
        border-radius: 6px;
        border-color: #ced4da;
        font-size: .93rem;
    }
    .sa-edit-body .form-control:focus {
        border-color: #2563a8;
        box-shadow: 0 0 0 3px rgba(37,99,168,.15);
    }
    .sa-edit-body textarea.form-control { resize: vertical; }

    /* ── Delete confirm button ──────────────────────────────── */
    .btn-delete-confirm { display: none; }
    .btn-delete-confirm.visible { display: inline-block; }

    /* ── Responsive tweaks ──────────────────────────────────── */
    @media (max-width: 576px) {
        .sa-hero h1 { font-size: 1.2rem; }
        .sa-topbar .sa-title { font-size: .95rem; }
    }
</style>
@endpush

@section('content')
<div class="sa-page">

    {{-- ══════════════════════════════════════════
         STICKY TOP ACTION BAR
    ══════════════════════════════════════════ --}}
    <div class="sa-topbar">
        <span class="sa-title">
            <i class="fa fa-briefcase mr-1"></i> {{ $offre->titre_offre }}
        </span>

        <a href="{{ url('offres') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrow-left"></i> Retour
        </a>

        <button id="btn-edit-mode" onclick="toggleMode('edit')" class="btn btn-sm btn-warning">
            <i class="fa fa-pencil-square-o"></i> Modifier
        </button>

        <button id="btn-view-mode" onclick="toggleMode('view')" class="btn btn-sm btn-secondary" style="display:none;">
            <i class="fa fa-eye"></i> Vue
        </button>

        {{-- Delete with confirmation --}}
        <button id="btn-delete-1" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('btn-delete-1').style.display='none';document.getElementById('btn-delete-2').style.display='inline-block';">
            <i class="fa fa-trash-o"></i> Supprimer
        </button>
        <a href="{{ url('offres/delete', ['id' => $offre->id_offre]) }}"
           id="btn-delete-2"
           class="btn btn-sm btn-danger"
           style="display:none;"
           onclick="return confirm('Supprimer définitivement cette offre ?')">
            <i class="fa fa-exclamation-triangle"></i> Confirmer la suppression
        </a>
    </div>

    <div class="container sa-page">

        {{-- ══════════════════════════════════════════
             VIEW MODE
        ══════════════════════════════════════════ --}}
        <div id="view-panel">

            {{-- Hero --}}
            <div class="sa-hero">
                <div class="d-flex align-items-start justify-content-between flex-wrap gap-2">
                    <div>
                        <h1>{{ $offre->titre_offre }}</h1>
                        <span class="badge-type">{{ $offre->type_offre }}</span>
                        &nbsp;
                        @if($offre->exp_offre == 1)
                            <span class="badge-status-expired"><i class="fa fa-times-circle"></i> Clôturée</span>
                        @else
                            <span class="badge-status-active"><i class="fa fa-check-circle"></i> Active</span>
                        @endif
                    </div>
                    <div>
                        <button class="sa-chart-toggle" data-toggle="collapse" data-target="#chartCollapse" aria-expanded="false">
                            <i class="fa fa-bar-chart"></i> Statistiques visites
                        </button>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="sa-stats">
                    <div class="sa-stat-chip">
                        <i class="fa fa-eye"></i>
                        <div><div style="font-size:.72rem;opacity:.8;">Vues</div><strong>{{ $visite_offres_nb }}</strong></div>
                    </div>
                    <div class="sa-stat-chip">
                        <i class="fa fa-users"></i>
                        <div><div style="font-size:.72rem;opacity:.8;">Candidatures</div><strong>{{ $candidatures }}</strong></div>
                    </div>
                    @if(!empty($offre->ville_offre))
                    <div class="sa-stat-chip">
                        <i class="fa fa-map-marker"></i>
                        <div><div style="font-size:.72rem;opacity:.8;">Ville</div><strong>{{ $offre->ville_offre }}</strong></div>
                    </div>
                    @endif
                    @if(!empty($offre->date_demarrage))
                    <div class="sa-stat-chip">
                        <i class="fa fa-calendar"></i>
                        <div><div style="font-size:.72rem;opacity:.8;">Démarrage</div><strong>{{ $offre->date_demarrage }}</strong></div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Chart (collapsed by default) --}}
            <div class="collapse mb-3" id="chartCollapse">
                <div class="sa-section">
                    <div class="sa-section-header"><i class="fa fa-bar-chart"></i> Visites par jour</div>
                    <div class="sa-section-body">
                        @include('graphs.visite_offre_jour')
                    </div>
                </div>
            </div>

            {{-- Meta grid --}}
            <div class="sa-meta-grid">
                <div class="sa-meta-item">
                    <i class="fa fa-calendar-o"></i>
                    <div>
                        <div class="sa-meta-label">Publié le</div>
                        <div class="sa-meta-value">{{ $offre->updated_at?->format('d/m/Y') ?? 'N/A' }}</div>
                    </div>
                </div>
                @if(!empty($offre->duree))
                <div class="sa-meta-item">
                    <i class="fa fa-clock-o"></i>
                    <div>
                        <div class="sa-meta-label">Durée</div>
                        <div class="sa-meta-value">{{ $offre->duree }}</div>
                    </div>
                </div>
                @endif
                @if(!empty($offre->experience))
                <div class="sa-meta-item">
                    <i class="fa fa-star-o"></i>
                    <div>
                        <div class="sa-meta-label">Expérience</div>
                        <div class="sa-meta-value">{{ $offre->experience }} an(s)</div>
                    </div>
                </div>
                @endif
                @if(!empty($offre->formation))
                <div class="sa-meta-item">
                    <i class="fa fa-graduation-cap"></i>
                    <div>
                        <div class="sa-meta-label">Formation</div>
                        <div class="sa-meta-value">{{ $offre->formation }}</div>
                    </div>
                </div>
                @endif
                @if(!empty($offre->client))
                <div class="sa-meta-item">
                    <i class="fa fa-university"></i>
                    <div>
                        <div class="sa-meta-label">Client</div>
                        <div class="sa-meta-value">{{ $offre->client }}</div>
                    </div>
                </div>
                @endif
                @if(!empty($offre->contact))
                <div class="sa-meta-item">
                    <i class="fa fa-address-card-o"></i>
                    <div>
                        <div class="sa-meta-label">Contact</div>
                        <div class="sa-meta-value">{{ $offre->contact }}</div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Content sections --}}
            @if(!empty($offre->poste))
            <div class="sa-section">
                <div class="sa-section-header"><i class="fa fa-briefcase"></i> Poste</div>
                <div class="sa-section-body">{!! $offre->poste !!}</div>
            </div>
            @endif

            @if(!empty($offre->profil))
            <div class="sa-section">
                <div class="sa-section-header"><i class="fa fa-user-o"></i> Profil recherché</div>
                <div class="sa-section-body">{!! $offre->profil !!}</div>
            </div>
            @endif

            @if(!empty($offre->competences))
            <div class="sa-section">
                <div class="sa-section-header"><i class="fa fa-cogs"></i> Compétences demandées</div>
                <div class="sa-section-body">{!! $offre->competences !!}</div>
            </div>
            @endif

            @if(!empty($offre->qualites))
            <div class="sa-section">
                <div class="sa-section-header"><i class="fa fa-heart-o"></i> Qualités personnelles</div>
                <div class="sa-section-body">{!! $offre->qualites !!}</div>
            </div>
            @endif

            @if(!empty($offre->description_offre))
            <div class="sa-section">
                <div class="sa-section-header"><i class="fa fa-align-left"></i> Détails de l'offre</div>
                <div class="sa-section-body">{!! $offre->description_offre !!}</div>
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
             EDIT MODE
        ══════════════════════════════════════════ --}}
        <div id="edit-panel" style="display:none;">
            <div class="sa-edit-card">
                <div class="sa-edit-header">
                    <i class="fa fa-pencil-square-o"></i> Modification : {{ $offre->titre_offre }}
                </div>
                <div class="sa-edit-body">
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
                                    <label for="date_demarrage">Date Démarrage</label>
                                    <input type="text" id="date_demarrage" name="date_demarrage"
                                           value="{{ $offre->date_demarrage }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duree">Durée</label>
                                    <input type="text" id="duree" name="duree"
                                           value="{{ $offre->duree }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="experience">Expérience (ans)</label>
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
                            <label>État de l'offre</label><br>
                            <input name="exp_offre"
                                   data-onstyle="warning" data-offstyle="success"
                                   @if($offre->exp_offre == 1) checked @endif
                                   data-toggle="toggle" value="1"
                                   data-on="Clôturée" data-off="Active"
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
                            <label for="competences">Compétences</label>
                            <textarea name="competences" id="competences" rows="10"
                                      class="form-control">{!! $offre->competences !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="qualites">Qualités</label>
                            <textarea name="qualites" id="qualites" rows="10"
                                      class="form-control">{!! $offre->qualites !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description_offre">Description / Détails</label>
                            <textarea name="description_offre" id="description_offre" rows="10"
                                      class="form-control">{!! $offre->description_offre !!}</textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <button type="button" onclick="toggleMode('view')" class="btn btn-outline-secondary">
                                <i class="fa fa-times"></i> Annuler
                            </button>
                            <button type="submit" class="btn btn-success btn-lg">
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
</script>
@stop
