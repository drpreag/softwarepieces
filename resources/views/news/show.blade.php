@extends('partials._main')

@section('title', '| View News')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3><b>{{ $newz->title }}</b></h3>		
			</div>
			<div class="col-md-4" align="right">
				<a href="{{ URL::previous() }}" class="btn btn-info btn-xs">Back</a>
				<a href="{{ route('news.edit', $newz->id) }}" class="btn btn-success btn-xs">Edit</a>
				<a href="{{ route('news.delete', $newz->id) }}" class="btn btn-danger btn-xs">Delete</a>
			</div>
		</div>	

		<div class="well">
			<dl class="dl-horizontal">
				<dt>Id #:</dt>
				<dd>{{ $newz->id }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Title:</dt>
				<dd><a href="{{ $newz->url }}" target="_blank">{{ $newz->title }}</a></dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>URL:</dt>
				<dd><a href="{{ $newz->url }}" target="_blank">{{ $newz->url }}</a></dd>
			</dl>
			@if (! empty($newz->imgurl))
				<dl class="dl-horizontal">
					<dt>ImgUrl:</dt>
					<dd>{{ $newz->imgurl }}</dd>
					<dd><img src="{{ $newz->imgurl }}" class="responsive-image" target="_blank" width="500px"></dd>
				</dl>
			@endif		
			<dl class="dl-horizontal">
				<dt>Post:</dt>
				<dd>{!! $newz->post !!}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Category:</dt>
				<dd>{{ $newz->newsCategory->name }}</dd>	
			</dl>
			<dl class="dl-horizontal">
				<dt>Creator:</dt>
				<dd>{{ $newz->isCreator->name }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Status:</dt>
				<dd>
					@if ($newz->active==1)
						<button type="button" class="btn btn-xs btn-info">Active</button>
					@else
						<button type="button" class="btn btn-xs btn-danger">Inactive</button>
					@endif
				</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Created At:</dt>
				<dd>{{ $newz->created_at }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated:</dt>
				<dd>{{ $newz->updated_at }}</dd>
			</dl>
		</div>
	</div>
@endsection
