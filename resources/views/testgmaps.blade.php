@extends('layouts.master')
@section('content')

<div id="map" style="width: 400px; height: 400px;"></div>

@endsection

@push('js')
<script>
    var map = new GMaps({
        el: '#map',
        lat: -12.043333,
        lng: -77.028333
    });
</script>
@endpush 
