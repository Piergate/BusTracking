@extends('layouts.master')
@section('content')
<div class="container">
	<form action="{{ url('/buses') }}" method="POST" role="form" class="form-horizontal">
		{{ csrf_field() }}
		<legend>Create new driver</legend>
	
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="phone">Phone</label>
				<input type="text" class="form-control" name="phone" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="password">Password</label>
				<input type="text" class="form-control" name="password" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4">
				<label for="bus">bus</label>
				<select name="bus">
					@foreach($buses as $bus)
						<option value="{{ $bus->id }}">{{ $bus->number }}</option>
					@endforeach
				</select>
				<a href="{{ url('/buses/create')}}" class="btn btn-success">Create new bus</a>
			</div>
		</div>
	
		<button type="submit" class="btn btn-primary">Create</button>
	</form>
</div>
@endsection