<?php

use Livewire\Component;
use App\Models\Candidat;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public $search = '';
    public $orderByField = 'id_candidat';
    public $reverseSort = false;
    public $perPage = 10;

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
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $candidats = Candidat::query()
            ->where(function($query) {
                $query->where('nom_condidat', 'like', '%' . $this->search . '%')
                    ->orWhere('prenom_condidat', 'like', '%' . $this->search . '%')
                    ->orWhere('fonction_candidat', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->orderByField, $this->reverseSort ? 'desc' : 'asc')
            ->paginate($this->perPage);

        return view('livewire.search-candidats', [
            'candidats' => $candidats,
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
    .lw-search-bar .lw-per-page {
        flex: 0 0 auto;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        padding: 8px 12px;
        color: #475569;
        background: #fff;
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
        color: #007bff;
        font-weight: 600;
        text-decoration: none;
    }
    .lw-table tbody a.lw-name-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    .lw-fonction-badge {
        display: inline-block;
        background: #e8f1ff;
        color: #007bff;
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
    .lw-pagination {
        margin-top: 16px;
    }
</style>

    <div class="lw-search-bar">
        <div class="lw-search-input-wrap">
            <i class="fa fa-search"></i>
            <input type="text" wire:model.live="search" class="lw-search-input"
                   placeholder="Chercher un candidat (nom, prénom, fonction)...">
        </div>
        <select wire:model.live="perPage" class="lw-per-page">
            <option value="5">5 par page</option>
            <option value="10">10 par page</option>
            <option value="25">25 par page</option>
            <option value="50">50 par page</option>
        </select>
    </div>

    @if($candidats->total() > 0)
        <div class="lw-result-count">
            Affichage de {{ $candidats->firstItem() }} à {{ $candidats->lastItem() }} sur <strong>{{ $candidats->total() }}</strong> candidat(s)
        </div>
    @endif

    <div class="lw-table-wrap table-responsive">
        <table class="table lw-table table-stack mb-0">
            <thead>
                <tr>
                    <th wire:click="sortBy('nom_condidat')" class="{{ $orderByField == 'nom_condidat' ? 'sorted' : '' }}">
                        Nom
                        @if($orderByField == 'nom_condidat')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('prenom_condidat')" class="{{ $orderByField == 'prenom_condidat' ? 'sorted' : '' }}">
                        Prénom
                        @if($orderByField == 'prenom_condidat')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('fonction_candidat')" class="{{ $orderByField == 'fonction_candidat' ? 'sorted' : '' }}">
                        Fonction
                        @if($orderByField == 'fonction_candidat')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('created_at')" class="{{ $orderByField == 'created_at' ? 'sorted' : '' }}">
                        Date Enregistrement
                        @if($orderByField == 'created_at')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                        @else
                            <i class="fa fa-sort"></i>
                        @endif
                    </th>
                    <th style="cursor: default; width: 90px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidats as $candidat)
                    <tr>
                        <td data-label="Nom">
                            <a href="{{ url('candidats/show/'.$candidat->id_candidat) }}" class="lw-name-link">
                                {{ $candidat->nom_condidat }}
                            </a>
                        </td>
                        <td data-label="Prénom">{{ $candidat->prenom_condidat }}</td>
                        <td data-label="Fonction">
                            @if($candidat->fonction_candidat)
                                <span class="lw-fonction-badge">{{ $candidat->fonction_candidat }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td data-label="Enregistrement" style="color: #64748b; font-size: 0.9em;">
                            {{ $candidat->created_at?->format('d/m/Y') ?? 'N/A' }}
                        </td>
                        <td>
                            <a href="{{ url('candidats/show/'.$candidat->id_candidat) }}" class="lw-btn-view" title="Voir">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="lw-empty">
                                <i class="fa fa-search"></i>
                                <span>Aucun candidat trouvé.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($candidats->hasPages())
        <div class="lw-pagination">
            {{ $candidats->links() }}
        </div>
    @endif
</div>
