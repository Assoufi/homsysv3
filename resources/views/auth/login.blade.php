@extends('layouts.front2')

@section('titre')
    Mon Compte
@stop

@section('content')
  <div class="homsys-main-content">
    <div class="homsys-main-section">
      <div class="container">
        <div class="row">
          <form role="form" method="POST" action="{{ url('/admin/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <p>
                    Email <i class="homsys-icon homsys-mail"></i>
                    <input id="email" type="email" class="form-control" name="email"
                          value="{{ old('email') }}" placeholder="Votre Email">
                </p>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <p>
                    Mot de passe <i class="homsys-icon homsys-multimedia"></i>
                    <input id="password" type="password" class="form-control"
                          name="password" placeholder="Votre mot de passe">
                </p>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-btn fa-sign-in"></i> Login
            </button>
            <a href="{{ url('candidats/create') }}" class="btn btn-info btn-lg">
                <i class="fa fa-user-plus"></i> S'inscrire
            </a>
        </form>
      </div>
    </div>
    </div>
  </div>
@endsection
