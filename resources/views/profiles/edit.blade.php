@extends('partials._main')

@section('title', '| Edit profile')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>Edit profile</h3>		
			</div>
			<div class="col-md-4" align="right">
			</div>
		</div>

		<div class="well">
			{{ Form::model($user, ['route' => ['profiles.update', $user->id], 'files'=>true, 'method' => 'PUT']) }}
			
		    {{ csrf_field() }}
		    
            <dl class="dl-horizontal">
                <dt>Name:</dt>
                <dd>{{ Form::text('name', null, array('class' => 'form-control','required' => 'required','minlength' => '10','maxlength' => '255')) }}</dd>
            </dl>           
            <dl class="dl-horizontal">
                <dt>Email:</dt>
                <dd>{{ $user->email }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Status:</dt>
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
                        <img src="{{ asset('images/' . $user->avatar) }}" max-height="300px" max-width="200px"><br>To change avatar:
                    @endif
                	{{ Form::file ('avatar') }}
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

			<div class="row">
				<div class="col-sm-6" align="right">
					<a class="btn btn-info btn-sm" href="{{ URL::previous() }}">Cancel</a>
				</div>
				<div class="col-sm-6">
					{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm']) }}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection