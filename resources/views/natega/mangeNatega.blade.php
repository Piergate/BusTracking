@extends('layouts.master')
@section('content')
<div class="container text-center">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

			<form action="{{ url('/importExcel') }}" method="post" class="form-inline" role="form" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="h4">Select File To Publish</label>
					<input class="btn btn-info" type="file" name="import_file" />
					<br>
					<button id="publish" class="btn btn-primary">Publish</button>
				</div>
			</form>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h4>Download Data From DataBase</h4>
			<a href="{{ url('downloadExcel/xlsx') }}"><button class="btn btn-default">Download Natega xlsx</button></a>
			<a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-info">Download Natega xls</button></a>
			<br> <br>	
			<a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-primary">Download CSV</button></a>
		</div>
	</div>
</div>
@endsection
