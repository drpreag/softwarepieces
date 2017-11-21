@extends('partials._main')

@section('title', '| Edit News')

@section('stylesheets')
	{!! Html::style('css/select2.min.css') !!}
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>
@endsection

@section('content')

	<div class="container">
		<h1>Edit Newz</h1>
		<hr>	
		<div class="well">
			{{ Form::model($newz, ['route' => ['news.update', $newz->id], 'method' => 'PUT']) }}			
			{{ csrf_field() }}
			    
			{{ Form::label('id', 'Id #:') }}
			{{ Form::number('id', null, array('class' => 'form-control', 'readonly'=>'readonly')) }}

			{{ Form::label('url', 'Url:') }}
			{{ Form::text('url', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '255')) }}

			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '255')) }}

			{{ Form::label('imgurl', 'Image url:') }}
			{{ Form::text('imgurl', null, array('class' => 'form-control', 'maxlength' => '255')) }}

			{{ Form::label('post', 'Post:') }}
			{{ Form::textarea('post', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '1023')) }}

			{{ Form::label('category', 'Category:') }}
			{{ Form::select('category', $newzCategory, null, ['class' => 'form-control']) }}

			{{ Form::label('active', 'Active:') }}
			{{ Form::select('active', $newzStatus, null, ['class' => 'form-control']) }}			

			{{ Form::label('creator', 'Creator:') }}
			{{ Form::text('creator', $newz->isCreator->name, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'readonly'=>'readonly')) }}	
			
			{{ Form::label('created_at', 'Created At:') }}				
			{{ Form::text('created_at', $newz->created_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}				

			{{ Form::label('updated_at', 'Updated At:') }}				
			{{ Form::text('updated_at', $newz->updated_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}					

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

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection