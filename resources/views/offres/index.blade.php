@extends('layouts.front2')

@section('titre')
    Liste des offres
@stop

@section('content')
<style>
    .offres-page {
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
    .panel-custom .panel-body {
        padding: 20px;
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
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
</style>

<div class="offres-page">
    <div class="spontane-header">
        <h3><i class="fa fa-briefcase"></i> Liste des offres</h3>
        <p>Gérez l'ensemble des offres d'emploi</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading">
            <i class="fa fa-list"></i> Offres
            <a href="{{ route('offres.create') }}" class="btn btn-submit-blue pull-right" style="padding: 5px 14px !important; font-size: 0.85rem !important;">
                <i class="fa fa-plus"></i> Nouvelle offre
            </a>
        </div>
        <div class="panel-body">
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
    </div>
</div>
@stop
