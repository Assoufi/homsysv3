@extends('layouts.front2')

@section('titre')
    {!! $meta['title'] !!}
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
    .input-group-addon {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-right: none;
        border-radius: 5px 0 0 5px;
        padding: 10px 12px;
        color: #007bff;
    }
    .input-group-addon + .form-control {
        border-left: none;
        border-radius: 0 5px 5px 0;
    }
</style>

<div class="auth-page">
    <div class="spontane-header">
        <h3><i class="fa fa-key"></i> Nouveau mot de passe</h3>
        <p>Choisissez un nouveau mot de passe pour votre compte</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-lock"></i> Réinitialisation</div>
        <div class="panel-body">
            <form action="{{ url('password/reset') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ request('email') }}" readonly required>
                    @error('email')
                        <span class="invalid-feedback d-block small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Minimum 6 caractères" required minlength="6">
                    @error('password')
                        <span class="invalid-feedback d-block small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control"
                           placeholder="Retapez le mot de passe" required minlength="6">
                </div>

                <button type="submit" class="btn btn-submit-blue">
                    <i class="fa fa-check"></i> Réinitialiser mon mot de passe
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ url('logins') }}" class="text-muted small">
                    <i class="fa fa-arrow-left"></i> Retour à la connexion
                </a>
            </div>
        </div>
    </div>
</div>
@stop