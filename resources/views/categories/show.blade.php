@extends('partials._main')

@section('title', '| View Category')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>Category: <b>{{ $category->name }}</b></h3>		
			</div>
			<div class="col-md-4" align="right">
				<a href="{{ route('categories.index') }}" class="btn btn-info btn-xs">Back</a>				
				<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-xs">Edit</a>
				<a href="{{ route('categories.delete', $category->id) }}" class="btn btn-danger btn-xs">Delete</a>
			</div>
		</div>	

		<div class="well">
			<dl class="dl-horizontal">
				<dt>Id #:</dt>
				<dd>{{ $category->id }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Name:</dt>
				<dd>{{ $category->name }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Sort Id #:</dt>
				<dd>{{ $category->sortid }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Creator:</dt>
				<dd>{{ empty($category->isCreator->name)?'':$category->isCreator->name }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Status:</dt>
				<dd>
					@if ($category->active==1)
						<button type="button" class="btn btn-xs btn-info">Active</button>
					@else
						<button type="button" class="btn btn-xs btn-danger">Inactive</button>
					@endif
				</dd>
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
	</div>

@endsection