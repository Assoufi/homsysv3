@extends('layouts.front2')

@section('titre')
    Connexion | HOMSYS
@stop

@section('content')
<div class="homsys-main-content">
    <div class="homsys-main-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <img src="{{ URL::asset('img/logo.png') }}" alt="HOMSYS" height="50" class="mb-3">
                                <h4 class="font-weight-bold">Connexion</h4>
                                <p class="text-muted small">Accédez à votre espace candidat</p>
                            </div>

                            <form method="POST" action="{{ url('/admin/login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="email" class="small font-weight-bold">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="small font-weight-bold">Mot de passe</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                               name="password" placeholder="Votre mot de passe" required>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn homsys-bgcolor text-white btn-block btn-lg mt-3">
                                    <i class="fa fa-sign-in"></i> Se connecter
                                </button>

                                <div class="text-center mt-3">
                                    <a href="{{ url('candidats/create') }}" class="text-muted small">
                                        Pas encore de compte ? <strong>S'inscrire</strong>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
