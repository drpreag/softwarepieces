@extends('partials._main')

@section('description', 'Open Source blog')

@section('keywords')
{{ $post->keywords }}
@endsection

@section('title', '| View Post')

@section('content')
    <div class="main-container">
        <br>        
        <div class="post-body">
            <div class="row">
                <div class="col" align="left">
                    @if (!empty ($previousSlug))                    
                        <a href="{{ route('blog.show_blog', $previousSlug) }}"><i class="fas fa-step-backward fa-2x"></i> Previous</a>
                    @endif
                </div>              
                <div class="col" align="right">
                    @if (!empty ($nextSlug))
                        <a href="{{ route('blog.show_blog', $nextSlug) }}">Next <i class="fas fa-step-forward fa-2x"></i></a>
                    @endif
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h3><b>{{ $post->title }}</b></h3>      
                    <div>
                        @if (! empty($post->image))
                            <img src="{{ asset('images/' . $post->image) }}" class="post-img">
                        @endif
                        {!! $post->body !!}
                    </div>
                </div>

                <div class="col-12 col-lg-4" align="right">
                    <br>
                    <p>Category:<br><b>{{ $post->inCategory->name }}</b></p>
                    <p>Shared by:<br><a href="{{ route('profiles.show', $post->creator) }}"><b>{{ $post->isCreator->name }}</b></a></p>
                    <p>Published:<br><b>{{ substr($post->created_at,0,10) }}</b></p>
                    <p>Slug:<br><b>{{ $post->slug }}</b><br><br></p>
                </div>
            </div>
        </div>
    </div>


    <div>
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