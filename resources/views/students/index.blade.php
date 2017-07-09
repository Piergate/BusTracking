@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h2><i class="fa fa-users"></i> students</h2>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			@if(Entrust::hasRole('Admin'))	
				<a href="{{ url('/students/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Create new student</a>
			@endif
		</div>
	</div>
	<div class="row">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=0; ?>
				@foreach($students as $student)
				<tr>
					<td><?php echo $no++; ?></td>
					<td>{{ $student->name }}</td>
					<td>
						<a class="btn btn-info" href="{{ url('/students/'.$student->id) }}"><i class="fa fa-map"></i> view</a>
					
						<a class="btn btn-default" href="{{ url('/students/'.$student->id.'/edit') }}"><i class="fa fa-edit"></i> edit</a>
						<form action="{{ url('/students/'.$student->id) }}" method="POST" style="float: right;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this student ?')"><i class="fa fa-trash"></i> delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection