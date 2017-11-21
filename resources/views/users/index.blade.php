@extends('partials._main')

@section('title', '| SoftwarePieces Users')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h3>Users</h3>
		</div>
		<div class="col-md-4" align="right">
			@if (Auth::check())
				<a href="{{ route('users.create') }}" class="btn btn-success btn-xs">Create new User</a>			
			@endif
		</div>
	</div>

	<div class="container">
		<table class="table-condensed table-striped table-hover">
			<thead class="thead-inverse">
				<th class="text-right">#</th>
				<th class="text-center">Avatar</th>
				<th>Name</th>
				<th>E-mail</th>
				<th class="text-center">Active</th>
				<th>Role</th>			
				<th>Created at</th>
				<th>Updated at</th>				
			</thead>

			<tbody>
				@foreach ($users as $user)
					<tr class="table-tr" data-url="{{ route('users.show', $user->id) }}">
						<td align="right">{{ $user->id }}</td>
						<td align="center">
                    		@if (! empty($user->avatar))
                        		<img src="{{ asset('images/'.$user->avatar) }}" style="max-height: 30px; max-width: 20px; border-radius: 50%;">
                    		@endif
						</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td align="center">
							@if ( $user->active==1 )
								<button type="button" class="btn btn-xs btn-info">Active</button>
							@else
								<button type="button" class="btn btn-xs btn-danger">Inactive</button>
							@endif
						</td>
						<td>{{ $user->hasRole->name }}</td>
						<td>{{ $user->created_at }}</td>
						<td>{{ $user->updated_at }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $users->links() }}
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