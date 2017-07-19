@extends('layouts.master')
@section('content')
<div class="container" onload="initMap()">
	<div class="row">
		<div class="text-center h2">Name: {{ $line->name}}</div>
	</div>
	<div class="row">
		<div id="map" style="height:400px; " class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2"></div>
		<br>
	</div>
</div>
@endsection
@push('js')
<script>
	function initMap() {
		var directionsService = new google.maps.DirectionsService;
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 6,
			center: {lat: 30.8688, lng: 31.2195}
		});
		directionsDisplay.setMap(map);
		calculateAndDisplayRoute(directionsService, directionsDisplay);
	}
	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
		var start =  new google.maps.LatLng({{ $line->latFromRoute }}, {{ $line->lngFromRoute }});
		var end =  new google.maps.LatLng({{ $line->latToRoute }}, {{ $line->lngToRoute }});
		var waypts = [];
		waypts.push(
			@foreach($line->waypoints as $waypoint)
			{location: new google.maps.LatLng({{ $waypoint->latitude }}, {{ $waypoint->longitude }}), stopover: false},
			@endforeach
			);
		directionsService.route({
			origin: {location: start},
			destination: {location: end},
			waypoints: waypts,
			optimizeWaypoints: true,
			travelMode: 'DRIVING'
		}, function(response, status) {
			if (status === 'OK') {
				directionsDisplay.setDirections(response);
			} else {
				window.alert('Directions request failed due to ' + status);
			}
		});
	}
</script>
@endpush
@push('googleScript')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCz1s7xqwM6CsqESjN3hQNwLbiB017vOcI&callback=initMap" async defer></script>
@endpush