@extends('layouts.front2')

@section('titre')
    Inscription | HOMSYS
@stop

@section('content')
<style>
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
        padding: 25px;
    }
    .btn-submit-blue {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: #ffffff !important;
        font-size: 1.1rem !important;
        font-weight: 700 !important;
        padding: 12px 35px !important;
        border-radius: 5px !important;
        transition: all 0.2s ease-in-out;
        width: 100%;
    }
    .btn-submit-blue:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
        color: #ffffff !important;
    }
</style>

<div class="container" align="left" style="width: 100%; max-width: 550px; margin: 0 auto; padding-top: 20px; padding-bottom: 40px;">
    <div class="spontane-header text-center">
        <h3>Créer un compte candidat</h3>
        <p class="text-muted small" style="margin-top: 5px;">Rejoignez la communauté HOMSYS</p>
    </div>

    <div class="panel panel-custom">
        <div class="panel-heading"><i class="fa fa-user-plus"></i> Vos Identifiants</div>
        <div class="panel-body">
            <form action="{{ url('candidats/create') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="small font-weight-bold">Adresse Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                           required maxlength="60" value="{{ old('email') }}" placeholder="votre@email.com">
                    @error('email')
                        <span class="invalid-feedback text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="small font-weight-bold">Mot de passe <span class="text-danger">*</span></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required minlength="6" maxlength="60" placeholder="Minimum 6 caractères">
                    @error('password')
                        <span class="invalid-feedback text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirm" class="small font-weight-bold">Confirmer le mot de passe <span class="text-danger">*</span></label>
                    <input id="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror"
                           name="password_confirm" required minlength="6" maxlength="60" placeholder="Retapez votre mot de passe">
                    @error('password_confirm')
                        <span class="invalid-feedback text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-top: 25px;">
                    <button type="submit" class="btn btn-submit-blue">
                        <i class="fa fa-user-plus"></i> S'inscrire
                    </button>
                </div>

                <div class="text-center" style="margin-top: 20px;">
                    <a href="{{ url('logins') }}" class="text-muted small">
                        Déjà un compte ? <strong style="color: #007bff;">Se connecter</strong>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

