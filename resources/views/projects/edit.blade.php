@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-xs-12 col-sm-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<div class="pull-left">
						<h4>Edit Project of <strong><u>{{ $project -> projectable -> name }}</u><span style="color: #0099ff;">({{ ($project -> projectable_type == 'main_cat') ? 'Main' : 'Sub' }})</strong></h4>
					</div>
					<div class="pull-right">
						<a class="btn btn-primary" href="{{ route('projects.index', [$project -> projectable_type, $project -> projectable_id]) }}"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
				</div>
				<div class="card-body">
					<!-- session messages -->
					@include('partials._messages')

					{!! Form::model($project, ['method' => 'PUT','route' => ['projects.update', $project->id]]) !!}
					<div class="row">

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


