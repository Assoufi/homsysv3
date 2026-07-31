<div>
<style>
    /* Aligné sur le design index.blade (bleu #007bff) */
    .lw-filter-panel {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .lw-filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e2e8f0;
    }
    .lw-filter-header h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #2c3e50;
    }
    .lw-badge-count {
        display: inline-block;
        background: #007bff;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 12px;
        margin-left: 4px;
        vertical-align: middle;
    }
    .lw-filter-group {
        margin-bottom: 16px;
    }
    .lw-filter-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
    }
    .lw-filter-group label i {
        color: #007bff;
        margin-right: 3px;
    }
    .lw-input {
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        color: #2c3e50;
    }
    .lw-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0,123,255,0.15);
    }
    .lw-type-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .lw-type-btn {
        border-radius: 20px;
        font-size: 12px;
        padding: 5px 12px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        color: #475569;
        transition: all 0.2s ease;
    }
    .lw-type-btn:hover {
        border-color: #007bff;
        color: #007bff;
        background: #e8f1ff;
    }
    .lw-type-btn--active {
        background: #007bff !important;
        border-color: #007bff !important;
        color: #fff !important;
    }
    .lw-type-count {
        display: inline-block;
        background: rgba(0,0,0,0.08);
        font-size: 10px;
        padding: 1px 6px;
        border-radius: 10px;
        margin-left: 3px;
    }
    .lw-type-btn--active .lw-type-count {
        background: rgba(255,255,255,0.25);
    }
    .lw-listing-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .lw-listing-header h4 {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        margin: 0;
    }
    .lw-btn-outline {
        background: #fff;
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 5px;
        font-weight: 600;
    }
    .lw-btn-outline:hover,
    .lw-btn-outline:focus {
        background: #007bff;
        color: #fff;
    }
    .home-offer.lw-job-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 18px;
        margin-bottom: 0;
        text-decoration: none !important;
        transition: box-shadow 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        background: #fff;
    }
    .home-offer.lw-job-card:hover {
        border-color: #bfd8ff;
        box-shadow: 0 6px 16px rgba(0,123,255,0.1);
        transform: translateY(-2px);
    }
    .lw-job-card__top {
        display: flex;
        gap: 6px;
        align-items: center;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    .home-offer-type {
        display: inline-block;
        background: #e8f1ff;
        color: #007bff;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .lw-badge-new {
        display: inline-block;
        background: #d4edda;
        color: #155724;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 4px;
    }
    .home-offer.lw-job-card h4 {
        margin: 0 0 10px;
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        line-height: 1.4;
    }
    .home-offer.lw-job-card:hover h4 {
        color: #007bff;
    }
    .home-offer-meta {
        list-style: none;
        padding: 0;
        margin: 0 0 12px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 14px;
        color: #64748b;
        font-size: 0.88rem;
    }
    .home-offer-meta li i {
        color: #007bff;
        margin-right: 4px;
    }
    .lw-job-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 12px;
    }
    .lw-tag {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 4px;
        border: 1px solid #e2e8f0;
    }
    .lw-job-card__footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 12px;
        border-top: 1px solid #e2e8f0;
        font-size: 0.85rem;
    }
    .lw-link-more {
        color: #007bff;
        font-weight: 700;
        font-size: 0.85rem;
    }
    .home-offer.lw-job-card:hover .lw-link-more {
        text-decoration: underline;
    }
    .lw-empty-state {
        text-align: center;
        color: #64748b;
        padding: 40px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }
    .lw-empty-state h4 {
        color: #2c3e50;
        font-weight: 700;
        margin: 0 0 8px;
    }
    .lw-empty-state p {
        margin: 0;
        font-size: 0.95rem;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        padding: 10px 20px !important;
        border-radius: 5px !important;
        text-decoration: none !important;
        display: inline-block !important;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
    .dropdown-item.active {
        background-color: #e8f1ff;
        color: #007bff;
    }
    @media (max-width: 767px) {
        .lw-filter-panel {
            margin-bottom: 20px;
        }
    }
</style>

    <div class="row">
        {{-- Sidebar Filters --}}
        <aside class="col-lg-3 col-md-4 mb-4">
            <div class="lw-filter-panel">
                <div class="lw-filter-header">
                    <h3><i class="fa fa-filter"></i> Filtres
                        @if($activeFilterCount > 0)
                            <span class="lw-badge-count">{{ $activeFilterCount }}</span>
                        @endif
                    </h3>
                    @if($activeFilterCount > 0)
                        <button wire:click="resetFilters" type="button" class="btn btn-sm btn-link text-danger p-0">
                            <i class="fa fa-times"></i> Tout effacer
                        </button>
                    @endif
                </div>

                <div class="lw-filter-group">
                    <label><i class="fa fa-search"></i> Recherche</label>
                    <input type="text" wire:model.live.debounce.300ms="keyword"
                           class="form-control form-control-sm lw-input"
                           placeholder="Titre, compétences, poste...">
                </div>

                <div class="lw-filter-group">
                    <label><i class="fa fa-map-marker"></i> Ville</label>
                    <input type="text" wire:model.live.debounce.300ms="ville"
                           class="form-control form-control-sm lw-input"
                           placeholder="Toutes les villes"
                           list="villes-list">
                    <datalist id="villes-list">
                        @foreach($villes as $v)
                            <option value="{{ $v }}">
                        @endforeach
                    </datalist>
                </div>

                <div class="lw-filter-group">
                    <label><i class="fa fa-briefcase"></i> Type de contrat</label>
                    <div class="lw-type-filters">
                        @php
                            $types = ['Freelance', 'CDI', 'CDD', 'Stage'];
                            $typeIcons = ['Freelance' => 'fa-laptop', 'CDI' => 'fa-building', 'CDD' => 'fa-calendar-check-o', 'Stage' => 'fa-graduation-cap'];
                        @endphp
                        @foreach($types as $t)
                            <button type="button"
                                    class="btn btn-sm lw-type-btn {{ $type === $t ? 'lw-type-btn--active' : '' }}"
                                    wire:click="$set('type', '{{ $type === $t ? '' : $t }}')">
                                <i class="fa {{ $typeIcons[$t] }}"></i> {{ $t }}
                                @if(isset($typeCounts[$t]))
                                    <span class="lw-type-count">{{ $typeCounts[$t] }}</span>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        {{-- Job Listings --}}
        <div class="col-lg-9 col-md-8">
            <div class="lw-listing-header">
                <h4>
                    {{ $offres->total() }} {{ Str::plural('offre', $offres->total()) }} trouvée{{ $offres->total() > 1 ? 's' : '' }}
                </h4>
                <div class="dropdown">
                    <button class="btn btn-sm lw-btn-outline dropdown-toggle" type="button" data-toggle="dropdown">
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
                        <div class="col-lg-6 col-xl-4 mb-3">
                            <a class="home-offer lw-job-card" href="{{ url('offres', $offre->id_offre . '-' . Str::slug($offre->titre_offre)) }}">
                                <div class="lw-job-card__top">
                                    <span class="home-offer-type">{{ $offre->type_offre }}</span>
                                    @if($now->diff($offre->updated_at)->days < 8)
                                        <span class="lw-badge-new">Nouveau</span>
                                    @endif
                                </div>
                                <h4>{{ $offre->titre_offre }}</h4>
                                <ul class="home-offer-meta">
                                    @if(!empty($offre->ville_offre))
                                        <li><i class="fa fa-map-marker"></i> {{ $offre->ville_offre }}</li>
                                    @endif
                                    @if(!empty($offre->duree))
                                        <li><i class="fa fa-clock-o"></i> {{ $offre->duree }}</li>
                                    @endif
                                    @if(!empty($offre->experience))
                                        <li><i class="fa fa-line-chart"></i> {{ $offre->experience }} ans</li>
                                    @endif
                                </ul>
                                @if(!empty($offre->competences))
                                    <div class="lw-job-tags">
                                        @php
                                            $raw = strip_tags($offre->competences);
                                            $tags = array_slice(array_filter(array_map('trim', explode("\n", $raw))), 0, 4);
                                        @endphp
                                        @foreach($tags as $tag)
                                            <span class="lw-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="lw-job-card__footer">
                                    <small class="text-muted">
                                        <i class="fa fa-calendar"></i>
                                        {{ $offre->updated_at->format('d/m/Y') }}
                                    </small>
                                    <span class="lw-link-more">Voir <i class="fa fa-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $offres->withQueryString()->links() }}
                </div>
            @else
                <div class="lw-empty-state">
                    <i class="fa fa-search fa-3x" style="color:#94a3b8; margin-bottom:12px;"></i>
                    <h4>Aucune offre trouvée</h4>
                    <p>Essayez d'élargir vos critères de recherche ou réinitialisez les filtres.</p>
                    <button wire:click="resetFilters" type="button" class="btn btn-submit-blue mt-2">
                        <i class="fa fa-refresh"></i> Réinitialiser les filtres
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
