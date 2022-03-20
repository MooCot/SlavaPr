<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="image/x-icon" href="{{ asset('favicon.ico') }}" rel="shortcut icon">
    <link type="Image/x-icon" href="{{ asset('favicon.ico') }}" rel="icon">
    <title>Вход в MH Task Planer</title>
    <link rel="stylesheet" href="{{ mix('/assets/css/main.css') }}">
</head>
<body class="background-login">
    <div class="container-login">
        <form id="login-form" class="form" method="post" action="{{ route('login') }}">
            @csrf
            <div class="login-title">
                <img class="login-title__img" src="/assets/images/logo.png" alt="Logo login">
            </div>
            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                    </div>
                </div>
                <label class="input-group__label-email">Логин (E-mail)</label>
                <input type="email" name="email" class="input-group__input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="">
                @if ($errors->has('email'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <label class="input-group__label-password">Пароль</label>
                <input id="password-input" type="password" placeholder="" name="password" class="input-group__input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" minlength="1" required>
                @if ($errors->has('password'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                @endif
                <button type="button" id="input-group__button-visible" class="input-group__img-visible">
                </button>                
            </div>
        
            <button id="form-button" type="submit" href="" class="form__button">{{ __('Войти') }}</button>
            {{-- <button type="submit" href="" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Get Started') }}</button> --}}
        </form>
    </div>
</body>
<script src="{{mix("/assets/js/jquery.js")}}"></script>
<script src="{{mix("/assets/js/main.js")}}"></script>
</html>

