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

    public function render()
    {
        $offres = Offre::query()
            ->where(function($query) {
                $query->where('titre_offre', 'like', '%' . $this->search . '%')
                    ->orWhere('ville_offre', 'like', '%' . $this->search . '%')
                    ->orWhere('type_offre', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->orderByField, $this->reverseSort ? 'desc' : 'asc')
            ->get(); // Using get() to match original non-paginated behavior for now, but Livewire supports pagination easily

        return view('livewire.search-offres', [
            'offres' => $offres,
        ]);
    }
};
?>

<div>
    <div class="well">
        <div class="input-group">
            <input type="text" wire:model.live="search" class="form-control" placeholder="Chercher une offre">
            <span class="input-group-btn"></span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-stack">
            <thead>
            <tr>
                <th wire:click="sortBy('id_offre')" style="cursor: pointer;">
                    ID 
                    @if($orderByField == 'id_offre')
                        <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                    @endif
                </th>
                <th wire:click="sortBy('titre_offre')" style="cursor: pointer;">
                    Titre
                    @if($orderByField == 'titre_offre')
                        <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                    @endif
                </th>
                <th wire:click="sortBy('type_offre')" style="cursor: pointer;">
                    Type
                    @if($orderByField == 'type_offre')
                        <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                    @endif
                </th>
                <th wire:click="sortBy('ville_offre')" style="cursor: pointer;">
                    Ville
                    @if($orderByField == 'ville_offre')
                        <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                    @endif
                </th>
                <th wire:click="sortBy('exp_offre')" style="cursor: pointer;">
                    Etat
                    @if($orderByField == 'exp_offre')
                        <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                    @endif
                </th>
                <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                    Publication
                    @if($orderByField == 'created_at')
                        <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                    @endif
                </th>
                <th wire:click="sortBy('updated_at')" style="cursor: pointer;">
                    Modification
                    @if($orderByField == 'updated_at')
                        <i class="fa fa-sort-{{ $reverseSort ? 'desc' : 'asc' }}"></i>
                    @endif
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($offres as $offre)
                <tr>
                    <td data-label="ID">{{ $offre->id_offre }}</td>
                    <td data-label="Titre">{{ $offre->titre_offre }}</td>
                    <td data-label="Type">{{ $offre->type_offre }}</td>
                    <td data-label="Ville">{{ $offre->ville_offre }}</td>
                    <td data-label="Etat">
                        <span class="badge {{ $offre->exp_offre == '0' ? 'badge-success' : 'badge-danger' }}">
                            {{ $offre->exp_offre == '0' ? 'En cours' : 'Expirée' }}
                        </span>
                    </td>
                    <td data-label="Publication">{{ $offre->created_at?->format('d/m/Y') ?? 'N/A' }}</td>
                    <td data-label="Modification">{{ $offre->updated_at?->format('d/m/Y') ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ url('offres/'.$offre->id_offre) }}" class="btn btn-sm btn-outline-info">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center p-4">Aucune offre trouvée.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
