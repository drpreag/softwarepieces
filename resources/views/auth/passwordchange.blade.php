@extends('partials._main')

@section('title', '| Change password')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change password</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.change') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" readonly="readonly" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                            <label for="oldpassword" class="col-md-4 control-label">Old Password</label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" class="form-control" name="oldpassword" required>

                                @if ($errors->has('oldpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" align="right">
                                {!! Html::linkRoute('dashboard', 'Cancel', array(), array('class' => 'btn btn-danger btn-sm')) !!}                                
                            </div>
                            <div class="col-md-6">
                                {{ Form::submit('Change password', ['class' => 'btn btn-success btn-sm']) }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
