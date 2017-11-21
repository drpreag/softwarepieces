@extends('partials._main')

@section('title', '| Create new Category')

@section('content')

	<div class="container">
		<h3>Create a Category</h3>

		<div class="well">
			{!! Form::open(array('route' => 'categories.store', 'files' => true)) !!}
			    
			    {{ csrf_field() }}
			    
				{{ Form::label('name', 'Category name:') }}
				{{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				{{ Form::label('sortid', 'Sort Id:') }}
				{{ Form::number('sortid', null, array('class' => 'form-control', 'required' => '', 'min' => '1', 'max' => '255') ) }}

				<br>
				<div class="row">
					<div class="col-sm-6" align="right">
						<a class="btn btn-danger btn-sm" href="{{ route('categories.index') }}">Cancel</a>
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm']) }}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection
