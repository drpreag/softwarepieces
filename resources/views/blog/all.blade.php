@extends('partials._main')

@section('description', 'Open Source blog')
@section('title', '| Open Source Blog')

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
                </div>
            </div>

            <div>
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
                {!! substr($post->body, 0, 768) !!}...<br><br>
                Read more <a href="{{ route('blog.show_blog', $post->id) }}">here...</a>
            </div>

            <div>
                Published by: <a href="{{ route('profiles.show', $post->creator) }}"><b>{{ $post->isCreator->name }}</b></a> @ <b>{{ substr($post->created_at,0,10) }}</b>
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
