@extends('partials._main')

@section('title', '| View Post')

@section('content')

    <div class="gtco-container">
        <div align="right">
            <a href="{{ URL::previous() }}" class="btn btn-info btn-xs">Back</a>
            <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-success btn-xs">Edit</a>
            <a href="{{ route('blog.delete', $post->id) }}" class="btn btn-danger btn-xs">Delete</a>               
        </div>              
        <br> 

        <div class="row">
            <div class="col-md-4">
                Category: <b>{{ $post->inCategory->name }}</b><br>
            </div>
            <div class="col-md-4" align="center">
                @if ( $post->approved==1 )
                    <button type="button" class="btn btn-xs btn-success">Approved</button>
                @else
                    <a href="{{ route('blog.approve', $post->id) }}" class="btn btn-danger btn-xs">Not approved</a>
                @endif                
            </div>            
            <div class="col-md-4" align="right">
                Creator: <a href="{{ route('profiles.show', $post->creator) }}"><b>{{ $post->isCreator->name }}</b></a><br>
                Published: <b>{{ substr($post->created_at,0,10) }}</b>
            </div>
        </div>

        <div class="post-body">
            <br>
            <h3><b>{{ $post->title }}</b></h3>                  
            @if (! empty($post->subtitle))
                <hr>
                <i>{{ $post->subtitle }}</i>
                <hr>                    
            @endif
            @if (! empty($post->image))
                <img src="{{ asset('images/' . $post->image) }}" style="float: right; margin: 15px 15px 15px 15px; border:1px solid #000000;" class="responsive-image" target="_blank" align="right" float="right">
            @endif      
            {!! $post->body !!}
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


@endsection