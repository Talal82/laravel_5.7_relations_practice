@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="pull-left">
						<h4>Create New Sub Category of <strong><u>{{ $parentCategory -> name }}</u></strong></h4>
					</div>
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ route('sub_categories.index', [$parentCategory -> slug, $parentCategory -> id]) }}"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
				</div>
				<div class="card-body">
					<!-- session messages -->
					@include('partials._messages')

					{!! Form::open(array('route' => ['sub_categories.store', $parentCategory -> id],'method'=>'POST')) !!}
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 offset-2">
							<div class="form-group">
								<label for="name">Name:</label>
								{!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
							</div>
						</div>

						<div class="col-xs-12 col-md-8 col-lg-8 offset-2">
							<button type="submit" class="btn btn-primary btn-block">Create New</button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection


