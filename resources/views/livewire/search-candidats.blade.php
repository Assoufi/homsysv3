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
    <div class="well">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Chercher un candidat...">
                    <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <select wire:model.live="perPage" class="form-control input-sm" style="display: inline-block; width: auto;">
                    <option value="5">5 par page</option>
                    <option value="10">10 par page</option>
                    <option value="25">25 par page</option>
                    <option value="50">50 par page</option>
                </select>
            </div>
        </div>
    </div>

    @if($candidats->total() > 0)
    <div class="text-muted mb-2">
        Affichage de {{ $candidats->firstItem() }} à {{ $candidats->lastItem() }} sur {{ $candidats->total() }} candidat(s)
    </div>
    @endif

    <div class="table-responsive" style="border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <table class="table table-hover table-stack mb-0">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th wire:click="sortBy('nom_condidat')" style="cursor: pointer; padding: 12px 15px; font-weight: 600; color: #495057;">
                        Nom
                        @if($orderByField == 'nom_condidat')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}" style="margin-left: 5px;"></i>
                        @else
                            <i class="fa fa-sort" style="margin-left: 5px; color: #ccc;"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('prenom_condidat')" style="cursor: pointer; padding: 12px 15px; font-weight: 600; color: #495057;">
                        Prénom
                        @if($orderByField == 'prenom_condidat')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}" style="margin-left: 5px;"></i>
                        @else
                            <i class="fa fa-sort" style="margin-left: 5px; color: #ccc;"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('fonction_candidat')" style="cursor: pointer; padding: 12px 15px; font-weight: 600; color: #495057;">
                        Fonction
                        @if($orderByField == 'fonction_candidat')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}" style="margin-left: 5px;"></i>
                        @else
                            <i class="fa fa-sort" style="margin-left: 5px; color: #ccc;"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('created_at')" style="cursor: pointer; padding: 12px 15px; font-weight: 600; color: #495057;">
                        Date Enregistrement
                        @if($orderByField == 'created_at')
                            <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}" style="margin-left: 5px;"></i>
                        @else
                            <i class="fa fa-sort" style="margin-left: 5px; color: #ccc;"></i>
                        @endif
                    </th>
                    <th style="padding: 12px 15px; font-weight: 600; color: #495057; width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidats as $candidat)
                    <tr style="transition: background-color 0.2s;">
                        <td data-label="Nom" style="padding: 10px 15px;">
                            <a href="{{ url('candidats/show/'.$candidat->id_candidat) }}" style="color: #0275d8; font-weight: 500; text-decoration: none;">
                                {{ $candidat->nom_condidat }}
                            </a>
                        </td>
                        <td data-label="Prénom" style="padding: 10px 15px;">{{ $candidat->prenom_condidat }}</td>
                        <td data-label="Fonction" style="padding: 10px 15px;">
                            <span class="badge" style="background-color: #e9ecef; color: #495057; font-weight: 500;">
                                {{ $candidat->fonction_candidat }}
                            </span>
                        </td>
                        <td data-label="Enregistrement" style="padding: 10px 15px; color: #6c757d; font-size: 0.9em;">
                            {{ $candidat->created_at?->format('d/m/Y') ?? 'N/A' }}
                        </td>
                        <td style="padding: 10px 15px;">
                            <a href="{{ url('candidats/show/'.$candidat->id_candidat) }}" class="btn btn-sm btn-outline-info" style="border-radius: 50%; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 40px 15px;">
                            <i class="fa fa-search" style="font-size: 48px; color: #ddd; display: block; margin-bottom: 10px;"></i>
                            <span class="text-muted">Aucun candidat trouvé.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($candidats->hasPages())
    <div class="mt-3">
        {{ $candidats->links() }}
    </div>
    @endif
</div>
