@extends('partials._main')

@section('title', '| All Categories')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h3>Categories</h3>
		</div>
		<div class="col-md-4" align="right">
			@if (Auth::check())
					<a href="{{ route('categories.create') }}" class="btn btn-success btn-xs">Create new Category</a>		
			@endif
		</div>
	</div>

	<div class="container">
		<table class="table-condensed table-striped">
			<thead class="thead-inverse">
				<th class="text-right">#&nbsp</th>
				<th>Name</th>
				<th>Sort id</th>
				<th class="text-center">Active</th>
				<th>Creator</th>				
				<th>Created at</th>
				<th>Updated at</th>
			</thead>

			<tbody>
				@foreach ($categories as $category)
					<tr class="table-tr" data-url="{{ route('categories.show', $category->id) }}">
						<td align="right">{{ $category->id }}&nbsp</td>
						<td>{{ $category->name }}</td>
						<td>{{ $category->sortid }}</td>
						<td align="center">
							@if ($category->active==1)
								<button type="button" class="btn btn-xs btn-info">Active</button>
							@else
								<button type="button" class="btn btn-xs btn-danger">Inactive</button>
							@endif
						</td>
						<td>{{ empty($category->isCreator->name)?'':$category->isCreator->name }}</td>
						<td>{{ $category->created_at }}</td>
						<td>{{ $category->updated_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $categories->links() }}
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