@extends('partials._main')

@section('title', '| View Post')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>Title: <b>{{ $post->title }}</b></h3>		
			</div>
			<div class="col-md-4" align="right">
				<a href="{{ route('posts.index') }}" class="btn btn-info btn-xs">Back</a>
				<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-xs">Edit</a>
				<a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger btn-xs">Delete</a>
			</div>
		</div>		

		<div class="well">
			<div>
				{!! $post->body !!}
			</div>
			<div>
	        	@if (! empty($post->image))
	                <img src="{{ asset('images/' . $post->image) }}" max-height="600px" max-width="600px">
            	@endif
            </div>
			<div>
				Category: <b>{{ $post->inCategory->name }}</b>
				<br>
				Created by: <b>{{ $post->isCreator->name }}</b> @ {{ $post->created_at }}; Last update @ {{ $post->updated_at }}</b>
			</div>            
		</div>
		@if (1>2)
		<div id="backend-comments" style="margin-top: 50px;">
			<h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>

			<table class="table-condensed table-striped table-hover">
				<thead class="thead-inverse">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Comment</th>
						<th width="70px"></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($post->comments as $comment)
					<tr>
						<td>{{ $comment->name }}</td>
						<td>{{ $comment->email }}</td>
						<td>{{ $comment->comment }}</td>
						<td>
							<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endif
	</div>

@endsection