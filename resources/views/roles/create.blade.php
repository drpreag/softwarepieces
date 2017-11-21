
@extends('partials._main')

@section('title', '| Create new role')

@section('content')

	<div class="container">
		<h3>Create new RMA</h3>

		<div class="well">		
			{!! Form::open(array('route' => 'roles.store', 'files' => true)) !!}
				{{ csrf_field() }}

				{{ Form::label('name', 'Role name:') }}
				{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '32')) }}

				{{ Form::label('description', "Description:") }}
				{{ Form::textarea('description', null, array('class' => 'form-control', 'maxlength' => '128')) }}
				<br>
				<div class="row">
					<div class="col-sm-6" align="right">
						<a class="btn btn-danger btn-sm" href="{{ route('roles.index') }}">Cancel</a>
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm']) }}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection