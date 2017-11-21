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
	</div>

@endsection