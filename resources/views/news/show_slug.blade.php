@extends('partials._main')

@section('title', "| $slugNewz->title " )

@section('content')
	<div class="main-container">
		<br>		
		<div class="post-body">
			<div class="row">
				<div class="col" align="left">
					@if (!empty ($previousSlug))					
						<a href="{{ route('news.show_slug', $previousSlug) }}"><i class="fas fa-step-backward fa-2x"></i>Previous</a>
					@endif
				</div>				
				<div class="col" align="right">
					@if (!empty ($nextSlug))
						<a href="{{ route('news.show_slug', $nextSlug) }}">Next <i class="fas fa-step-forward fa-2x"></i></a>
					@endif
				</div>

			</div>
			<br>
	        <div class="row">
	            <div class="col-12 col-lg-8">
					<h3><b>{{ $slugNewz->title }}</b></h3>		
					<div>
						@if (! empty($slugNewz->imgurl))
							<img src="{{ $slugNewz->imgurl }}" style="float: right; margin: 15px 15px 15px 15px; border:1px solid #000000;" class="post-img" target="_blank">
						@endif
						{!! $slugNewz->post !!}
						Read original text <a href="{{ $slugNewz->url }}" target="_blank">here</a>
					</div>
				</div>

		        <div class="col-12 col-lg-4" align="right">
		        	<br>
	                <p>Category:<br><b>{{ $slugNewz->inCategory->name }}</b></p>
	                <p>Shared by:<br><a href="{{ route('profiles.show', $slugNewz->creator) }}"><b>{{ $slugNewz->isCreator->name }}</b></a></p>
	                <p>Published:<br><b>{{ substr($slugNewz->created_at,0,10) }}</b></p>
	                <p>Slug:<br><b>{{ $slugNewz->slug }}</b><br><br></p>
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
