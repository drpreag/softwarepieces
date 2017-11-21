@extends('main')

@section('title', '| Delete Post')

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
		<h1>Delete Post</h1>
		<hr>		
		{{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) }}
		{{ csrf_field() }}

		<div class="well">
			<dl class="dl-horizontal">
				<dt>Id#:</dt>
				<dd>{{ $post->id }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Title:</dt>
				<dd>{{ $post->title }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Body:</dt>
				<dd>{!! $post->body !!}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Active:</dt>
				<dd>
					@if ( $post->active==1 )
						Active
					@else
						Inactive
					@endif
				</dd>
			</dl>				
			<dl class="dl-horizontal">
				<dt>Creator:</dt>
				<dd>{{ $post->usercreator->name }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Created At:</dt>
				<dd>{{ $post->created_at }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated:</dt>
				<dd>{{ $post->updated_at }}</dd>
			</dl>
		</div>

		<div class="row">
			<div class="col-sm-6">
				{!! Html::linkRoute('posts.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-block')) !!}
			</div>
			<div class="col-sm-6">
				{{ Form::submit('Delete Post', ['class' => 'btn btn-success btn-block']) }}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
@endsection