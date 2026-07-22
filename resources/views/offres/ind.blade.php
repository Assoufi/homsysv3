@extends('layouts.front2')
@section('titre')
    Liste des offres
@stop
@section('content')
<section ng-app="app" ng-controller="MainCtrl">
    <h3>Liste des offres | <a href=""  align="right"><i class="fa fa-search" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"></i></a></h3>
    <!--<div class="collapse" id="collapseExample">-->
        <div class="well">
            <div class="input-group">
                <input type="text" name="search" required class="form-control" placeholder="Chercher une offre" ng-model="search">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-secondary btn-warning">Recherche</button>
                </span>
            </div>
        </div>
   <!-- </div>-->
    <table class="table">


        <thead>
        <tr>

            <th>
                <a href="#" ng-click="orderByField='id_offre'; reverseSort = !reverseSort">
                    # <span ng-show="orderByField == 'id_offre'"><span ng-show="!reverseSort"><i class="fa fa-sort-asc" aria-hidden="true"></i>
</span><span ng-show="reverseSort"><i class="fa fa-sort-desc" aria-hidden="true"></i></span></span>
                </a>
            </th>
            <th>
                <a href="#" ng-click="orderByField='titre_offre'; reverseSort = !reverseSort">
                    Titre  <span ng-show="orderByField == 'titre_offre'"><span ng-show="!reverseSort"><i class="fa fa-sort-asc" aria-hidden="true"></i>
</span><span ng-show="reverseSort"><i class="fa fa-sort-desc" aria-hidden="true"></i>
</span></span>
                </a>
            </th>
            <th>
                <a href="#" ng-click="orderByField='created_at'; reverseSort = !reverseSort">
                   Date publication <span ng-show="orderByField == 'created_at'"><span ng-show="!reverseSort"><i class="fa fa-sort-asc" aria-hidden="true"></i>
</span><span ng-show="reverseSort"><i class="fa fa-sort-desc" aria-hidden="true"></i>
</span></span>
                </a>
            </th>
            <th>
                <a href="#" ng-click="orderByField='updated_at'; reverseSort = !reverseSort">
                    Dernière modification <span ng-show="orderByField == 'updated_at'"><span ng-show="!reverseSort"><i class="fa fa-sort-asc" aria-hidden="true"></i>
</span><span ng-show="reverseSort"><i class="fa fa-sort-desc" aria-hidden="true"></i>
</span></span>
                </a>
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="offre in data.offres|orderBy:orderByField:reverseSort | filter:search">
            <td>@{{offre.id_offre}}</td>
            <td>@{{offre.titre_offre}}</td>
            <td>@{{offre.created_at}}</td>
            <td>@{{offre.updated_at}}</td>

            <td><a href="offres/@{{offre.id_offre}}"><i class="fa fa-eye" aria-hidden="true"></i>
                </a></td>
        </tr>
        </tbody>
    </table>
</section>
<script>
    var app = angular.module('app', []);

    app.controller('MainCtrl', function($scope) {

        $scope.orderByField = 'idoffre';
        $scope.reverseSort = false;
        $scope.searchFish   = '';

        $scope.data = {
            offres: [
                @foreach($offres as $offre){
                id_offre: {{$offre->id_offre}},
                titre_offre: '{{$offre->titre_offre}}',
                    created_at: '{{$offre->created_at}}',
                    updated_at: '{{$offre->updated_at}}',



            },
            @endforeach]
        };

    });
</script>

@stop
