@extends('layouts.master')
@section('content')
<div class="container" >
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
			zoom: 5,
			center: {
				lat: 30.8688,
                lng: 31.2195
			}
		});
		directionsDisplay.setMap(map);
		calculateAndDisplayRoute(directionsService, directionsDisplay);
	}
	/**
	 *   displayRoute
	 */
	 function calculateAndDisplayRoute(directionsService, directionsDisplay) {
	 	@foreach($tripUser as $usertrip)
	 	@if($loop->first)
	 	var start =  new google.maps.LatLng({{ $usertrip->latitude }}, {{ $usertrip->longitude }});
	 	@endif
	 	@if($loop->last)
	 	var end =  new google.maps.LatLng({{ $usertrip->latitude }}, {{ $usertrip->longitude }});
	 	@endif
	 	@endforeach
	 	var waypts = [];
	 	waypts.push(
	 		@foreach($tripUser as $usertrip)
	 		@if(!$loop->first)
	 		@if(!$loop->last)
	 		{location: new google.maps.LatLng( {{ $usertrip->latitude }}, {{ $usertrip->longitude }} ) },
	 		@endif
	 		@endif
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

/**
 *   end displayRoute
 */

</script>
@endpush
@push('googleScript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script async defer src="https://maps.google.com/maps/api/js?key=AIzaSyCz1s7xqwM6CsqESjN3hQNwLbiB017vOcI&callback=initMap"></script>

@endpush