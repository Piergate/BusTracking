@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h2><i class="fa fa-drivers-license-o"></i> drivers</h2>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			@if(Entrust::hasRole('Admin'))	
				<a href="{{ url('/drivers/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Create new driver</a>
			@endif
		</div>
	</div>
	<div class="row">
		<table class="table table-striped table-hover" id="drivers-table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=0; ?>
				@foreach($drivers as $driver)
				<tr>
					<td><?php echo $no++; ?></td>
					<td>{{ $driver->name }}</td>
					<td>
						<a class="btn btn-info" href="{{ url('/drivers/'.$driver->id) }}"><i class="fa fa-map"></i> view</a>
					
						<a class="btn btn-default" href="{{ url('/drivers/'.$driver->id.'/edit') }}"><i class="fa fa-edit"></i> edit</a>
						<form action="{{ url('/drivers/'.$driver->id) }}" method="POST" style="float: right;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this driver ?')"><i class="fa fa-trash"></i> delete</button>
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
		$('#drivers-table').DataTable();
	});
</script>
@endpush