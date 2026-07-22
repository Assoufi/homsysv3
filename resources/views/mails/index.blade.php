@extends('template')
@section('titre')
 Mailing
@stop
@section('main')


    <h2>Utilitaires de Mailing</h2>


    <div align="center">
        <div class="col-md-6" >
            <div class="carre" style="background-color: #3498db;" >
                <div class="carretext">
                    <a href="{{url('/admin/index')}}"><div class="car"><br><i class="fa fa-tachometer fa-2x"></i><br>Tableau<br>de bord</div></a>
                </div>
            </div>
            <br>
        </div>
        <div class="col-md-6">
            <div class="carre" style="background-color: #1abc9c" align="center">
                <div class="carretext" align="center">
                    <a href="{{url('/mails/show')}}"><div class="car" align="center"><br><i class="fa fa-users fa-2x"></i><br>Gestion des<br>candidats</div></a>
                </div>
            </div>
            <br>
        </div>
        <div class="col-md-6">
            <div class="carre" style="background-color: #34495e">
                <div class="carretext">
                    <div class="car"><br><i class="fa fa-envelope fa-2x"></i><br>Mailing</div>
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




@stop

