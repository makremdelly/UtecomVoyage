@extends('layouts.login')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
            <img src="../../img/utecom.png" alt="logo" width="100" class="shadow-light rounded-circle">

            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Réinitialiser le mot de passe') }}</h4>
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email">{{ __('Adresse e-mail') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group">
                            <label for="email">{{ __('Nouveau mot de passe') }}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group">
                            <label for="email">{{ __('Confirmez nouveau mot de passe') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>


                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            {{ __('Réinitialiser le mot de passe') }}
                            </button>
                        </div>
                    
                    </form>
                </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; UTECOM 2020
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection