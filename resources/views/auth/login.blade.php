@extends('layouts.front2')

@section('titre')
    Connexion | HOMSYS
@stop

@section('content')
<style>
    .auth-page {
        width: 100%;
        max-width: 500px;
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
        font-size: 1.25rem;
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
    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 6px;
        display: block;
    }
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        box-shadow: none;
        height: auto;
        padding: 10px 12px;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.12);
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-size: 1rem !important;
        font-weight: 700 !important;
        padding: 11px 28px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
        display: inline-block;
        text-decoration: none !important;
        width: 100%;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
</style>

<div class="auth-page">
    <div class="spontane-header">
        <h3><i class="fa fa-sign-in"></i> Connexion</h3>
        <p>Accédez à votre espace personnel</p>
    </div>

    @if (session('login'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-triangle"></i> {{ session('login') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-triangle"></i> {{ $errors->first('login') ?? 'Erreur de connexion' }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-lock"></i> Identifiants</div>
        <div class="panel-body">
            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
                    @error('email')
                        <span class="invalid-feedback d-block small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" placeholder="Votre mot de passe" required>
                    @error('password')
                        <span class="invalid-feedback d-block small">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-submit-blue">
                    <i class="fa fa-sign-in"></i> Se connecter
                </button>

                <div class="text-center mt-3">
                    <a href="{{ url('password/forgot') }}" class="text-muted small">
                        <i class="fa fa-question-circle"></i> Mot de passe oublié ?
                    </a>
                </div>

                <div class="text-center mt-2">
                    <a href="{{ url('candidats/create') }}" class="text-muted small">
                        Pas encore de compte ? <strong>S'inscrire</strong>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
