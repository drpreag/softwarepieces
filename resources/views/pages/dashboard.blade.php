@extends('partials._main')

@section('content')
    <div class="gtco-container">
        @foreach ($news as $newz)
            <div>
                <a href="{{ $newz->url }}" target="_blank">
                    <div class="text-left gtco-heading">
                        <h3>
                            {{ $newz->title }}
                        </h3>
                        @if (! empty($newz->imgurl))
                            <img src="{{ $newz->imgurl }}" target="_blank" height="100px" max-width="200px">
                        @endif      
                        <div>
                            <p>{!! $newz->post !!}</p>
                            Read more <a href="{{ $newz->url }}" target="_blank">here...</a>
                        </div>
                        <br>
                        @if (! empty($newz->newsCategory->name))
                            <div>
                                Category: <b>{{ $newz->newsCategory->name }}</b>
                            </div>
                        @endif
                        <div>Creator: <b>{{ $newz->isCreator->name }}</b></div>
                        <div>
                            Created: <b>{{ substr($newz->created_at,0,10) }}</b>
                        </div>  
                    </div>   
                </a>
            </div>
            <hr>
        @endforeach
    </div>
@endsection