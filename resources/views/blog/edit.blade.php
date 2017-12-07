@extends('partials._main')

@section('title', '| Edit Blog Post')

@section('content')
	<div class="container">
		<div class="well">
			{!! Form::model($post, ['route' => ['blog.update', $post->id], 'files' => true, 'method' => 'PUT']) !!}
				{{ csrf_field() }}

				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				{{ Form::label('subtitle', 'Subtitle:') }}
				{{ Form::text('subtitle', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '1024')) }}				

				{{ Form::label('category', 'Category:') }}
				{{ Form::select('category', $blogCategories, null, array('class' => 'form-control', 'required' => 'required', 'placeholder'=>'Choose one...')) }}
				
				{{ Form::label('body', "Body:") }}
				{{ Form::textarea('body', null, array('class' => 'form-control', 'readonly'=>'readonly')) }}
				<br>
	        	@if (! empty($post->image))
	                <img src="{{ asset('images/' . $post->image) }}" max-height="600px" max-width="600px"><br>
				@endif
				{{ Form::label('image', 'You can change a Featured Image') }}
				{{ Form::file('image') }}

				{{ Form::label('keywords', 'Keywords: (coma delimited)') }}
				{{ Form::text('keywords', null, array('class' => 'form-control', 'maxlength' => '255')) }}

				{{ Form::label('slug', 'Slug (unique):') }}
				{{ Form::text('slug', null, ["class" => 'form-control']) }}

				{{ Form::label('creator', 'Creator:') }}				
				{{ Form::text('creator', $post->isCreator->name, array('class' => 'form-control', 'readonly'=>'readonly')) }}

				{{ Form::label('approved', 'Approved:') }}<br>
				@if ( $post->approved==1 )
					<button type="button" class="btn btn-xs btn-success">Approved</button>
				@else
					<button type="button" class="btn btn-xs btn-danger">Not approved</button>
				@endif				
				<br>

				{{ Form::label('created_at', 'Created at:') }}				
				{{ Form::text('created_at', null, array('class' => 'form-control', 'readonly'=>'readonly')) }}	

				{{ Form::label('updated_at', 'Updated at:') }}				
				{{ Form::text('updated_at', null, array('class' => 'form-control', 'readonly'=>'readonly')) }}	

				<br>
				<div class="row">
					<div class="col-sm-6" align="right">
						{!! Html::linkRoute('blog.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-sm')) !!}
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
			menubar: true
		});
	</script>
@endsection