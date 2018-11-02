@extends('partials._main')

@section('title', '| View News')

@section('content')

	<div class="gtco-container .col-md-6">
			
		<div align="right">
			<a href="{{ route('dashboard') }}" class="btn btn-info btn-xs">Back</a>
		</div>
		<br>
        <div class="row">
            <div class="col-md-8">

				<h3><b>{{ $newz->title }}</b></h3>		

				<div class="post-body">
					@if (! empty($newz->imgurl))
						<img src="{{ $newz->imgurl }}" style="float: right; margin: 15px 15px 15px 15px; border:1px solid #000000;" class="responsive-image" width="200px" target="_blank">
					@endif
					{!! $newz->post !!}
					Read original text <a href="{{ $newz->url }}" target="_blank">here</a>
				</div>
			</div>

	        <div class="col-md-4" align="right">
                Category: <b>{{ $newz->inCategory->name }}</b><br>
                Shared by: <a href="{{ route('profiles.show', $newz->creator) }}"><b>{{ $newz->isCreator->name }}</b></a><br>
                Published: <b>{{ substr($newz->created_at,0,10) }}</b><br>
                Slug: <b>{{ $newz->slug }}</b><br>
			</div>
		</div>
	</div>
@endsection
