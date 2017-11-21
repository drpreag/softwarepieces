@extends('partials._main')

@section('title', '| User roles')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h3>User roles</h3>
		</div>
		<div class="col-md-4" align="right">
			@if (Auth::check())
					<a href="{{ route('roles.create') }}" class="btn btn-success btn-xs">Create new Role</a>		
			@endif
		</div>
	</div>

	<div class="container">
		<table class="table-condensed table-striped">
			<thead class="thead-inverse">
				<th class="text-right">#</th>
				<th>Role name</th>
				<th>Description</th>
				<th class="text-center">Active</th>
				<th>Creator</th>				
				<th>Created at</th>
				<th>Updated at</th>			
			</thead>

			<tbody>
				@foreach ($roles as $role)
					<tr class="table-tr" data-url="{{ route('roles.show', $role->id) }}">
						<td align="right">{{ $role->id }}</td>
						<td>{{ $role->name }}</td>	
						<td>{{ $role->description }}</td>
						<td align="center">
							@if ($role->active==1)
								<button type="button" class="btn btn-xs btn-info">Active</button>
							@else
								<button type="button" class="btn btn-xs btn-danger">Inactive</button>
							@endif
						</td>
						<td>{{ empty($role->isCreator->name)?'':$role->isCreator->name }}</td>						
						<td>{{ $role->created_at }}</td>
						<td>{{ $role->updated_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
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