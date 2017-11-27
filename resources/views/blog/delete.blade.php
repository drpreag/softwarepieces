@extends('partials._main')

@section('title', '| Delete Post')

@section('content')

	<div class="container">
		<h1>Delete Post</h1>
		<hr>		
		{{ Form::open(['route' => ['blog.destroy', $post->id], 'method' => 'DELETE']) }}
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
				{!! Html::linkRoute('blog.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-sm')) !!}
			</div>
			<div class="col-sm-6">
				{{ Form::submit('Delete Post', ['class' => 'btn btn-success btn-sm']) }}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
@endsection