@extends('partials._main')

@section('title', '| Create News')

@section('stylesheets')
	{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css') !!}
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>Create Newz</h3>		
			</div>
			<div class="col-md-4" align="right">
			</div>
		</div>
		<div class="well">
			{!! Form::open(array('route' => 'news.store')) !!}
				{{ csrf_field() }}

				{{ Form::label('url', 'Url:') }}
				{{ Form::text('url', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '255')) }}

				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '128')) }}

				{{ Form::label('imgurl', 'Image url:') }}
				{{ Form::text('imgurl', null, array('class' => 'form-control', 'maxlength' => '255')) }}

				{{ Form::label('post', 'Post:') }}
				{{ Form::textarea('post', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '1023')) }}

				{{ Form::label('category', 'Category:') }}
				{{ Form::select('category', $newzCategory, 1, array('class' => 'form-control', 'required' => 'required')) }}

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
	<script src="/js/parsley.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/en.js"></script>
	<script src="/js/tinymce/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>
@endsection