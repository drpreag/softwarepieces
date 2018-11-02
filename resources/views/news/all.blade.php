@extends('partials._main')

@section('description', 'Open Source news')
@section('title', '| Open Source News')

@section('content')
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6" align="right">
            {!! Form::open(['url' => 'news/all', 'id'=>'form', 'method' => 'GET']) !!}
            <div class="input-group add-on">
                {{ Form::select('category', $newsCategory, $category, array('class'=>'form-control', 'onchange'=>'submitform(this)', 'placeholder'=>'All categories...')) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div> 

    <br>
    <div class="main-container">    
        @foreach ($news as $newz)
            <div class="post-body">
                <br>
                <h4><b>{{ $newz->title }}</b></h4>
                @if (! empty($newz->imgurl))
                    <img src="{{ $newz->imgurl }}" class="post-img" target="_blank">
                @endif
                {!! $newz->post !!}
                Read more <a href="{{ $newz->url }}" target="_blank">here...</a>
                <br>
                @if (! empty($newz->inCategory->name))
                    <div>
                        Category: <b>{{ $newz->inCategory->name }}</b>
                    </div>
                @endif
                <div>
                    Shared by: <a href="{{ route('profiles.show', $newz->creator) }}">
                    <b>{{ $newz->isCreator->name }}</b></a> @ <b>{{ $newz->created_at }}</b>
                </div>
            </div>

            <div class="divider">
                <hr>
            </div>
        @endforeach
    </div>
    <br>

@endsection

@section('scripts')
<script type="text/javascript">
    function submitform()
    {
      this.form.submit();
    }
</script>
@endsection
