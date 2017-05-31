@if( session('message') )
	<script>   
		$(document).ready(function(){
			@if( session('title') )
		    	toastr.{{ session('type') }}("{{ session('message') }}","{{ session('title') }}");
		    @else
		   		toastr.{{ session('type') }}("{{ session('message') }}");
			@endif
		});
	</script>
@endif