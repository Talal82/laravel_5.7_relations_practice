@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="pull-left">
						<h4>Create New Project of <strong><u>{{ $parentCategory -> name }}</u><span style="color: #0099ff;">({{ ($parentType == 'main_cat') ? 'Main' : 'Sub' }})</strong></h4>
					</div>
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ route('projects.index', [$parentType, $parentCategory -> id]) }}"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
				</div>
				<div class="card-body">
					<!-- session messages -->
					@include('partials._messages')

					{!! Form::open(array('route' => ['projects.store'] , 'method' => 'POST')) !!}
					<div class="row">

						<input name="parent_type" type="hidden" value="{{ $parentType }}">
						<input name="parent_id" type="hidden" value="{{ $parentCategory -> id }}">

						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 offset-2">
							<div class="form-group">
								<label for="name">Name:</label>
								{!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 offset-2">
							<div class="form-group">
								<label for="detail">Name:</label>
								{!! Form::textarea('detail', null, array('class' => 'form-control', 'id' => 'detail')) !!}
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


