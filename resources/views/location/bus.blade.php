@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div style="width: 100%; height: 500px;">
			{!! Mapper::render() !!}
		</div>
	</div>
</div>
@endsection