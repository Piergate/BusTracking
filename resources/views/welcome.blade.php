<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Bus tracking</title>

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Kumar+One" rel="stylesheet">
</head>
<body>
	@include('layouts.navbar')
	<div class="container-fluid" id="app" style="padding-top: 65px;">
	
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
