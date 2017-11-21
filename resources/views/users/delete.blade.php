@extends('partials._main')

@section('title', '| Delete User')

@section('content')

	<div class="container">
		<h3>Delete User</h3>
		<hr>		
		{{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) }}
		{{ csrf_field() }}
		<div class="well">	
			<dl class="dl-horizontal">
				<dt>Id #:</dt>
				<dd>{{ $user->id }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Name:</dt>
				<dd>{{ $user->name }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>E-mail:</dt>
				<dd>{{ $user->email }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Role:</dt>
				<dd>{{ $user->hasRole->name }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Active:</dt>
				<dd>
					@if ( $user->active==1 )
						Active
					@else
						Inactive
					@endif
				</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Created At:</dt>
				<dd>{{ $user->created_at }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated:</dt>
				<dd>{{ $user->updated_at }}</dd>
			</dl>
		</div>
		<div class="row">
			<div class="col-sm-6">
				{!! Html::linkRoute('users.index', 'Cancel', array(), array('class' => 'btn btn-danger btn-block')) !!}
			</div>			
			<div class="col-sm-6">
				{{ Form::submit('Delete User', ['class' => 'btn btn-success btn-block']) }}
			</div>
		</div>
		{!! Form::close() !!}
	</div>	
@endsection