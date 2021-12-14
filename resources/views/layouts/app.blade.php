<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'med') }}</title>
        <!-- Favicon -->
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            @include('layouts.navbars.sidebar')
            <div class="content">
                @yield('content')
            </div>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
            </form>
        @endauth
        @stack('js')
    </body>
</html>
