@extends('layouts.master')
@section('content')
<div class="container">
	<form action="{{ url('/lines') }}" method="POST" role="form" class="form-horizontal">
		{{ csrf_field() }}
		<legend>Create new line</legend>
	
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="fromRoute">From route</label>
				<input type="text" class="form-control" name="fromRoute" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="toRoute">To route</label>
				<input type="text" class="form-control" name="toRoute" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<label for="notes">Notes</label>
				<textarea name="notes" class="form-control"></textarea>
			</div>
		</div>
	
		<button type="submit" class="btn btn-primary">Create</button>
	</form>
</div>
@endsection