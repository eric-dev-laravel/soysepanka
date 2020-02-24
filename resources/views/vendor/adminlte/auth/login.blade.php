<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Soysepanka</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="bg d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="card-container col-10 col-xs-10 col-sm-10 col-md-10 col-lg-5">
                <div class="card login-card animated zoomIn card-3">
                    <a href="{{ route('init') }}">
                        <div class="card-header card-header-log"></div>
                    </a>
                    <div class="card-body card-body-login">
                        <!--<form method="POST" action="moodle/login/index.php" aria-label="{{ __('Login') }}">-->
                        <!--<form method="POST" action="/moodle/login/index.php" aria-label="{{ __('Login') }}">-->
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf

                            <div class="form-group row">
                                <!--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Correo:') }}</label>-->

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Nombre de usuario" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-white">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <!--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña:') }}</label>-->

                                <div class="col-md-12">
                                    <input id="password" placeholder="Contraseña" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-white">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <div class="d-flex justify-content-end mt-2">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Recordar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row my-2">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success font-weight-bold card-1">
                                        {{ __('Iniciar ') }}<i class="fas fa-sign-in-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row my-2">
                                <div class="col text-center">
                                    <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</html>
