<div class="row">
	<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
		@if (session('status'))
		<div class="alert alert-success" role="alert">
			<strong>Success:</strong> {{ session('status') }}
		</div>
		@endif

		@if (session('success'))
		<div class="alert alert-success" role="alert">
			<strong>Success:</strong> {{ session('success') }}
		</div>
		@endif

		@if (session('error'))
		<div class="alert alert-danger" role="alert">
			<strong>Error:</strong> {{ session('error') }}
		</div>
		@endif

		@if ($errors->any())
		<div class="alert alert-danger" style="padding-bottom: 0px;">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>


