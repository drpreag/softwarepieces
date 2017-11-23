@extends('partials._main')

@section('title', '| View User role')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>User role: <b>{{ $role->name }}</b></h3>		
			</div>
			<div class="col-md-4" align="right">
				<a href="{{ route('roles.index') }}" class="btn btn-info btn-xs">Back</a>				
				<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success btn-xs">Edit</a>
				<a href="{{ route('roles.delete', $role->id) }}" class="btn btn-danger btn-xs">Delete</a>
			</div>
		</div>	

		<div class="well">
			<dl class="dl-horizontal">
				<dt>Id:</dt>
				<dd>{{ $role->id }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Name:</dt>
				<dd>{{ $role->name }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Description:</dt>
				<dd>{{ $role->description }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Status:</dt>
				<dd>
					@if ($role->active==1)
						<button type="button" class="btn btn-xs btn-info">Active</button>
					@else
						<button type="button" class="btn btn-xs btn-danger">Inactive</button>
					@endif
				</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Creator:</dt>
				<dd>{{ empty($role->isCreator->name)?'':$role->isCreator->name }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Created At:</dt>
				<dd>{{ $role->created_at }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated:</dt>
				<dd>{{ $role->updated_at }}</dd>
			</dl>
		</div>
		<div>
			@if ($users->count())
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
			@endif
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