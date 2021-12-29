<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link type="image/x-icon" href="{{ asset('favicon.ico') }}" rel="shortcut icon">
        <link type="Image/x-icon" href="{{ asset('favicon.ico') }}" rel="icon">
        <title>{{ config('app.name', 'med') }}</title>
        <link rel="stylesheet" href="{{ mix('/assets/css/main.css') }}">
        <!-- Favicon -->
    </head>
    <body class="background-login {{ $class ?? '' }}">
        @auth()
            <div class="container-content">
                <div class="aside-content">
                    <div class="aside-content__logo">
                        <img class="aside-content__img" src="/assets/images/logo.png" alt="Logo login">
                        <span class="aside-content__text">
                            MedTask24
                        </span>
                    </div>
                    <div class="aside-content__sidebar">
                        @include('layouts.navbars.sidebar')
                        <div class="aside-content__logout">
                            <a class="aside-content__button" href="{{ route('admin.logout') }}">Выход</a>   
                        </div>                                             
                    </div> 
                                     
                </div>            
                <div class="content">
                    @yield('content')
                </div>
            </div>
            {{-- <a href="{{ route('admin.logout') }}">logout</a> --}}
        @endauth
        @stack('js')
    </body>
{{-- <script src="{{mix("/assets/js/jquery.js")}}"></script> --}}
{{-- <script src="{{mix("/assets/js/maskedinput.js")}}"></script> --}}
<script src="{{mix("/assets/js/main.js")}}"></script>
</html>