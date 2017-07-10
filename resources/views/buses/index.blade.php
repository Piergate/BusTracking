@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h2><i class="fa fa-bus"></i> Buses</h2>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			@if(Entrust::hasRole('Admin'))	
				<a href="{{ url('/buses/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Create new bus</a>
			@endif
		</div>
	</div>
	<div class="row">
		<table class="table table-striped table-hover" id="buses-table" style="width: 100%;">
			<thead>
				<tr>
					<th>Number</th>
					<th>Line</th>
					<th>License</th>
					<th>Capacity</th>
					<th>Notes</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($buses as $bus)
				<tr>
					<td>{{ $bus->number }}</td>
					<td>{{ $bus->line->name }}</td>
					<td>{{ $bus->license }}</td>
					<td>{{ $bus->capacity }}</td>
					<td>{{ $bus->notes }}</td>
					<td>
						<a class="btn btn-info" href="{{ url('/buses/'.$bus->id) }}"><i class="fa fa-bus"></i> view</a>
					
						<a class="btn btn-default" href="{{ url('/buses/'.$bus->id.'/edit') }}"><i class="fa fa-edit"></i> edit</a>
						<form action="{{ url('/buses/'.$bus->id) }}" method="POST" style="float: right;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this bus ?')"><i class="fa fa-trash"></i> delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@push('js')
<script>
	$(document).ready(function () {
		$('#buses-table').DataTable();
	});
</script>
@endpush