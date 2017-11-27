@extends('partials._main')

@section('content')
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">        
            {!! Form::open(['url' => 'blogdashboard', 'id'=>'form', 'method' => 'GET']) !!}
            <div class="input-group add-on">
                {{ Form::select('category', $blogCategory, null, array('class'=>'form-control', 'onchange'=>'submitform(this)', 'placeholder'=>'All categories...')) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <br>
    <div class="gtco-container">
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('blog.show', $post->id) }}" target="_blank">
                    <div class="text-left gtco-heading">
                        <h3>
                            {{ $post->title }}
                        </h3>
                        @if (! empty($post->image))
                            <img src="{{ asset('images/' . $post->image) }}" target="_blank" max-height="200px" max-width="200px">
                        @endif      
                        <div>
                            <p>{!! $post->body !!}</p>
                        </div>
                        <br>
                        @if (! empty($post->inCategory->name))
                            <div>
                                Category: <b>{{ $post->inCategory->name }}</b>
                            </div>
                        @endif
                        <div>Creator: 
                            <a href="{{ route('users.show', $post->creator) }}"><b>{{ $post->isCreator->name }}</b></a>
                        </div>
                        <div>
                            Created: <b>{{ substr($post->created_at,0,10) }}</b>
                        </div>  
                    </div>   
                </a>
            </div>
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
