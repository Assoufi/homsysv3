<?php

use Livewire\Component;
use App\Models\Offre;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public $search = '';
    public $orderByField = 'id_offre';
    public $reverseSort = false;

    protected $paginationTheme = 'bootstrap';

    public function sortBy($field)
    {
        if ($this->orderByField === $field) {
            $this->reverseSort = !$this->reverseSort;
        } else {
            $this->orderByField = $field;
            $this->reverseSort = false;
        }
    }

    public function updatingSearch()
    {
        // reset if pagination is added later
    }

    public function render()
    {
        $offres = Offre::query()
            ->where(function($query) {
                $query->where('titre_offre', 'like', '%' . $this->search . '%')
                    ->orWhere('ville_offre', 'like', '%' . $this->search . '%')
                    ->orWhere('type_offre', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->orderByField, $this->reverseSort ? 'desc' : 'asc')
            ->get();

        return view('livewire.search-offres', [
            'offres' => $offres,
        ]);
    }
};
?>

<div>
<style>
    .lw-search-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        margin-bottom: 18px;
        padding: 14px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }
    .lw-search-bar .lw-search-input-wrap {
        flex: 1 1 260px;
        position: relative;
    }
    .lw-search-bar .lw-search-input-wrap i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #007bff;
    }
    .lw-search-bar .lw-search-input {
        width: 100%;
        padding: 9px 12px 9px 36px;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        color: #2c3e50;
        background: #fff;
    }
    .lw-search-bar .lw-search-input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0,123,255,0.15);
    }
    .lw-result-count {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 12px;
    }
    .lw-table-wrap {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .lw-table {
        width: 100%;
        margin: 0;
        background: #fff;
    }
    .lw-table thead {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .lw-table thead th {
        padding: 12px 15px;
        font-weight: 700;
        color: #2c3e50;
        font-size: 0.9rem;
        border: none;
        white-space: nowrap;
        cursor: pointer;
        user-select: none;
    }
    .lw-table thead th:hover {
        color: #007bff;
    }
    .lw-table thead th i {
        margin-left: 4px;
        color: #94a3b8;
    }
    .lw-table thead th.sorted i {
        color: #007bff;
    }
    .lw-table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-top: 1px solid #e2e8f0;
        color: #475569;
    }
    .lw-table tbody tr:hover {
        background: #f8fafc;
    }
    .lw-table tbody a.lw-name-link {
        color: #2c3e50;
        font-weight: 600;
        text-decoration: none;
    }
    .lw-table tbody a.lw-name-link:hover {
        color: #007bff;
    }
    .lw-type-badge {
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
    .lw-status-active {
        display: inline-block;
        background: #d4edda;
        color: #155724;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 4px 10px;
        border-radius: 4px;
    }
    .lw-status-expired {
        display: inline-block;
        background: #f8d7da;
        color: #721c24;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 4px 10px;
        border-radius: 4px;
    }
    .lw-btn-view {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid #007bff;
        color: #007bff;
        background: #fff;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .lw-btn-view:hover {
        background: #007bff;
        color: #fff;
    }
    .lw-empty {
        text-align: center;
        padding: 40px 16px;
        color: #64748b;
    }
    .lw-empty i {
        font-size: 42px;
        color: #94a3b8;
        display: block;
        margin-bottom: 10px;
    }
</style>

    <div class="lw-search-bar">
        <div class="lw-search-input-wrap">
            <i class="fa fa-search"></i>
            <input type="text" wire:model.live="search" class="lw-search-input"
                   placeholder="Chercher une offre (titre, ville, type)...">
        </div>
    </div>

    @if($offres->count() > 0)
        <div class="lw-result-count">
            <strong>{{ $offres->count() }}</strong> offre{{ $offres->count() > 1 ? 's' : '' }} trouvée{{ $offres->count() > 1 ? 's' : '' }}
        </div>
    @endif

    <div class="lw-table-wrap table-responsive">
        <table class="table lw-table table-stack mb-0">
            <thead>
                <tr>
                    <th wire:click="sortBy('id_offre')" class="{{ $orderByField == 'id_offre' ? 'sorted' : '' }}">
                        ID
                        @if($orderByField == 'id_offre')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('titre_offre')" class="{{ $orderByField == 'titre_offre' ? 'sorted' : '' }}">
                        Titre
                        @if($orderByField == 'titre_offre')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('type_offre')" class="{{ $orderByField == 'type_offre' ? 'sorted' : '' }}">
                        Type
                        @if($orderByField == 'type_offre')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('ville_offre')" class="{{ $orderByField == 'ville_offre' ? 'sorted' : '' }}">
                        Ville
                        @if($orderByField == 'ville_offre')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('exp_offre')" class="{{ $orderByField == 'exp_offre' ? 'sorted' : '' }}">
                        État
                        @if($orderByField == 'exp_offre')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('created_at')" class="{{ $orderByField == 'created_at' ? 'sorted' : '' }}">
                        Publication
                        @if($orderByField == 'created_at')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('updated_at')" class="{{ $orderByField == 'updated_at' ? 'sorted' : '' }}">
                        Modification
                        @if($orderByField == 'updated_at')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th style="cursor: default; width: 90px;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($offres as $offre)
                    <tr>
                        <td data-label="ID">{{ $offre->id_offre }}</td>
                        <td data-label="Titre">
                            <a href="{{ url('offres/'.$offre->id_offre) }}" class="lw-name-link">
                                {{ $offre->titre_offre }}
                            </a>
                        </td>
                        <td data-label="Type">
                            <span class="lw-type-badge">{{ $offre->type_offre }}</span>
                        </td>
                        <td data-label="Ville">
                            <i class="fa fa-map-marker" style="color:#007bff; margin-right:4px;"></i>
                            {{ $offre->ville_offre }}
                        </td>
                        <td data-label="État">
                            @if($offre->exp_offre == '0')
                                <span class="lw-status-active">En cours</span>
                            @else
                                <span class="lw-status-expired">Expirée</span>
                            @endif
                        </td>
                        <td data-label="Publication" style="color:#64748b; font-size:0.9em;">
                            {{ $offre->created_at?->format('d/m/Y') ?? 'N/A' }}
                        </td>
                        <td data-label="Modification" style="color:#64748b; font-size:0.9em;">
                            {{ $offre->updated_at?->format('d/m/Y') ?? 'N/A' }}
                        </td>
                        <td>
                            <a href="{{ url('offres/'.$offre->id_offre) }}" class="lw-btn-view" title="Voir">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="lw-empty">
                                <i class="fa fa-briefcase"></i>
                                <span>Aucune offre trouvée.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
