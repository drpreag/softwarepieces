@extends('partials._main')

@section('content')
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6" align="right">        
            {!! Form::open(['url' => 'blog/all', 'id'=>'form', 'method' => 'GET']) !!}
            <div class="input-group add-on">
                {{ Form::select('category', $newsCategory, $category, array('class'=>'form-control', 'onchange'=>'submitform(this)', 'placeholder'=>'All categories...')) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <br>
    <div class="gtco-container">
        @foreach ($posts as $post)
            <div>
                <div class="row">
                    <div class="col-md-6">
                        Category: <b>{{ $post->inCategory->name }}</b>
                    </div>
                    <div class="col-md-6" align="right">
                        Published: <b>{{ substr($post->created_at,0,10) }}</b>
                    </div>
                </div>
                <br>
                    <h3><b>{{ $post->title }}</b></h3>                  
                <div>
                    <hr>
                    <i>{{ $post->subtitle }}</i>
                    <hr>
                </div>
                <div>
                    <p>
                        @if (! empty($post->image))
                            <img src="{{ asset('images/' . $post->image) }}" target="_blank" height="240px" max-width="300px" align="right" float="right" hspace="20">
                        @endif      
                        {!! $post->body !!}
                    </p>
                </div>
                <div class="well">
                    <div class="row">
                        <div class="col-md-8">
                            Creator: 
                            <a href="{{ route('users.show', $post->creator) }}"><b>{{ $post->isCreator->name }}</b></a>
                            {!! $post->isCreator->description !!}
                        </div>
                        <div class="col-md-4" align="right">
                            @if (! empty($post->isCreator->avatar))
                                <img src="{{ asset('images/' . $post->isCreator->avatar) }}" target="_blank" max-height="300px" width="200px">
                            @endif                                 
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <hr>
        @endforeach
        {{ $posts->links() }}    
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
function submitform()
{
  this.form.submit();
}
</script>
@endsection
