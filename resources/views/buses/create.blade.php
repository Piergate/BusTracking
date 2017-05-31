@extends('layouts.master')
@section('content')
<div class="container">
	<form action="{{ url('/buses') }}" method="POST" role="form" class="form-horizontal">
		{{ csrf_field() }}
		<legend>Create new bus</legend>
	
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="number">Number</label>
				<input type="text" class="form-control" name="number" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="license">License</label>
				<input type="text" class="form-control" name="license" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="capacity">Capacity</label>
				<input type="number" min="1" class="form-control" name="capacity" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="line">Line</label>
				<select name="line">
					@foreach($lines as $line)
						<option value="{{ $line->id }}">{{ $line->name }}</option>
					@endforeach
				</select>
				<a href="{{ url('/lines/create')}}" class="btn btn-success">Create new line</a>
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