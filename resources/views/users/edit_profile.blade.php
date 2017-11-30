@extends('partials._main')

@section('title', '| Edit User')

@section('stylesheets')
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css') !!}
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Edit user profile : <b>{{ $user->email }}</b></h3>      
            </div>
            <div class="col-md-4" align="right">
                @if (! empty($user->avatar))
                    <img src="{{ asset('images/' . $user->avatar) }}" max-height="300px" max-width="200px">
                @endif
            </div>
        </div>
        <br>
        <div class="well">
            {{ Form::model($user, ['route' => ['users.update_profile', $user->id], 'method' => 'POST']) }}
            
            {{ csrf_field() }}
            {{ Form::hidden('id', null, array('class'=>'form-control', 'readonly'=>'readonly')) }}
                     
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

            {{ Form::label('avatar', 'Avatar URL:') }}
            {{ Form::text('avatar', null, array('class' => 'form-control', 'readonly'=>'readonly', 'maxlength' => '255')) }}

            {{ Form::label('description', 'Decription:') }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}

            <br>
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

@section('stylesheets')
    {!! Html::style('/css/parsley.css') !!}
@endsection

@section('scripts')
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            menubar: true
        });
    </script>
@endsection