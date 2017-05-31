@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div style="width: 100%; height: 500px;" id="map">
			
		</div>
	</div>
</div>
@endsection
@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCz1s7xqwM6CsqESjN3hQNwLbiB017vOcI"
    async defer></script>
<script>
	if (navigator.geolocation) { 
	  navigator.geolocation.getCurrentPosition(function(position) {  

	    var point = new google.maps.LatLng(position.coords.latitude, 
	                                       position.coords.longitude);

	    // Initialize the Google Maps API v3
	    var map = new google.maps.Map(document.getElementById('map'), {
	       zoom: 15,
	      center: point,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    });

	    // Place a marker
	    new google.maps.Marker({
	      position: point,
	      map: map
	    });
	  }); 
	} 
	else {
	  alert('W3C Geolocation API is not available');
	} 
</script>
@endpush