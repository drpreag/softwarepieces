@extends('partials._main')

@section('title', '| All Posts')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h3>All Posts</h3>
		</div>
		<div class="col-md-4" align="right">
			@if (Auth::check())
				<a href="{{ route('blog.create') }}" class="btn btn-success btn-xs">Create New Post</a>
			@endif
		</div>
	</div> <!-- end of .row -->

	<div class="container">
		<table class="table-condensed table-striped table-hover">
			<thead class="thead-inverse">
				<th class="text-right">#&nbsp</th>
				<th>Title</th>
				<th>Body</th>				
				<th class="text-center">Active</th>
				<th>Creator</th>					
				<th>Created At</th>
			</thead>

			<tbody>
				@foreach ($posts as $post)
					<tr class="table-tr" data-url="{{ route('blog.show', $post->id) }}">
						<th>{{ $post->id }}</th>	
						<td>{{ substr($post->title, 0, 50) }}{{ strlen($post->title) > 50 ? "..." : "" }}</td>
						<td>{{ substr(strip_tags($post->body), 0, 70) }}{{ strlen(strip_tags($post->body)) > 70 ? "..." : "" }}</td>
						<td align="center">
							@if ( $post->active==1 )
								<button type="button" class="btn btn-xs btn-info">Active</button>
							@else
								<button type="button" class="btn btn-xs btn-danger">Inactive</button>
							@endif
						</td>							
						<td>{{ $post->isCreator->name }}</td>							
						<td>{{ $post->created_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">
			{{ $posts->links() }}
		</div>
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(function() {
  $('table.table-condensed').on("click", "tr.table-tr", function() {
    window.location = $(this).data("url");
  });
});
</script>
@endsection