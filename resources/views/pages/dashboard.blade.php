@extends('partials._main')

@section('description', 'Open Source news')
@section('title', '| Open Source News')

@section('content')
    <div class="main-container row">
        <div class="col-12 col-lg-8">
            @foreach ($news as $newz)
                <div class="post-body">
                    <br>
                    <h3><b>{{ $newz->title }}</b></h3>
                    @if (! empty($newz->imgurl))
                        <img src="{{ $newz->imgurl }}" style="float: right; margin: 15px 15px 15px 15px; border:1px solid #000000;" class="post-img" target="_blank">
                    @endif
                    {!! substr(strip_tags($newz->post), 0, 150) !!}
                    <br><br>
                    Read more <a href="{{ route('news.show_news', [$newz->slug]) }}">here...</a>
                    <br>
                    @if (! empty($newz->inCategory->name))
                        <div>
                            Category: <b>{{ $newz->inCategory->name }}</b>
                        </div>
                    @endif
                    <div>
                        Shared by: <a href="{{ route('profiles.show', [$newz->creator]) }}"><b>{{ $newz->isCreator->name }}</b></a> @ <b>{{ $newz->created_at }}</b>
                    </div>
                </div>
                <div class="divider"><hr></div>
            @endforeach                
        </div>
        <div class="col-12 col-lg-4">
            {!! Form::open(['url' => 'news/all', 'id'=>'form', 'method' => 'GET']) !!}
            <div class="input-group add-on">
                {{ Form::select('category', $newsCategory, $category, array('class'=>'form-control', 'onchange'=>'submitform(this)', 'placeholder'=>'All categories...')) }}
            </div>
            {!! Form::close() !!}            
        </div>
    </div>        

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
