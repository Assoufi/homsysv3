@extends('layouts.front2')

@section('titre')
    Liste des offres
@stop

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="d-flex align-items-center">
                <i class="fa fa-briefcase mr-2"></i> Liste des offres
                <a href="{{ route('offres.create') }}" class="btn btn-primary ml-auto" title="Nouvelle offre" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-plus" aria-hidden="true"></i> Nouvelle offre
                </a>
            </h2>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Ville</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offres as $offre)
                <tr>
                    <td>{{ $offre->id_offre }}</td>
                    <td>{{ $offre->titre_offre }}</td>
                    <td>{{ $offre->type_offre }}</td>
                    <td>{{ $offre->ville_offre }}</td>
                    <td>{!! $offre->exp_offre == 1 ? '<span class="badge badge-danger">Clôturée</span>' : '<span class="badge badge-success">Active</span>' !!}</td>
                    <td>{{ $offre->updated_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ url('offres/'.$offre->id_offre.'-'.strtolower(str_replace(str_split("'\\/:*?|+%."), '_', $offre->titre_offre))) }}" class="btn btn-sm btn-info" title="Voir"><i class="fa fa-eye"></i></a>
                        <a href="{{ url('offres/'.$offre->id_offre) }}" class="btn btn-sm btn-warning" title="Modifier"><i class="fa fa-edit"></i></a>
                        <form action="{{ url('offres/'.$offre->id_offre) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Supprimer cette offre ?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($offres->total() > 0)
        <div class="d-flex justify-content-center mt-4">
            {{ $offres->links() }}
        </div>
        @endif
    </div>
</div>
@stop
