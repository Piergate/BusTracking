@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-5">
            <form action="{{ url('/lines') }}" method="POST" role="form" class="form-horizontal">
                {{ csrf_field() }}
                <legend>Create new line</legend>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="fromRoute">From route</label>
                    <input type="text" id="origin-input" name="origin-input" class="controls form-control" required>
                    <input type="hidden" name="latFromRoute" id="latFromRoute">
                    <input type="hidden" name="lngFromRoute" id="lngFromRoute">
                </div>
                <div class="form-group">
                    <label for="toRoute">To route</label>
                    <input type="text" id="destination-input" class="controls form-control" name="destination-input" required>
                    <input type="hidden" name="latToRoute" id="latToRoute">
                    <input type="hidden" name="lngToRoute" id="lngToRoute">
                </div>
                <div class="hidden">
                    <input type="hidden" name="addressFrom" id="addressFrom" value="">
                    <input type="hidden" name="addressTo" id="addressTo" value="">
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" style="margin-top: 40px;">
            <div id="map" style="height: 334px; "></div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            mapTypeControl: false,
            center: {
                lat: 30.8688,
                lng: 31.2195
            },
            zoom: 5
        });
        new AutocompleteDirectionsHandler(map);
    }

    function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'DRIVING';
        var originInput = document.getElementById('origin-input');
        var destinationInput = document.getElementById('destination-input');
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);

        var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {
                placeIdOnly: true
            });
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {
                placeIdOnly: true
            });
        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
    }
    AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.place_id) {
                window.alert("Please select an option from the dropdown list.");
                return;
            }
            if (mode === 'ORIG') {
                me.originPlaceId = place.place_id;
document.getElementById("latFromRoute").value = place.geometry.location.lat(); //latitude From
document.getElementById("lngFromRoute").value = place.geometry.location.lng(); //longitude From
document.getElementById("addressFrom").value = place.formatted_address; //address From
} else {
    me.destinationPlaceId = place.place_id;
document.getElementById("latToRoute").value = place.geometry.location.lat(); //latitude To
document.getElementById("lngToRoute").value = place.geometry.location.lng(); //longitude To
document.getElementById("addressTo").value = place.formatted_address; //address To
}
me.route();
});
    };
    AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
            return;
        }
        var me = this;
        this.directionsService.route({
            origin: {
                'placeId': this.originPlaceId
            },
            destination: {
                'placeId': this.destinationPlaceId
            },
            travelMode: this.travelMode
        },
        function(response, status) {
            if (status === 'OK') {
                me.directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    };
</script>
@endpush
@push('googleScript')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCz1s7xqwM6CsqESjN3hQNwLbiB017vOcI&libraries=places&callback=initMap" async defer></script>
@endpush
