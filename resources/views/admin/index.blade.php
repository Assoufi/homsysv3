@extends('layouts.front2')
@section('titre')
   HOMSYS :: {{$admin->username}}
@stop

@section('content')

    <h2>Bienvenue {{$admin->username}}</h2>
    @include('graphs.visites_jour')
    @include('graphs.visites_offres')
    <div align="center">
        <div class="col-md-6" >
            <div class="carre" style="background-color: #3498db;" >
                <div class="carretext">
                    <a href="{{url('/offres/')}}"><div class="car"><br><i class="fa fa-briefcase fa-2x"></i> Offres</div></a>
                </div>
            </div>
            <br>
        </div>
        <div class="col-md-6">
            <div class="carre" style="background-color: #1abc9c" align="center">
                <div class="carretext" align="center">
                    <a href="{{url('/candidats/')}}"><div class="car" align="center"><br><i class="fa fa-users fa-2x"></i> Gestion des candidats</div></a>
                </div>
            </div>
            <br>
        </div>
        <div class="col-md-6">
            <div class="carre" style="background-color: #e74c3c">
                <div class="carretext">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="car"><br><i class="fa fa-sign-out fa-2x"></i> Déconnexion</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="space_brief">
    <div class="col-md-6"></div>
    <div class="col-md-12"><br></div>
    <div class="col-md-12"><br></div>
    <div class="col-md-12"><br></div>
    <div class="col-md-12"><br></div>
@stop





