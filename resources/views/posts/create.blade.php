@extends('partials._main')

@section('title', '| Create New Post')

@section('content')

	<div class="container">
		<h1>Create a Post</h1>
		<hr>
		<div class="well">		
			{!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true)) !!}
			{{ csrf_field() }}

			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

			{{ Form::label('category_id', 'Category:') }}
			{{ Form::select('category_id', $postCategories, null, ['class' => 'form-control']) }}

			{{ Form::label('featured_img', 'Upload a Featured Image') }}
			{{ Form::file('featured_img') }}

			{{ Form::label('body', "Post Body:") }}
			{{ Form::textarea('body', null, array('class' => 'form-control')) }}

			{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('scripts')
	<script src="/js/parsley.min.js"></script>
	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>
@endsection
