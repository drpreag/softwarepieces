@extends('partials._main')

@section('title', '| Edit Category')

@section('stylesheets')
	{!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

	<div class="container">
		<h1>Edit Category</h1>
		<hr>	
		<div class="well">
			{{ Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT']) }}
			
			    {{ csrf_field() }}
			    
				{{ Form::label('id', 'Id #:') }}
				{{ Form::number('id', null, array('class' => 'form-control', 'readonly'=>'readonly')) }}
							
				{{ Form::label('name', 'Category name:') }}
				{{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
			
				{{ Form::label('sortid', 'Sort Id:') }}
				{{ Form::number('sortid', null, array('class' => 'form-control', 'required' => '', 'min' => '', 'max' => '255') ) }}

				{{ Form::label('active', 'Active:') }}
				{{ Form::select('active', $categoryStatus, null, ['class' => 'form-control']) }}

				{{ Form::label('creator', 'Creator:') }}				
				{{ Form::text('creator', $category->isCreator->name, array('class' => 'form-control', 'readonly'=>'readonly')) }}	

				{{ Form::label('created_at', 'Created At:') }}				
				{{ Form::text('created_at', $category->created_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}				
				{{ Form::label('updated_at', 'Updated At:') }}				
				{{ Form::text('updated_at', $category->updated_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}				
				<br>
				<div class="row">
					<div class="col-sm-6" align="right">
						{!! Html::linkRoute('categories.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-sm')) !!}
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm']) }}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection