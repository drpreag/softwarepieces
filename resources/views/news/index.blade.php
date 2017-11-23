@extends('partials._main')

@section('title', '| All News')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h3>All news</h3>
		</div>
		<div class="col-md-4" align="right">
			@if (Auth::check())
				<a href="{{ route('news.create') }}" class="btn btn-success btn-xs">Create a News</a>
			@endif
		</div>
	</div>

	<div class="container">
		<table class="table-condensed table-striped table-hover">
			<thead class="thead-inverse">
				<th class="text-right">#&nbsp</th>
				<th>Title</th>
				<th>Body</th>
				<th class="text-center">Active</th>				
				<th>Creator</th>
				<th>Category</th>					
				<th>Created at</th>
				<th>Updated at</th>				
			</thead>

			<tbody>					
				@foreach ($news as $newz)
					<tr class="table-tr" data-url="{{ route('news.show', $newz->id) }}">
						<td align="right">{{ $newz->id }}&nbsp</td>
						<td>{{ substr(strip_tags($newz->title), 0, 70) }}{{ strlen(strip_tags($newz->title)) > 70 ? "..." : "" }}</td>
						<td>{{ substr(strip_tags($newz->post), 0, 50) }}{{ strlen(strip_tags($newz->post)) > 50 ? "..." : "" }}</td>
						<td align="center">
							@if ( $newz->active==1 )
								<button type="button" class="btn btn-xs btn-info">Active</button>
							@else
								<button type="button" class="btn btn-xs btn-danger">Inactive</button>
							@endif
						</td>
						<td>{{ $newz->isCreator->name }}</td>
						<td>{{ substr(strip_tags($newz->newsCategory->name), 0, 30) }}{{ strlen(strip_tags($newz->newsCategory->name)) > 30 ? "..." : "" }}</td>
						<td>{{ $newz->created_at }}</td>
						<td>{{ $newz->updated_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $news->links() }}		
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