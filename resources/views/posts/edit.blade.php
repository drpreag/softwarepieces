@extends('main')

@section('title', '| Edit Blog Post')

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
		<div class="well">
			{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
			{{ csrf_field() }}

			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

			{{ Form::label('category_id', 'Category:') }}
			{{ Form::select('category_id', $postCategories, null, ['class' => 'form-control']) }}
			
			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}

			{{ Form::label('creator', 'Creator:') }}				
			{{ Form::text('creator', $post->usercreator->name, array('class' => 'form-control', 'readonly'=>'readonly')) }}	

			{{ Form::label('created_at', 'Created At:') }}				
			{{ Form::text('created_at', $post->created_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}				

			{{ Form::label('updated_at', 'Updated At:') }}				
			{{ Form::text('updated_at', $post->updated_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}				

			<hr>
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('posts.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-block')) !!}
				</div>
				<div class="col-sm-6">
					{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
				</div>
			</div>

		</div>
		{!! Form::close() !!}
	</div>

@stop
