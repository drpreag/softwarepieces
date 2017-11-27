@extends('partials._main')

@section('title', '| Create New Post')

@section('content')

		<div class="row">
			<div class="col-md-8">
				<h3>Create a Blog post</h3>		
			</div>
			<div class="col-md-4" align="right">
			</div>
		</div>
	
		<div class="well">		
			{!! Form::open(array('route' => 'blog.store', 'data-parsley-validate' => '', 'files' => true)) !!}
				{{ csrf_field() }}

				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				{{ Form::label('category', 'Category:') }}
				{{ Form::select('category', $blogCategories, null, array('class' => 'form-control', 'required' => 'required', 'placeholder'=>'Choose one...')) }}

				{{ Form::label('image', 'Upload an Image:') }}
				{{ Form::file('image') }}

				{{ Form::label('body', "Post Body:") }}
				{{ Form::textarea('body', null, array('class' => 'form-control')) }}

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

@endsection

@section('stylesheets')
	{!! Html::style('/css/parsley.css') !!}
@endsection

@section('scripts')
			<script src="/js/tinymce/tinymce.min.js"></script>
			<script>
				tinymce.init({ 
				    selector: 'textarea',
				    setup: function (editor) {
				        editor.on('change', function (e) {
				            editor.save();
				        });
				    }
				});				
			</script>
@endsection
