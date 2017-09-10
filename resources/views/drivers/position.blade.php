@extends('layouts.master')
@section('content')
<div class="container" onload="initMap()">
    <div class="row">
        <div id="map" style="height:400px; " class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2"></div>
        <br>
        
    </div>
</div>
@endsection
@push('js')
<script type="text/javascript">
    var map;
    var lat;
    var lng;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 30.0443100, lng: 31.235717300000400},
            zoom: 9,
        });
        /*=======================================*/
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var marker = new google.maps.Marker({
                    map: map,
                    position: pos
                });
                map.setCenter(pos);
                map.setZoom(15);
                // document.getElementById("latitude").value = pos.lat;
                // document.getElementById("longitude").value = pos.lng;
                console.log(pos);
                setInterval(function() {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/save_position') }}",
                        cache: false,
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        data: {
                            latitude: pos.lat,
                            longitude: pos.lng
                        },
                        success: function() {}
                    });
                    return false;
                }, 10000);
            }, function() {
                // handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }


</script>
@endpush
@push('googleScript')
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCz1s7xqwM6CsqESjN3hQNwLbiB017vOcI&callback=initMap" async defer></script>
@endpush