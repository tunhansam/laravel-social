@if ($errors->any()) 
	<div class="erro-config">
		@foreach ($errors->all() as $error) 
			<div>{{ $error }}</div>
		@endforeach
	</div>
@endif
