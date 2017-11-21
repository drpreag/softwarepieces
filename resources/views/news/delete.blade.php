@extends('partials._main')

@section('title', '| Delete News')

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
		<h1>Delete News</h1>
		<hr>		
		{{ Form::open(['route' => ['news.destroy', $news->id], 'method' => 'DELETE']) }}
		{{ csrf_field() }}
		<div class="well">	
			<dl class="dl-horizontal">
				<dt>Id #:</dt>
				<dd>{{ $news->id }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Title:</dt>
				<dd>{{ $news->title }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>URL:</dt>
				<dd>{{ $news->url }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Post:</dt>
				<dd>{!! $news->post !!}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Category:</dt>
				<dd>{{ $news->newscategory->name }}</dd>	
			</dl>
			<dl class="dl-horizontal">
				<dt>Creator:</dt>
				<dd>{{ $news->usercreator->name }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Active:</dt>
				<dd>
					@if ( $news->active==1 )
						Active
					@else
						Inactive
					@endif
				</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Created At:</dt>
				<dd>{{ $news->created_at }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated:</dt>
				<dd>{{ $news->updated_at }}</dd>
			</dl>
		</div>
		<div class="row">
			<div class="col-sm-6">
				{!! Html::linkRoute('news.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-block')) !!}
			</div>
			<div class="col-sm-6">
				{{ Form::submit('Delete News', ['class' => 'btn btn-success btn-block']) }}
			</div>
		</div>
		{!! Form::close() !!}
	</div>	<!-- end of .row (form) -->
@endsection