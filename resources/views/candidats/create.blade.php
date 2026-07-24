@extends('layouts.front2')

@section('titre')
    Inscription | HOMSYS
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
                                <h4 class="font-weight-bold">Créer un compte</h4>
                                <p class="text-muted small">Rejoignez la communauté HOMSYS</p>
                            </div>

                            <form action="{{ url('candidats/create') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="email" class="small font-weight-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                           required maxlength="60" value="{{ old('email') }}" placeholder="votre@email.com">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="small font-weight-bold">Mot de passe <span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" required minlength="6" maxlength="60" placeholder="Minimum 6 caractères">
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirm" class="small font-weight-bold">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                    <input id="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror"
                                           name="password_confirm" required minlength="6" maxlength="60" placeholder="Retapez votre mot de passe">
                                    @error('password_confirm')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn homsys-bgcolor text-white btn-block btn-lg mt-3">
                                    <i class="fa fa-user-plus"></i> S'inscrire
                                </button>

                                <div class="text-center mt-3">
                                    <a href="{{ url('logins') }}" class="text-muted small">
                                        Déjà un compte ? <strong>Se connecter</strong>
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
@stop
