@extends('layouts.front2')
@section('titre')
   Candidat HOMSYS :: {!! $candidat->nom_condidat !!} {!! $candidat->prenom_condidat !!}
@stop
@section('content')
    <h2>Bienvenue {{$candidat->civilite_candidat}}.{{$candidat->nom_condidat}}</h2>
    <div align="center">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="carre" style="background-color: #3498db;">
                            <div class="carretext">
                                <a href="{{url('/offres/')}}">
                                    <div class="car"><br><i class="fa fa-briefcase fa-2x"></i><br>Offres</div>
                                </a>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="carre" style="background-color: #1abc9c" align="center">
                            <div class="carretext" align="center">
                                <a href="{{url('/candidats/modify',['id'=>$candidat->id_candidat])}}">
                                    <div class="car" align="center"><br><i class="fa fa-info-circle fa-2x"></i><br>Mon compte</div>
                                </a>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="carre" style="background-color: #FFDAB9">
                            <div class="carretext">
                                <a href="{{url('/candidats/cv/')}}">
                                    <div class="car"><br><i class="fa fa-file-text-o fa-2x"></i><br> Mon CV</div>
                                </a>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <div class="carre" style="background-color: #e74c3c">
                            <div class="carretext">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="car"><br><i class="fa fa-sign-out fa-2x"></i><br>Déconnexion</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <h3><i class="fa fa-clock-o" aria-hidden="true"></i>
                    Dernièrs offres</h3>
                <ul class="list-group">
                   @if( empty($offres_news ))
                        <li class="list-group-item">Aucune offre</li>
                    @else
                    @foreach( $offres_news as $offre)
                    <li class="list-group-item">
                        <div class="homsys-table-layer">
                            <div class="homsys-table-row">
                                <div class="homsys-featured-listing-text">
                                    <h2><a href="{{url('offres',['id'=>$offre->id_offre])}}">{{$offre->titre_offre}}</a></h2>
                                    <i class="homsys-icon homsys-heart"></i>
                                    <div class="homsys-featured-listing-options">
                                      <ul>
                                        <li><i class="fa fa-file-text-o" aria-hidden="true"></i> {{$offre->type_offre}} </li>
                                        <li><i class="homsys-icon homsys-maps-and-flags"></i> {{$offre->ville_offre}} </li>
                                        <li><i class="homsys-icon homsys-calendar"></i> {{$offre->duree}}</li>
                                      </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

@stop
