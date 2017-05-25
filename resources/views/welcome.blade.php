<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bus tracking</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        
    </head>
    <body>
        @include('layouts.navbar')
        <div class="container-fluid" id="app">
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
