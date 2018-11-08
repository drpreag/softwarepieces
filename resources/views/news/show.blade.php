@extends('partials._main')

@section('title', '| View News')

@section('content')

	<div class="gtco-container">
			
		<div align="right">
			<a href="{{ route('news.index') }}" class="btn btn-info btn-xs">Back</a>
			<a href="{{ route('news.edit', $newz->id) }}" class="btn btn-success btn-xs">Edit</a>
			<a href="{{ route('news.delete', $newz->id) }}" class="btn btn-danger btn-xs">Delete</a>
		</div>
		<br>

        <div class="row">
            <div class="col-md-4">
                Category: <b>{{ $newz->inCategory->name }}</b><br>
            </div>
            <div class="col-md-4" align="center">
                @if ( $newz->approved==1 )
                    <a href="{{ route('news.revoke_approve', $newz->id) }}" class="btn btn-success btn-xs">Approved</a>                    
                @else
                    <a href="{{ route('news.approve', $newz->id) }}" class="btn btn-danger btn-xs">Not approved</a>
                @endif                
            </div>            
            <div class="col-md-4" align="right">
                Creator: <a href="{{ route('profiles.show', $newz->creator) }}"><b>{{ $newz->isCreator->name }}</b></a><br>
                Published: <b>{{ substr($newz->created_at,0,10) }}</b>
            </div>
        </div>
		<br>


		<div class="row">
			<div class="col-md-4">
				<h3><b>{{ $newz->title }}</b></h3>		
			</div>
		</div>	

		<div class="post-body">
			<dl class="dl-horizontal">
				<dt>Id #:</dt>
				<dd>{{ $newz->id }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Title:</dt>
				<dd>{{ $newz->title }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>URL:</dt>
				<dd><a href="{{ $newz->url }}" target="_blank">{{ $newz->url }}</a></dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Slug:</dt>
				<dd>{{ $newz->slug }}</dd>
			</dl>			
			@if (! empty($newz->imgurl))
			<div>
				<dl class="dl-horizontal">
					<img src="{{ $newz->imgurl }}" class="post-img" target="_blank">
					<dt>ImgUrl:</dt>
					<dd>{{ $newz->imgurl }}</dd>
				</dl>
			</div>
			@endif		
			<dl class="dl-horizontal">
				<dt>Post:</dt>
				<dd>{!! $newz->post !!}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Category:</dt>
				<dd>{{ $newz->inCategory->name }}</dd>	
			</dl>
			<dl class="dl-horizontal">
				<dt>Shared by:</dt>
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
