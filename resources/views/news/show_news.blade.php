@extends('partials._main')

@section('title', "| $newz->title " )

@section('content')
	<div class="main-container">
		<br>		
		<div class="post-body">
			<div class="row">
				<div class="col" align="left">
					@if (!empty ($previousSlug))					
						<a href="{{ route('news.show_news', $previousSlug) }}"><i class="fas fa-step-backward fa-2x"></i> Previous</a>
					@endif
				</div>				
				<div class="col" align="right">
					@if (!empty ($nextSlug))
						<a href="{{ route('news.show_news', $nextSlug) }}">Next <i class="fas fa-step-forward fa-2x"></i></a>
					@endif
				</div>

			</div>
			<br>
	        <div class="row">
	            <div class="col-12 col-lg-8">
					<h3><b>{{ $newz->title }}</b></h3>		
					<div>
						@if (! empty($newz->imgurl))
							<img src="{{ $newz->imgurl }}" class="post-img">
						@endif
						{!! $newz->post !!}
						Read original text <a href="{{ $newz->url }}" target="_blank">here</a>
					</div>
				</div>

		        <div class="col-12 col-lg-4" align="right">
		        	<br>
	                <p>Category:<br><b>{{ $newz->inCategory->name }}</b></p>
	                <p>Shared by:<br><a href="{{ route('profiles.show', $newz->creator) }}"><b>{{ $newz->isCreator->name }}</b></a></p>
	                <p>Published:<br><b>{{ substr($newz->created_at,0,10) }}</b></p>
	                <p>Slug:<br><b>{{ $newz->slug }}</b><br><br></p>
				</div>
			</div>
		</div>
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
