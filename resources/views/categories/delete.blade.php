@extends('partials._main')

@section('title', '| Delete Category')

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
		<h1>Delete Category</h1>
		<hr>		
		{{ Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) }}
		{{ csrf_field() }}
		<div class="well">
			<dl class="dl-horizontal">
				<dt>Id#:</dt>
				<dd>{{ $category->id }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Category name:</dt>
				<dd>{{ $category->name }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Sort id#:</dt>
				<dd>{{ $category->sortid }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Active:</dt>
				<dd>
					@if ( $category->active==1 )
						Active
					@else
						Inactive
					@endif
				</dd>
			</dl>				
			<dl class="dl-horizontal">
				<dt>Creator:</dt>
				<dd>{{ $category->usercreator->name }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Created At:</dt>
				<dd>{{ $category->created_at }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated:</dt>
				<dd>{{ $category->updated_at }}</dd>
			</dl>
		</div>
		<div class="row">
			<div class="col-sm-6">
				{!! Html::linkRoute('categories.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-block')) !!}
			</div>
			<div class="col-sm-6">
				{{ Form::submit('Delete Category', ['class' => 'btn btn-success btn-block']) }}
			</div>
		</div>
		{!! Form::close() !!}
	</div>	<!-- end of .row (form) -->
@endsection