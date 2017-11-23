@extends('partials._main')

@section('title', '| View Post')

@section('content')

	<div class="container">
		<h1>{{ $post->title }}</h1>
		<hr>
		Created by: <b>{{ $post->usercreator->name }}</b> @ {{ $post->created_at }}; Last update @ {{ $post->updated_at }};  Category: <b>{{ $post->category->name }}</b> 
		<hr>
		<p class="lead">{!! $post->body !!}</p>
		
		<div>
			{!! Html::linkRoute('posts.index', 'Back', array(), array('class' => 'btn btn-danger btn-block')) !!}
		</div>

		<div id="backend-comments" style="margin-top: 50px;">
			<h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>

			<table class="table">
				<thead>
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
	</div>

@endsection