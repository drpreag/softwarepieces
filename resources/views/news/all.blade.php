@extends('partials._main')

@section('description', 'Open Source news')

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
    @foreach ($news as $newz)
        <div class="gtco-container divider">

            <div class="post-body">
                <br>
                <h3><b>{{ $newz->title }}</b></h3>
                @if (! empty($newz->imgurl))
                    <img src="{{ $newz->imgurl }}" style="float: right; margin: 15px 15px 15px 15px; border:1px solid #000000;" class="responsive-image" width="400px" target="_blank">
                @endif
                {!! $newz->post !!}
                Read more <a href="{{ $newz->url }}" target="_blank">here...</a>
                <br>
                @if (! empty($newz->newsCategory->name))
                    <div>
                        Category: <b>{{ $newz->newsCategory->name }}</b>
                    </div>
                @endif
                <div>
                    Shared by: <a href="{{ route('profiles.show', $newz->creator) }}"><b>{{ $newz->isCreator->name }}</b></a> @ <b>{{ $newz->created_at }}</b>
                </div>
            </div>

        </div>

        <div class="divider"><hr></div>            
    @endforeach
    <br>
    {{ $news->links() }}    

@endsection

@section('scripts')
<script type="text/javascript">
function submitform()
{
  this.form.submit();
}
</script>
@endsection
