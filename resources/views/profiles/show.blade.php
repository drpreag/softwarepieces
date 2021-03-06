@extends('partials._main')

@section('title', '| User profile')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>User profile</h3>     
            </div>
            <div class="col-md-4" align="right">
                <a href="{{ URL::previous() }}" class="btn btn-info btn-xs">Back</a>               
            </div>
        </div>

        <div class="well">
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
                <dt>About me:</dt>
                <dd>{!! $user->description !!}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Member since:</dt>
                <dd>{{ $user->created_at }}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Number of shared<br>news articles:</dt>
                <dd>{{ $user->sharedNewsCount() }}</dd>
            </dl>  
            <dl class="dl-horizontal">
                <dt>Number of written<br>blog articles:</dt>
                <dd>{{ $user->writtenBlogCount() }}</dd>
            </dl> 
        </div>
    </div>
@endsection