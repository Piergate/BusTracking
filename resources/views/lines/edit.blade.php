@extends('layouts.master')
@section('content')
<div class="container">
	<form action="{{ url('/lines/'.$line->id) }}" method="POST" role="form" class="form-horizontal">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<legend><i class="fa fa-edit"></i> Edit Line</legend>
	
		<div class="form-group">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<label for="name">name</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ $line->name }}" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<label for="from route">from route</label>
				<input type="text" class="form-control" id="from route" name="fromRoute" value="{{ $line->fromRoute }}" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<label for="to route">to route</label>
				<input type="text" class="form-control" id="to route" name="toRoute" value="{{ $line->toRoute }}" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="">notes</label>
				<textarea class="form-control" name="notes" value="{{ $line->notes }}"></textarea>
			</div>
		</div>
	
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
</div>
@endsection