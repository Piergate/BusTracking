@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h2><i class="fa fa-user"></i> Users</h2>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			@if(Entrust::hasRole('Admin'))
			<a href="{{ url('/manageusers/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Create new User</a>
			@endif
		</div>
	</div>
	<div class="row">
		<table class="table table-striped table-hover" id="users-table">
			<thead>
				<tr>
					<th class="text-center">Name</th>
					<th class="text-center">Phone</th>
					<th class="text-center">Roles</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td class="text-center">{{ $user->name }}</td>
					<td class="text-center">{{ $user->phone }}</td>

					<td class="text-center">
						@foreach ($user->roles as $role)
						{{ $role->name }}
					</td>

					@endforeach
					<td style="height: 89px;width: 200px;padding-left: 0px;">
						<a class="btn btn-info" href="{{ url('/manageusers/'.$user->id) }}"><i class="fa fa-map"></i> view</a>
						@if(!$user->hasRole('Admin'))
						<form action="{{ url('manageusers/'.$user->id) }}" method="POST" style="float:right;" class="form-inline">
							{{ csrf_field() }} {{ method_field('DELETE') }}
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this user ?')"><i class="fa fa-trash"></i> delete</button>
						</form>
						@endif
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
	$(document).ready(function() {
		$('#users-table').DataTable( { "order": [[ 2, "asc" ]] } );
	});

</script>
@endpush

