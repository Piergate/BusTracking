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
	var locations = [
	@foreach($tripUser as $user)
	['', {{ $user->latitude }}, {{ $user->longitude }}, 4],
	@if ($loop->last) 
	['', {{ $user->latitude }}, {{ $user->longitude }}, 4]
	@endif
	@endforeach
	];
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 30.0443100, lng: 31.235717300000400},
			zoom: 9,
		});
		getPosition();
	}
function getPosition() {
	var marker, i;
	for (i = 0; i < locations.length; i++) {  
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
		});
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
		}) (marker, i));
	}
}
</script>
@endpush
@push('googleScript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCz1s7xqwM6CsqESjN3hQNwLbiB017vOcI&callback=initMap" async defer></script>

@endpush