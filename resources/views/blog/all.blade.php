@extends('partials._main')

@section('description', 'Open Source blog')
@section('title', '| Open Source Blog')

@section('content')
    <div class="main-container row">
        <div class="col-12 col-lg-8">
            @foreach ($posts as $post)
                <div class="post-body">
                    <h3><b>{{ $post->title }}</b></h3>
                    @if (! empty($post->image))
                        <img src="{{ asset('images/' . $post->image) }}" class="post-img" target="_blank" align="right">
                    @endif
                    {!! substr(strip_tags($post->body), 0, 150) !!}
                    <br><br>
                    Read more <a href="{{ route('blog.show_blog', [$post->slug]) }}">here...</a>
                    <br>
                    @if (! empty($post->inCategory->name))
                        <div>
                            Category: <b>{{ $post->inCategory->name }}</b>
                        </div>
                    @endif
                    <div>
                        Shared by: <a href="{{ route('profiles.show', [$post->creator]) }}"><b>{{ $post->isCreator->name }}</b></a> @ <b>{{ $post->created_at }}</b>
                    </div>
                </div>
                <div class="divider"><hr></div>
            @endforeach                
        </div>
        <div class="col-12 col-lg-4">
            {!! Form::open(['url' => 'posts/all', 'id'=>'form', 'method' => 'GET']) !!}
            <div class="input-group add-on">
                {{ Form::select('category', $newsCategory, $category, array('class'=>'form-control', 'onchange'=>'submitform(this)', 'placeholder'=>'All categories...')) }}
            </div>
            {!! Form::close() !!}            
        </div>
    </div> 

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
