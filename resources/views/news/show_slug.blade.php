@extends('partials._main')

@section('title', "| $newz->title " )

@section('content')
	<div class="main-container">
		<br>
		<div>
			<a href="{{ route('dashboard') }}" class="btn btn-info btn-xs">Back</a>
		</div>
		<br>		
		<div class="post-body">

	        <div class="row">
	            <div class="col-md-8">
					<h3><b>{{ $newz->title }}</b></h3>		
					<div>
						@if (! empty($newz->imgurl))
							<img src="{{ $newz->imgurl }}" style="float: right; margin: 15px 15px 15px 15px; border:1px solid #000000;" class="post-img" width="200px" target="_blank">
						@endif
						{!! $newz->post !!}
						Read original text <a href="{{ $newz->url }}" target="_blank">here</a>
					</div>
				</div>

		        <div class="col-md-4" align="right">
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
