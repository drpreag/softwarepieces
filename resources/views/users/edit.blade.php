@extends('partials._main')

@section('title', '| Edit User')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>Edit User</h3>		
			</div>
			<div class="col-md-4" align="right">
				@if (! empty($user->avatar))
                    <img src="{{ asset('images/' . $user->avatar) }}" max-height="300px" max-width="200px">
                @endif
			</div>
		</div>
		<div class="well">
			{{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
			
		    {{ csrf_field() }}
		    
			{{ Form::label('id', 'Id #:') }}
			{{ Form::number('id', null, array('class' => 'form-control', 'readonly'=>'readonly')) }}

			{{ Form::label('email', 'Email:') }}
			{{ Form::text('email', null, array('class' => 'form-control', 'readonly'=>'readonly', 'maxlength' => '255')) }}
						
			{{ Form::label('name', 'Name:') }}
			{{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

			{{ Form::label('active', 'Active:') }}
			{{ Form::select('active', $userStatus, null, ['class' => 'form-control']) }}
		
			{{ Form::label('role', 'Role:') }}
			{{ Form::select('role', $userRole, null, ['class' => 'form-control']) }}						

			{{ Form::label('avatar', 'Avatar URL:') }}
			{{ Form::text('avatar', null, array('class' => 'form-control', 'readonly'=>'readonly', 'maxlength' => '255')) }}		

			{{ Form::label('created_at', 'Created At:') }}				
			{{ Form::text('created_at', $user->created_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}		

			{{ Form::label('updated_at', 'Updated At:') }}				
			{{ Form::text('updated_at', $user->updated_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}	
			<br>
			<div class="row">
				<div class="col-sm-6" align="right">
					<a class="btn btn-info btn-sm" href="{{ URL::previous() }}">Cancel</a>
				</div>
				<div class="col-sm-6">
					{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm']) }}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection