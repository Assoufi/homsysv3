<div>
    <div class="row">
        {{-- Sidebar Filters --}}
        <aside class="col-lg-3 col-md-4 mb-4">
            <div class="homsys-filter-panel">
                <div class="homsys-filter-header">
                    <h3><i class="fa fa-filter"></i> Filtres
                        @if($activeFilterCount > 0)
                            <span class="badge homsys-bgcolor" style="font-size:12px;">{{ $activeFilterCount }}</span>
                        @endif
                    </h3>
                    @if($activeFilterCount > 0)
                        <button wire:click="resetFilters" class="btn btn-sm btn-link text-danger p-0">
                            <i class="fa fa-times"></i> Tout effacer
                        </button>
                    @endif
                </div>

                {{-- Keyword Search --}}
                <div class="homsys-filter-group">
                    <label><i class="fa fa-search"></i> Recherche</label>
                    <input type="text" wire:model.live.debounce.300ms="keyword"
                           class="form-control form-control-sm"
                           placeholder="Titre, compétences, poste...">
                </div>

                {{-- City --}}
                <div class="homsys-filter-group">
                    <label><i class="fa fa-map-marker"></i> Ville</label>
                    <input type="text" wire:model.live.debounce.300ms="ville"
                           class="form-control form-control-sm"
                           placeholder="Toutes les villes"
                           list="villes-list">
                    <datalist id="villes-list">
                        @foreach($villes as $v)
                            <option value="{{ $v }}">
                        @endforeach
                    </datalist>
                </div>

                {{-- Contract Type --}}
                <div class="homsys-filter-group">
                    <label><i class="fa fa-briefcase"></i> Type de contrat</label>
                    <div class="homsys-type-filters">
                        @php
                            $types = ['Freelance', 'CDI', 'CDD', 'Stage'];
                            $typeIcons = ['Freelance' => 'fa-laptop', 'CDI' => 'fa-building', 'CDD' => 'fa-calendar-check-o', 'Stage' => 'fa-graduation-cap'];
                        @endphp
                        @foreach($types as $t)
                            <button type="button"
                                    class="btn btn-sm {{ $type === $t ? 'btn-warning' : 'btn-outline-secondary' }} homsys-type-btn"
                                    wire:click="$set('type', '{{ $type === $t ? '' : $t }}')">
                                <i class="fa {{ $typeIcons[$t] }}"></i> {{ $t }}
                                @if(isset($typeCounts[$t]))
                                    <span class="badge badge-pill {{ $type === $t ? 'badge-light' : 'badge-secondary' }}">{{ $typeCounts[$t] }}</span>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        {{-- Job Listings --}}
        <div class="col-lg-9 col-md-8">
            <div class="homsys-listing-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    {{ $offres->total() }} {{ Str::plural('offre', $offres->total()) }} trouvée{{ $offres->total() > 1 ? 's' : '' }}
                </h4>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-sort"></i> Trier par
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item {{ $sortBy === 'updated_at' ? 'active' : '' }}" wire:click="sortBy('updated_at')">
                            Date de mise à jour
                        </button>
                        <button class="dropdown-item {{ $sortBy === 'created_at' ? 'active' : '' }}" wire:click="sortBy('created_at')">
                            Date de publication
                        </button>
                        <button class="dropdown-item {{ $sortBy === 'titre_offre' ? 'active' : '' }}" wire:click="sortBy('titre_offre')">
                            Titre
                        </button>
                    </div>
                </div>
            </div>

            @if($offres->count() > 0)
                <div class="row">
                    @php $now = \Carbon\Carbon::now(); @endphp
                    @foreach($offres as $offre)
                        <div class="col-lg-6 col-xl-4 mb-4">
                            <article class="homsys-job-card">
                                <div class="homsys-job-card__header">
                                    <span class="homsys-job-card__type badge homsys-badge-type">{{ $offre->type_offre }}</span>
                                    @if($now->diff($offre->updated_at)->days < 8)
                                        <span class="homsys-job-card__new badge badge-success">Nouveau</span>
                                    @endif
                                </div>
                                <h5 class="homsys-job-card__title">
                                    <a href="{{ url('offres', $offre->id_offre . '-' . Str::slug($offre->titre_offre)) }}">
                                        {{ $offre->titre_offre }}
                                    </a>
                                </h5>
                                <div class="homsys-job-card__meta">
                                    @if(!empty($offre->ville_offre))
                                        <span><i class="fa fa-map-marker"></i> {{ $offre->ville_offre }}</span>
                                    @endif
                                    @if(!empty($offre->duree))
                                        <span><i class="fa fa-clock-o"></i> {{ $offre->duree }}</span>
                                    @endif
                                    @if(!empty($offre->experience))
                                        <span><i class="fa fa-line-chart"></i> {{ $offre->experience }} ans</span>
                                    @endif
                                </div>
                                @if(!empty($offre->competences))
                                    <div class="homsys-job-card__tags">
                                        @php
                                            $raw = strip_tags($offre->competences);
                                            $tags = array_slice(array_filter(array_map('trim', explode("\n", $raw))), 0, 4);
                                        @endphp
                                        @foreach($tags as $tag)
                                            <span class="homsys-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="homsys-job-card__footer">
                                    <small class="text-muted">
                                        <i class="fa fa-calendar"></i>
                                        Mis à jour le {{ $offre->updated_at->format('d/m/Y') }}
                                    </small>
                                    <a href="{{ url('offres', $offre->id_offre . '-' . Str::slug($offre->titre_offre)) }}"
                                       class="btn btn-sm homsys-bgcolor text-white">
                                        Voir <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $offres->withQueryString()->links() }}
                </div>
            @else
                <div class="homsys-empty-state text-center py-5">
                    <i class="fa fa-search fa-4x text-muted mb-3" style="opacity:0.3;"></i>
                    <h4 class="text-muted">Aucune offre trouvée</h4>
                    <p class="text-muted">Essayez d'élargir vos critères de recherche ou réinitialisez les filtres.</p>
                    <button wire:click="resetFilters" class="btn homsys-bgcolor text-white mt-2">
                        <i class="fa fa-refresh"></i> Réinitialiser les filtres
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .homsys-filter-panel {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .homsys-filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #eee;
    }
    .homsys-filter-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #333;
    }
    .homsys-filter-group {
        margin-bottom: 16px;
    }
    .homsys-filter-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
    }
    .homsys-type-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .homsys-type-btn {
        border-radius: 20px;
        font-size: 12px;
        padding: 4px 12px;
        transition: all 0.2s;
    }
    .homsys-type-btn .badge {
        margin-left: 4px;
        font-size: 10px;
    }
    .homsys-job-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 18px;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s, border-color 0.2s;
    }
    .homsys-job-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        border-color: #D79A10;
    }
    .homsys-job-card__header {
        display: flex;
        gap: 6px;
        margin-bottom: 10px;
    }
    .homsys-badge-type {
        background-color: #f0f0f0;
        color: #555;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 12px;
    }
    .homsys-job-card__new {
        font-size: 11px;
        padding: 3px 8px;
        border-radius: 12px;
    }
    .homsys-job-card__title {
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 10px 0;
        line-height: 1.3;
    }
    .homsys-job-card__title a {
        color: #222;
        text-decoration: none;
    }
    .homsys-job-card__title a:hover {
        color: #D79A10;
    }
    .homsys-job-card__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 10px;
        font-size: 13px;
        color: #777;
    }
    .homsys-job-card__meta i {
        margin-right: 3px;
        color: #D79A10;
    }
    .homsys-job-card__tags {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 12px;
    }
    .homsys-tag {
        background: #f7f7f7;
        color: #666;
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 4px;
        border: 1px solid #eee;
    }
    .homsys-job-card__footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 12px;
        border-top: 1px solid #f0f0f0;
    }
    .homsys-empty-state {
        background: #fafafa;
        border-radius: 8px;
    }

    @media (max-width: 767px) {
        .homsys-filter-panel {
            margin-bottom: 20px;
        }
    }
</style>
@endpush
