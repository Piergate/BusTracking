<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kumar+One" rel="stylesheet">
</head>

<body>
    <div id="app" style="padding-top: 65px;">
        @include('layouts.navbar') @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('layouts.notifications') 
    @stack('js')
    @stack('googleScript')
</body>

</html>
