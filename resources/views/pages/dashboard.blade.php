@extends('partials._main')

@section('content')
    <br><br><br><br>
    <div class="row">
        <div class="col-xs-6" align="right">
            <a href="{{ route('newsdashboard') }}" class="btn btn-success btn-sm">News</a>
        </div>
        <div class="col-xs-6">
            <a href="{{ route('blogdashboard') }}" class="btn btn-info btn-sm">Blog</a>
        </div>
    </div>
    <br><br><br><br>
@endsection
