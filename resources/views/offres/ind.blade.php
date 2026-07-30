@extends('layouts.front2')
@section('titre')
    Liste des offres
@stop
@section('content')
<style>
    .ind-page {
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
    .panel-custom .panel-body table { margin-bottom: 0; }
</style>

<div class="ind-page">
    <div class="spontane-header">
        <h3><i class="fa fa-briefcase"></i> Liste des offres</h3>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-list"></i> Offres</div>
        <div class="panel-body">
            <div class="input-group mb-3">
                <input type="text" ng-model="search" class="form-control" placeholder="Chercher une offre">
                <div class="input-group-append">
                    <span class="btn btn-warning"><i class="fa fa-search"></i> Recherche</span>
                </div>
            </div>

            <div ng-app="app" ng-controller="MainCtrl">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th><a href="#" ng-click="orderByField='id_offre'; reverseSort = !reverseSort"># <span ng-show="orderByField == 'id_offre'"><span ng-show="!reverseSort"><i class="fa fa-sort-asc"></i></span><span ng-show="reverseSort"><i class="fa fa-sort-desc"></i></span></span></a></th>
                            <th><a href="#" ng-click="orderByField='titre_offre'; reverseSort = !reverseSort">Titre <span ng-show="orderByField == 'titre_offre'"><span ng-show="!reverseSort"><i class="fa fa-sort-asc"></i></span><span ng-show="reverseSort"><i class="fa fa-sort-desc"></i></span></span></a></th>
                            <th><a href="#" ng-click="orderByField='created_at'; reverseSort = !reverseSort">Date publication <span ng-show="orderByField == 'created_at'"><span ng-show="!reverseSort"><i class="fa fa-sort-asc"></i></span><span ng-show="reverseSort"><i class="fa fa-sort-desc"></i></span></span></a></th>
                            <th><a href="#" ng-click="orderByField='updated_at'; reverseSort = !reverseSort">Dernière modification <span ng-show="orderByField == 'updated_at'"><span ng-show="!reverseSort"><i class="fa fa-sort-asc"></i></span><span ng-show="reverseSort"><i class="fa fa-sort-desc"></i></span></span></a></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="offre in data.offres|orderBy:orderByField:reverseSort | filter:search">
                            <td>@{{offre.id_offre}}</td>
                            <td>@{{offre.titre_offre}}</td>
                            <td>@{{offre.created_at}}</td>
                            <td>@{{offre.updated_at}}</td>
                            <td><a href="offres/@{{offre.id_offre}}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var app = angular.module('app', []);

    app.controller('MainCtrl', function($scope) {
        $scope.orderByField = 'id_offre';
        $scope.reverseSort = false;

        $scope.data = {
            offres: [
                @foreach($offres as $offre){
                    id_offre: {{$offre->id_offre}},
                    titre_offre: '{{$offre->titre_offre}}',
                    created_at: '{{$offre->created_at}}',
                    updated_at: '{{$offre->updated_at}}',
                },
                @endforeach
            ]
        };
    });
</script>
@stop