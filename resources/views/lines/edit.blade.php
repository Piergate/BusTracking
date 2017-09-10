@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-5 col-sm-5">
			<form action="{{ url('/lines/'.$line->id) }}" method="POST" role="form" class="form-horizontal">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<legend><i class="fa fa-edit"></i> Edit Line</legend>
				<div class="form-group">
					<label for="name">name</label>
					<input type="text" class="form-control" id="name" name="name" value="{{ $line->name }}" required>
				</div>
				<div class="form-group">
					<label for="from route">from route</label>
					<input type="text" class="form-control" id="addressFrom" name="addressFrom" value="{{ $line->addressFrom }}" required>
					<input type="hidden" name="latFromRoute" id="latFromRoute" value="{{ $line->latFromRoute }}">
					<input type="hidden" name="lngFromRoute" id="lngFromRoute" value="{{ $line->lngFromRoute }}">
				</div>
				<div class="form-group">
					<label for="to route">to route</label>
					<input type="text" class="form-control" id="addressTo" name="addressTo" value="{{ $line->addressTo }}" required>
					<input type="hidden" name="latToRoute" id="latToRoute" value="{{ $line->latToRoute }}">
					<input type="hidden" name="lngToRoute" id="lngToRoute" value="{{ $line->lngToRoute }}">
				</div>
				<div class="form-group">
					<label for="">notes</label>
					<textarea class="form-control" name="notes">{{ $line->notes }}</textarea>
				</div>
				<div class="col-sm-5 col-md-5">
					<!-- <input type="button" id="addStation" onclick="addStationinput()" value="Add Station"> -->
				</div>
				<span id="station"></span>
				<button type="submit" class="btn btn-primary">Update</button>
			</form>
			<div class="form-inline">
				<input class="form-control" style="width: 80%" id="address" type="textbox" placeholder="Add Station">
				<input class="btn-info pull-right" id="getLocation" type="button" value="Get Station">
			</div>
		</div>
		<div class="col-md-7 col-sm-7" style="margin-top: 40px;">
			<div id="map" style="height: 334px; "></div>
			<p class="text-center">
				Distance :
				<span id="total" class="text-right" ></span>
				<br>
				Time :
				<span dir="rtl" id="time"></span>
				<br>
			</p>
			<details class="text-center" >
				<summary>Show Directions </summary>
				<div id="right-panel">
				</div>
			</details>
		</div>
	</div>
</div>
@endsection
@push('js')
<script>
	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 5,
			center: {
				lat: 30.8688,
				lng: 31.2195
			}
		});
		var directionsService = new google.maps.DirectionsService;
		var geocoder = new google.maps.Geocoder();        
		var directionsDisplay = new google.maps.DirectionsRenderer({
			draggable: true,
			map: map,
			panel: document.getElementById('right-panel')
		});
		document.getElementById('getLocation').addEventListener('click', function() {
			geocodeAddress(geocoder, map);
		});
		directionsDisplay.addListener('directions_changed', function() {
			computeTotalDistance(directionsDisplay.getDirections());
		});
		displayRoute(directionsService, directionsDisplay);
	}
	function geocodeAddress(geocoder, resultsMap) {
		var address;
		address = document.getElementById('address').value;

		geocoder.geocode({'address': address}, function(results, status) {
			if (status === 'OK') {
				resultsMap.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: resultsMap,
					draggable: true,
					position: results[0].geometry.location
				});
				// console.log(results[0]);
				document.getElementById('station').innerHTML += "<input type='hidden' name='addresses[]' value="  + results[0].formatted_address +" >";						
				document.getElementById("station").innerHTML += "<input type='hidden' name='stationlats[]' value=" + results[0].geometry.location.lat()+" >";
				document.getElementById("station").innerHTML += "<input type='hidden' name='stationlngs[]' value=" + results[0].geometry.location.lng()+" >";
				document.getElementById('address').value = "";
			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}
	function displayRoute(directionsService, directionsDisplay) {
		var start =  new google.maps.LatLng({{ $line->latFromRoute }}, {{ $line->lngFromRoute }});
		var end =  new google.maps.LatLng({{ $line->latToRoute }}, {{ $line->lngToRoute }});
		var waypts = [];
		waypts.push(
			@foreach($line->waypoints as $waypoint)
			{location: new google.maps.LatLng( {{ $waypoint->latitude }}, {{ $waypoint->longitude }} ) },
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

	function computeTotalDistance(result) {
		var total = 0;
		var myroute = result.routes[0];
		for (var i = 0; i < myroute.legs.length; i++) {
			total += myroute.legs[i].distance.value;
		}
		total = total / 1000;
		document.getElementById('total').innerHTML = total + ' km';
		document.getElementById('time').innerHTML = result.routes[0].legs[0].duration.text; 
		document.getElementById('latFromRoute').value = myroute.legs[0].start_location.lat(); 
		document.getElementById('lngFromRoute').value = myroute.legs[0].start_location.lng(); 
		document.getElementById('latToRoute').value = myroute.legs[0].end_location.lat(); 
		document.getElementById('lngToRoute').value = myroute.legs[0].end_location.lng(); 
		document.getElementById('addressFrom').value = myroute.legs[0].start_address; 
		document.getElementById('addressTo').value = myroute.legs[0].end_address; 
	}
</script>
@endpush
@push('googleScript')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCz1s7xqwM6CsqESjN3hQNwLbiB017vOcI&callback=initMap" async defer></script>
@endpush
