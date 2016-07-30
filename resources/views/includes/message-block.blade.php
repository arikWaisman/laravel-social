@if( count($errors) > 0 )
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<ul class="alert alert-danger errors-list">
				@foreach( $errors->all() as $error )
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>	
	</div>
@endif

@if( Session::has('message') )
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<ul class="alert {{ Session::get('alert_style') }} message-list">
				<li>{{ Session::get('message') }}</li>
			</ul>
		</div>	
	</div>
@endif