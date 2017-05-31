@extends('layouts.master')
@section('content')
<div class="container">
	<form action="{{ url('/buses/'.$bus->id) }}" method="POST" role="form" class="form-horizontal">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<legend><i class="fa fa-edit"></i> Edit bus</legend>
	
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="number">Number</label>
				<input type="text" class="form-control" name="number" value="{{ $bus->number }}" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="license">License</label>
				<input type="text" class="form-control" name="license" value="{{ $bus->license }}" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="capacity">Capacity</label>
				<input type="number" min="1" class="form-control" name="capacity" value="{{ $bus->capacity }}" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="line">Line</label>
				<select name="line"> <!-- selected value -->
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
				<textarea name="notes" class="form-control" value="{{ $bus->notes }}"></textarea>
			</div>
		</div>
	
		<button type="submit" class="btn btn-primary">Update</button>
	</form>
</div>
@endsection