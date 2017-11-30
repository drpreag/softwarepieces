@extends('partials._main')

@section('title', '| View Post')

@section('content')

	<div class="gtco-container">
		<div align="right">
				<a href="{{ URL::previous() }}" class="btn btn-info btn-xs">Back</a>
		</div>				

        <div>
            <div class="row">
                <div class="col-md-6">
                    Category: <b>{{ $post->inCategory->name }}</b>
                </div>
                <div class="col-md-6" align="right">
                    Published: <b>{{ substr($post->created_at,0,10) }}</b>
                </div>
            </div>
        </div>

        <div class="post-body">
            <br>
            <h3><b>{{ $post->title }}</b></h3>                  
            <div>
                <hr>
                <i>{{ $post->subtitle }}</i>
                <hr>
            </div>
            <div>
                <p>
                    @if (! empty($post->image))
                        <img src="{{ asset('images/' . $post->image) }}" target="_blank" max-height="240px" max-width="300px" align="right" float="right" hspace="20">
                    @endif      
                    {!! $post->body !!}
                </p>
            </div>
        </div>

        <div class="well post-creator">
            <div class="row">
                <div class="col-md-8">
                    Creator: <a href="{{ route('profiles.show', $post->creator) }}"><b>{{ $post->isCreator->name }}</b></a>
                    <br><br>
                    <i>{!! $post->isCreator->description !!}</i>
                </div>
                <div class="col-md-4" align="right">
                    @if (! empty($post->isCreator->avatar))
                        <img src="{{ asset('images/' . $post->isCreator->avatar) }}" target="_blank" max-height="300px" max-width="200px">
                    @endif                                 
                </div>
            </div>
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