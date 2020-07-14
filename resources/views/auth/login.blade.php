@extends('layouts.login')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="../img/utecom.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Se connecter') }}</h4>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('Adresse e-mail') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">{{ __('Mot de passe') }}</label>
                                <div class="float-right">
                                    <a href="{{route('password.forgot')}}" class="text-small">
                                    Mot de passe oublié ?
                                    </a>
                                </div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autofocus>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Se souvenir') }}
                                </label>
                            </div>
                        </div>

                        <!-- start-Forgot -->
                        <!-- <div class="form-group">
                            <label class="label-agree-term"> -->
                        <!-- <a data-toggle="modal" data-target=".bd-example-modal-lg">Forgot password</a> -->
                        <!-- <div class="breadcrumb-item active"> <a class="breadcrumb-item active" data-toggle="modal" data-target=".bd-example-modal-lg"><b>Forgot password</b></a></div> -->
                        <!-- <a class="reset_pass" href="{{route('password.forgot')}}" data-toggle="modal" data-target=".bd-example-modal-lg">Lost your password?</a> -->
                        <!-- <a class="reset_pass" href="{{route('password.forgot')}}">Lost your password?</a> -->
                        <!-- </label>
                        </div> -->
                        <!-- end-Forgot -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{ __('Connexion') }}
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-4 mb-3">
                        <div class="text-job text-muted">Se connecter avec Google</div>
                    </div>
                    <div class="col text-center">
                        <a href="{{ url('auth/google') }}" class="btn btn-icon icon-left btn-outline-danger"><i class="fab fa-google"></i>Google</a>
                    </div>
                </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; UTECOM 2020
            </div>
        </div>
    </div>
</div>








<!-- start-modal -->
<!-- <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Forgot password</h5>
                <a data-dismiss="modal" class=" btn btn-icon btn-light" aria-label="Close"><i class="fas fa-times"></i></a>
            </div>
            <div class="card-body">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif


                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger btn-lg btn-block">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

<!-- end-modal -->


@endsection