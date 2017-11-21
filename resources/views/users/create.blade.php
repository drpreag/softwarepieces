@extends('partials._main')

@section('title', '| Edit User')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>Create User</h3>		
			</div>
			<div class="col-md-4" align="right">
			</div>
		</div>
		<div class="well">
			{!! Form::open(array('route' => 'users.store', 'files' => true)) !!}			
			    {{ csrf_field() }}

				{{ Form::label('email', 'Email:') }}
				{{ Form::text('email', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '255')) }}
						
				{{ Form::label('name', 'Name:') }}
				{{ Form::text('name', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '255')) }}

				{{ Form::label('active', 'Active:') }}
				{{ Form::select('active', $userStatus, true, array('class' => 'form-control', 'required' => 'required')) }}
			
				{{ Form::label('role', 'Role:') }}
				{{ Form::select('role', $userRole, 1,  array('class' => 'form-control', 'required' => 'required')) }}		

				{{ Form::label('avatar', 'Avatar URL:') }}
				{{ Form::text('avatar', null, array('class' => 'form-control', 'maxlength' => '255')) }}

				<br>
				<div class="row">
					<div class="col-sm-6" align="right">
						<a class="btn btn-danger btn-sm" href="{{ URL::previous() }}">Cancel</a>
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm']) }}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection