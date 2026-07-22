@extends('layouts.front2')
@section('titre')
    {!! $meta['title'] !!}
@stop
@section('content')
    <div class="homsys-main-content">
        <div class="homsys-main-section">
          <div class="container">
            <div class="row">
              <div class="homsys-column-8">
                <div class="homsys-typo-wrap">
                  <div class="homsys-typo-wrap">
                    <figure class="homsys-jobdetail-list">
                      <figcaption>
                        <form action="{{ url('candidats/create') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username" class="required">Login</label>
                                <input type="text" name="username" id="username" class="form-control" required maxlength="60" value="{{ old('username') }}">
                                @if ($errors->has('username')) <br><div class="alert alert-danger">{{ $errors->first('username') }}</div> @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="required">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required maxlength="60" value="{{ old('email') }}">
                                @if ($errors->has('email')) <br><div class="alert alert-danger">{{ $errors->first('email') }}</div> @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="required">Mot de passe</label>
                                <input id="password" type="password" class="form-control" name="password" required minlength="6" maxlength="60">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                                <label for="password_confirm" class="required">Confirmer mot de passe</label>
                                <input id="password_confirm" type="password" class="form-control" name="password_confirm" required minlength="6" maxlength="60">
                                @if ($errors->has('password_confirm'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password_confirm') }}</strong>
                                </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="homsys-sendmessage-btn">Suivant</button>
                            </div>
                        </form>
                      </figcaption>
                    </figure>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @stop