@extends('partials._main')

@section('title', '| Edit Blog Post')

@section('content')
	<div class="container">
		<div class="well">
			{!! Form::model($post, ['route' => ['posts.update', $post->id], 'files' => true, 'method' => 'PUT']) !!}
				{{ csrf_field() }}

				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

				{{ Form::label('category', 'Category:') }}
				{{ Form::select('category', $postCategories, null, array('class' => 'form-control', 'required' => 'required', 'placeholder'=>'Choose one...')) }}
				
				{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
				{{ Form::textarea('body', null, ['class' => 'form-control']) }}

	        	@if (! empty($post->image))
	                <img src="{{ asset('images/' . $post->image) }}" max-height="600px" max-width="600px"><br>
				@endif
				{{ Form::label('image', 'You can change a Featured Image') }}
				{{ Form::file('image') }}

				{{ Form::label('creator', 'Creator:') }}				
				{{ Form::text('creator', $post->isCreator->name, array('class' => 'form-control', 'readonly'=>'readonly')) }}

				{{ Form::label('created_at', 'Created at:') }}				
				{{ Form::text('created_at', $post->created_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}	

				{{ Form::label('updated_at', 'Updated at:') }}				
				{{ Form::text('updated_at', $post->updated_at, array('class' => 'form-control', 'readonly'=>'readonly')) }}	

				<div class="row">
					<div class="col-sm-6" align="right">
						{!! Html::linkRoute('posts.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-sm')) !!}
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm']) }}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection

@section('stylesheets')
	{!! Html::style('/css/parsley.css') !!}
@endsection

@section('scripts')
	<script src="/js/tinymce/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>
@endsection