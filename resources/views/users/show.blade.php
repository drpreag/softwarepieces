@extends('partials._main')

@section('title', '| View User')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>User: <b>{{ $user->name }}</b></h3>		
			</div>
			<div class="col-md-4" align="right">
				<a href="{{ route('users.index') }}" class="btn btn-info btn-xs">Back</a>				
				<a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-xs">Edit</a>
				<a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger btn-xs">Delete</a>				
			</div>
		</div>	

		<div class="well">
			<dl class="dl-horizontal">
				<dt>Id:</dt>
				<dd>{{ $user->id }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Name:</dt>
				<dd>{{ $user->name }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Email:</dt>
				<dd>{{ $user->email }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Active:</dt>
				<dd>
					@if ($user->active==true)
						<button type="button" class="btn btn-xs btn-info">Active</button>
					@else
						<button type="button" class="btn btn-xs btn-danger">Inactive</button>
					@endif
				</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Role:</dt>
				<dd>{{ $user->hasRole->name }}</dd>	
			</dl>	
			<dl class="dl-horizontal">
                <dt>Avatar:</dt>
                <dd>
                    @if (! empty($user->avatar))
                        <img src="{{ asset('images/' . $user->avatar) }}" max-height="300px" max-width="200px">
                    @endif
                </dd>
            </dl>
			<dl class="dl-horizontal">
				<dt>Created at:</dt>
				<dd>{{ $user->created_at }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last update:</dt>
				<dd>{{ $user->updated_at }}</dd>
			</dl>
		</div>
	</div>
@endsection