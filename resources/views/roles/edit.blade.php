@extends('partials._main')

@section('title', '| Edit User role')

@section('content')

	<div class="container">
		<div class="well">
			{!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}
			{{ csrf_field() }}

			{{ Form::label('id', 'Id:') }}
			{{ Form::text('id', $role->id, array('class' => 'form-control', 'readonly' => 'readonly', 'maxlength' => '11')) }}

			{{ Form::label('name', 'Role name:') }}
			{{ Form::text('name', $role->name, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '32')) }}

			{{ Form::label('description', "Description:") }}
			{{ Form::textarea('description', $role->description, array('class' => 'form-control', 'maxlength' => '128')) }}

			{{ Form::label('creator', 'Creator:') }}
			{{ Form::text('creator', empty($role->isCreator->name)?'':$role->isCreator->name, array('class' => 'form-control', 'readonly' => 'readonly', 'maxlength' => '64')) }}

			<hr>
			<div class="row">
				<div class="col-sm-6" align="right">
					<a class="btn btn-info btn-sm" href="{{ route('roles.index') }}">Cancel</a>					
				</div>
				<div class="col-sm-6">
					{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm']) }}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>

@endsection
