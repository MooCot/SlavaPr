<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('/assets/css/main.css') }}">

</head>
<body class="background-login">
    <div class="container-login">
        <form id="login-form" class="form" method="post" action="{{ route('login') }}">
            @csrf
            <div class="login-title">
                <img class="login-title__img" src="/assets/images/logo.png" alt="Logo login">
                <span class="login-title__text">
                    MedTask24
                </span>
            </div>
            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                    </div>
                </div>
                <label class="input-group__label-email">Логин (E-mail)</label>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="" required>
            </div>
            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <label class="input-group__label-password">Пароль</label>
                <input id="password-input" type="password" placeholder="" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" minlength="8" required>
                <a href="#" class="input-group__img-visible"></a>
            </div>
        
            <button id="form-button" type="submit" href="" class="form__button">{{ __('Войти') }}</button>
            {{-- <button type="submit" href="" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Get Started') }}</button> --}}
        </form>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/assets/js/main.js"></script>
</html>

