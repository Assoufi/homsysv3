<?php

namespace App\Livewire;

use App\Models\Offre;
use Livewire\Component;
use Livewire\WithPagination;

class JobSearch extends Component
{
    use WithPagination;

    public string $keyword = '';
    public string $ville = '';
    public string $type = '';
    public string $sortBy = 'updated_at';
    public string $sortDir = 'desc';

    protected $paginationTheme = 'bootstrap';

    public function mount(?string $initialKeyword = null, ?string $initialVille = null, ?string $initialType = null): void
    {
        $this->keyword = $initialKeyword ?? '';
        $this->ville = $initialVille ?? '';
        $this->type = $initialType ?? '';
    }

    public function updatingKeyword(): void
    {
        $this->resetPage();
    }

    public function updatingVille(): void
    {
        $this->resetPage();
    }

    public function updatingType(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDir = 'desc';
        }
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->keyword = '';
        $this->ville = '';
        $this->type = '';
        $this->sortBy = 'updated_at';
        $this->sortDir = 'desc';
        $this->resetPage();
    }

    public function getTypeCounts(): array
    {
        return Offre::where('exp_offre', 0)
            ->selectRaw('type_offre, COUNT(*) as count')
            ->groupBy('type_offre')
            ->pluck('count', 'type_offre')
            ->toArray();
    }

    public function getVilles(): \Illuminate\Support\Collection
    {
        return Offre::where('exp_offre', 0)
            ->distinct()
            ->pluck('ville_offre')
            ->filter()
            ->sort()
            ->values();
    }

    public function getActiveFilterCount(): int
    {
        $count = 0;
        if (!empty($this->keyword)) $count++;
        if (!empty($this->ville)) $count++;
        if (!empty($this->type)) $count++;
        return $count;
    }

    public function render()
    {
        $query = Offre::where('exp_offre', 0);

        if (!empty($this->keyword)) {
            $kw = $this->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('titre_offre', 'like', '%' . $kw . '%')
                    ->orWhere('description_offre', 'like', '%' . $kw . '%')
                    ->orWhere('poste', 'like', '%' . $kw . '%')
                    ->orWhere('profil', 'like', '%' . $kw . '%')
                    ->orWhere('competences', 'like', '%' . $kw . '%');
            });
        }

        if (!empty($this->ville)) {
            $query->where('ville_offre', 'like', '%' . $this->ville . '%');
        }

        if (!empty($this->type)) {
            $query->where('type_offre', $this->type);
        }

        $allowed = ['updated_at', 'created_at', 'titre_offre', 'ville_offre', 'type_offre'];
        $sortField = in_array($this->sortBy, $allowed) ? $this->sortBy : 'updated_at';
        $sortDirection = $this->sortDir === 'asc' ? 'asc' : 'desc';

        $offres = $query->orderBy($sortField, $sortDirection)->paginate(12);

        return view('livewire.job-search', [
            'offres' => $offres,
            'typeCounts' => $this->getTypeCounts(),
            'villes' => $this->getVilles(),
            'activeFilterCount' => $this->getActiveFilterCount(),
        ]);
    }
}
