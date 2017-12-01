@extends('partials._main')

@section('content')
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6" align="right">        
            {!! Form::open(['url' => 'blog/all', 'id'=>'form', 'method' => 'GET']) !!}
            <div class="input-group add-on">
                {{ Form::select('category', $newsCategory, $category, array('class'=>'form-control', 'onchange'=>'submitform(this)', 'placeholder'=>'All categories...')) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <br>
    @foreach ($posts as $post)
        <div class="gtco-container divider">

            <div>
                <div class="row">
                    <div class="col-md-6">
                        Category: <b>{{ $post->inCategory->name }}</b>
                    </div>
                    <div class="col-md-6" align="right">
                        Published: <b>{{ substr($post->created_at,0,10) }}</b>
                    </div>
                </div>
            </div>

            <div class="post-body">
                <br>
                <h3><b>{{ $post->title }}</b></h3>                  
                @if (! empty($post->subtitle))
                    <hr>
                    <i>{{ $post->subtitle }}</i>
                    <hr>                    
                @endif
                @if (! empty($post->image))
                    <img src="{{ asset('images/' . $post->image) }}" style="float: right; margin: 15px 15px 15px 15px; border:1px solid #000000;" class="responsive-image" target="_blank" max-height="240px" max-width="300px" align="right">
                @endif      
                {!! $post->body !!}
            </div>

            <div class="row">        
                <div class="well post-creator col-md-7">
                    Creator: <a href="{{ route('profiles.show', $post->creator) }}"><b>{{ $post->isCreator->name }}</b></a>
                    @if (! empty($post->isCreator->avatar))
                        <img src="{{ asset('images/' . $post->isCreator->avatar) }}" style="float: right; margin: 15px 15px 15px 15px; border:1px solid #000000;" class="responsive-image" target="_blank" max-height="300px" max-width="200px" >
                    @endif                                 
                    <br><br>
                    <i>{!! $post->isCreator->description !!}</i>
                </div>  
                <div class="col-md-1">
                </div>            
                <div class="well post-advertise col-md-4">
                    Advertising
                </div>
            </div>
        </div>
        <div class="divider"><hr></div>
    @endforeach
    <br>
    {{ $posts->links() }}    

@endsection

@section('scripts')
<script type="text/javascript">
function submitform()
{
  this.form.submit();
}
</script>
@endsection
